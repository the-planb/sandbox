<?php
declare(strict_types=1);

namespace PlanB\Framework\Testing\DataFactory;

use Exception;
use League\Tactician\CommandBus;
use PlanB\Domain\Criteria\Criteria;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractDataFactory implements DataFactoryInterface
{
    private CommandBus $commandBus;
    private SerializerInterface $serializer;
    private string $directory;
    private Filesystem $filesystem;

    public function __construct(CommandBus $commandBus, SerializerInterface $serializer)
    {
        $this->commandBus = $commandBus;
        $this->serializer = $serializer;
        $this->directory = realpath('.') . '/tests/data';
        $this->filesystem = new Filesystem();
    }


    public function loadData(string $classOrInterface, string $mode): array
    {
        $fileName = $this->fileNameByClassName($classOrInterface, $mode);

        if ($this->exists($fileName)) {
            return $this->loadFile($fileName);
        }

        $command = $this->commandByClassName($classOrInterface);

        return $this->dumpFile($fileName, $command);

    }

    private function commandByClassName(string $classOrInterface): mixed
    {
        $commandList = $this->getCommandList();
        return $commandList[$classOrInterface] ?? throw new Exception("{$classOrInterface} isn't registered in DataFactory");
    }

    abstract protected function getCommandList(): array;

    protected function getCriteria(): Criteria
    {
        return Criteria::fromValues(['itemsPerPage' => 1]);
    }

    private function fileNameByClassName(string $classOrInterface, $mode): string
    {
        $pieces = text_explode($classOrInterface, '\\')
            ->filter(fn(string $piece) => !in_array($piece, ['Model', 'Domain']))
            ->map(fn(string $piece) => strtolower($piece));

        $path = textList([
            $this->directory,
            ...$pieces
        ])->implode('/');

        return "{$path}.{$mode}.json";
    }

    private function exists(string $path): bool
    {
        return $this->filesystem->exists($path);
    }

    private function loadFile(string $path): array
    {
        $data = file_get_contents($path);
        return json_decode($data, true);
    }

    private function dumpFile(string $path, mixed $command): array
    {

        $data = $this->commandBus->handle($command);
        $item = $data[0];

        $group = text_explode($item::class, '\\')
            ->map(fn(string $value) => strtolower($value))
            ->last();

        $json = $this->serializer->normalize($item, 'jsonld', [
            'enable_max_depth' => true,
            'groups' => [$group, 'value_object'],
        ]);

        $inputData = $this->cleanData($json, ['@type', '@context']);
        $this->filesystem->dumpFile($path, json_encode($inputData, JSON_PRETTY_PRINT));

        $this->filesystem->chown($this->directory, 1000, true);
        $this->filesystem->chgrp($this->directory, 1000, true);

        return $inputData;
    }

    private function cleanData($input, array $keys): array
    {
        $temp = [];

        foreach ($input as $key => $value) {
            if (!in_array($key, $keys)) {
                if (is_array($value)) {
                    $temp[$key] = $this->cleanData($value, $keys);
                } else {
                    $temp[$key] = $value;
                }
            }
        }

        return $temp;
    }

}
