<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route(
        path: '/',
        name: 'app.dashboard.index',
        methods: ['GET']
    )]
    public function index(Request $request): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'name' => 'Thomas',
        ]);
    }
}