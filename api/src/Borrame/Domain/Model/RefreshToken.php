<?php

namespace App\Borrame\Domain\Model;

use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshToken as BaseRefreshToken;

/**
 * @ORM\Entity
 *
 * @ORM\Table("refresh_tokens")
 */
class RefreshToken extends BaseRefreshToken
{
}
