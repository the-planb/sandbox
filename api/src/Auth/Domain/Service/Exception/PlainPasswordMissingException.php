<?php

declare(strict_types=1);

namespace App\Auth\Domain\Service\Exception;

final class PlainPasswordMissingException extends \Exception
{
    public function __construct()
    {
        $message = 'Es necesario llamar al método setPassword antes de crear el hash';
        parent::__construct($message);
    }
}
