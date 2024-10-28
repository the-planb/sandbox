<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader;

final class ExpectedException
{
	private ?string $className;
	private ?string $message;

	public function __construct(string $className = null, string $message = null)
	{
		$this->className = $className;
		$this->message = $message;
	}

	public function hasMessage(): bool
	{
		return is_string($this->message);
	}

	public function getClassName(): string
	{
		return $this->className ?? \Throwable::class;
	}

	public function getMessage(): string
	{
		$pattern = is_string($this->message) ?
			preg_quote($this->message, '/') :
			'.*';

		return "/{$pattern}/";
	}
}
