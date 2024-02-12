<?php

namespace App\Borrame\Framework\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class FosController extends AbstractController
{
    public function __invoke()
    {
        if ('application/vnd.fos.user-context-hash' == strtolower($_SERVER['HTTP_ACCEPT'])) {
            // encontrar el rol más restrictivo
            // o ver como lo hace foshttpcache para symfony
            $user = $this->getUser();
            $hash = md5(serialize($user->getRoles()));

            return new Response($hash, 200, [
                'X-User-Context-Hash' => $hash,
                'Content-Type' => 'application/vnd.fos.user-context-hash',
                'Cache-Control' => 'max-age=3600',
                'Vary' => 'Cookie, Authorization',
            ]);
        }

        return new Response(null, 406);
    }
}
