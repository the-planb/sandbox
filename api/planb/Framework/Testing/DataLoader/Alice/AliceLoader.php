<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader\Alice;

use Faker\Generator as FakerGenerator;
use Nelmio\Alice\FileLocator\DefaultFileLocator;
use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\Parser\Chainable\JsonParser;
use Nelmio\Alice\Parser\Chainable\PhpParser;
use Nelmio\Alice\Parser\Chainable\YamlParser;
use Nelmio\Alice\Parser\IncludeProcessor\DefaultIncludeProcessor;
use Nelmio\Alice\Parser\RuntimeCacheParser;
use Nelmio\Alice\ParserInterface;
use Symfony\Component\Yaml\Parser as SymfonyYamlParser;

final class AliceLoader extends NativeLoader
{
	private string $directory;

	public function __construct(string $directory)
	{
		$this->directory = $directory;
		parent::__construct();
	}

	protected function getSeed()
	{
		return time();
	}

	protected function createFakerGenerator(): FakerGenerator
	{
		$generator = parent::createFakerGenerator();
		$generator->addProvider(new CustomProvider());

		return $generator;
	}

	protected function createParser(): ParserInterface
	{
		$registry = new CustomParser($this->directory, [
			new YamlParser(new SymfonyYamlParser()),
			new PhpParser(),
			new JsonParser(),
		]);

		return new RuntimeCacheParser(
			$registry,
			new DefaultFileLocator(),
			new DefaultIncludeProcessor(
				new DefaultFileLocator()
			)
		);
	}
}
