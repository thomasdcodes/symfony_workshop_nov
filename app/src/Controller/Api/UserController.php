<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route(path: '/api', name: 'api_')]
class UserController extends AbstractController
{
    public function __construct(
        protected UserRepository $userRepository,
        protected NormalizerInterface $normalizer
    )
    {
    }

    #[Route(path: '/users', name: 'user_list', methods: ['GET'])]
    public function list(): Response
    {
        $users = $this->userRepository->findAll();

        $normalizedUsers = $this->normalizer->normalize($users, null, ['groups' => ['api_user']]);

        return new JsonResponse(['users' => $normalizedUsers]);
    }

    #[Route(path: '/user', name: 'user_create', methods: ['POST'])]
    public function create(): Response
    {

    }

    #[Route(path: '/user/{id}', name: 'user_read', methods: ['GET'])]
    public function read(int $id): Response
    {

    }

    #[Route(path: '/user/{id}', name: 'user_update', methods: ['PATCH'])]
    public function update(int $id): Response
    {

    }

    #[Route(path: '/user/{id}', name: 'user_delete', methods: ['DELETE'])]
    public function delete(int $id): Response
    {

    }

    #[Route(path: '/user/current', name: 'user_current', methods: ['GET'], priority: 100)]
    public function current(): Response
    {
        $normalizedUser = $this->normalizer->normalize($this->getUser());

        return new JsonResponse(['user' => $normalizedUser]);
    }
}