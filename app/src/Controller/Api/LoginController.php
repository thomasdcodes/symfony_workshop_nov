<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api')]
class LoginController extends AbstractController
{
    #[Route(path: '/login', name: 'api_login_login', methods: ['POST'])]
    public function login()
    {
        $user = $this->getUser();
        if (null === $user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user'  => $user->getUserIdentifier(),
        ]);
    }
}