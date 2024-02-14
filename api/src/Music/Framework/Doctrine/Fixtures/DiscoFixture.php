<?php

declare(strict_types=1);

namespace App\Music\Framework\Doctrine\Fixtures;

use App\Music\Application\UseCase\Create\CreateDisco;
use App\Music\Domain\Input\DiscoInput;
use App\Music\Domain\Input\SongInput;
use App\Music\Domain\Input\SongListInput;
use App\Music\Domain\Model\VO\DiscoName;
use App\Music\Domain\Model\VO\Duration;
use App\Music\Domain\Model\VO\SongName;
use PlanB\Framework\Doctrine\Fixtures\UseCaseFixture;

/**
 * @codeCoverageIgnore
 */
final class DiscoFixture extends UseCaseFixture // implements DependentFixtureInterface
{
    public function loadData(): void
    {
        $this->createMany(100, function (int $index) {

            $songs = $this->createMany(rand(5, 8), function (int $index) {
                $input = new SongInput();
                $input->title = new SongName(sprintf('canción %02d', $index));
                $input->duration = new Duration(rand(120, 220));

                return $input;
            });

            $input = new DiscoInput();
            $input->title = new DiscoName(sprintf('disco num. %02d', $index));
            $input->songs = SongListInput::collect($songs);

            $command = new CreateDisco($input);
            return $this->handle($command);
        });
    }

    public function allowedEnvironments(): array
    {
        return ['dev'];
    }
}
