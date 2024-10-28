<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader\Alice;

use Nelmio\Alice\IsAServiceTrait;
use Nelmio\Alice\Parser\ChainableParserInterface;
use Nelmio\Alice\ParserInterface;
use Nelmio\Alice\Throwable\Exception\Parser\ParseExceptionFactory;
use PlanB\Framework\Testing\DataLoader\TestData;

final class CustomParser implements ParserInterface
{
	use IsAServiceTrait;

	private string $directory;
	private $parsers;

	public function __construct(string $directory, array $parsers)
	{
		$this->directory = $directory;

		$this->parsers = (static function (ChainableParserInterface ...$parsers) {
			return $parsers;
		})(...$parsers);
	}

	public function parse(string $file): array
	{
		foreach ($this->parsers as $parser) {
			if ($parser->canParse($file)) {
				$prefix = $this->calculePrefix($file);

				$data = $parser->parse($file);
				$data = $this->prefixKeys($prefix, $data);

				return array_filter($data);
			}
		}

		throw ParseExceptionFactory::createForParserNoFoundForFile($file);
	}

	private function calculePrefix(string $file): string
	{
		$info = pathinfo(ltrim($file, $this->directory));
		$className = "App/{$info['dirname']}/{$info['filename']}";

		return str_replace('/', '\\', $className);
	}

	private function prefixKeys(string $prefix, array $data): array
	{
		$items = [
			...$data[TestData::class] ?? [],
			...$data['\\'.TestData::class] ?? [],
		];

		unset($data[TestData::class], $data['\\'.TestData::class]);

		return [
			...$data,
			TestData::class => map($items)->mapKeys(fn ($_, string $key) => "{$prefix}#{$key}")->toArray(),
		];
	}
}
