<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader;

use Nelmio\Alice\Loader\NativeLoader;
use PlanB\Framework\Testing\DataLoader\Alice\AliceLoader;
use PlanB\Pattern\Traits\SingletonTrait;

final class DataProvider
{
	use SingletonTrait;

	private string $directory;
	private NativeLoader $loader;
	private TestDataList $data;

	public function __construct()
	{
		$this->directory = realpath('./tests/TestData');
		$this->loader = new AliceLoader($this->directory);
	}

	private function initialize(): void
	{
		if (isset($this->data)) {
			return;
		}

		try {
			$paths = $this->getAllFiles($this->directory);
			$this->data = TestDataList::collect($this->loader->loadFiles($paths)->getObjects());
		} catch (\Throwable $e) {
			throw new \Exception("\n\n\n{$e->getMessage()}");
		}
	}

	public function loadData(string $className, string $name): TestData
	{
		$this->initialize();
		$key = "{$className}#{$name}";

		if (!$this->data->hasKey($key)) {
			throw new \Exception("No se puede localizar el test data '{$key}'");
		}

		return $this->data->get($key);
	}

	public function loadDataSet(string $className): iterable
	{
		$this->initialize();

		$data = $this->data->filterByClassName($className);

		foreach ($data as $name => $testData) {
			yield $name => [$testData->getInput(), $testData->getResponse()];
		}
	}

	private function getAllFiles($directory): array
	{
		$files = [];

		if (is_dir($directory)) {
			$directories = scandir($directory);

			foreach ($directories as $item) {
				if ('.' !== $item && '..' !== $item) {
					$fullPath = $directory.'/'.$item;

					if (is_dir($fullPath)) {
						$files = [
							...$files,
							...$this->getAllFiles($fullPath),
						];
					} else {
						$files[] = $fullPath;
					}
				}
			}
		}

		return $files;
	}
}
