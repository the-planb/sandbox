<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader;

final class TestData
{
	private array $input = [];
	private mixed $response = null;

	public function getInput(): array
	{
		return $this->input;
	}

	public function setInput(array $input): self
	{
		$this->input = $input;

		return $this;
	}

	public function getResponse(): mixed
	{
		return $this->response;
	}

	public function setResponse(mixed $response): self
	{
		$this->response = $response;

		return $this;
	}

	public function setException(array $exception): self
	{
		try {
			$this->response = new ExpectedException(...$exception);
		} catch (\Throwable $e) {
			throw new \Exception("Error al construir ExpectedException ({$e->getMessage()})");
		}

		return $this;
	}
}
