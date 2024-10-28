<?php

declare(strict_types=1);

namespace PlanB\Framework\Testing\DataLoader\Alice;

use Exception;

final class CustomProvider
{
	public static function todo()
	{
		throw new \Exception("\nTO-DO. Este valor aun no está especificado. \n");
	}

	//    public function todo()
	//    {
	//        throw new Exception("\n\n sss \n\n");
	//    }
}
