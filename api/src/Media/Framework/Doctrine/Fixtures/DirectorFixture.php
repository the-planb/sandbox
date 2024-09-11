<?php

declare(strict_types=1);

namespace App\Media\Framework\Doctrine\Fixtures;

use App\Media\Application\UseCase\Create\CreateDirector;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;
use Symfony\Component\Yaml\Yaml;

class DirectorFixture extends UseCaseFixture
{
    public function loadData(): void
    {
        $data = Yaml::parseFile(__DIR__.'/data/directors.yaml');
        $this->createRange($data, function (array $input) {
            $command = $this->denormalize([
                'name' => $input['name'],
            ], CreateDirector::class);

            return $this->handle($command);
        });
    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
