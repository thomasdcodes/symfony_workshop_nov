<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(
        path: '/user/list',
        name: 'app.user.list',
        methods: ['GET']
    )]
    public function list(): Response
    {
        $users = [
            '<h5>Thomas</h5>',
            '<h3>Michael</h3>',
            'Nelson',
        ];

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }
}