<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class UserController extends AbstractController
{
    #[Route(
        path: '/user/list',
        name: 'app.user.list',
        methods: ['GET']
    )]
    public function list(UserRepository $userRepository): Response
    {
        return $this->render('user/list.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route(path: '/user/add',name: 'app.user.add',methods: ['GET'])]
    public function add(): Response
    {
        $form = $this->createForm(UserType::class);
        return $this->render('user/add.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }

    #[Route(
        path: '/user/submit',
        name: 'app.user.submit',
        methods: ['POST']
    )]
    public function submit(Request $request, EntityManagerInterface $entityManager): Response
    {
        //Verarbeite POST
        $email = $request->request->get('email');

        $user = (new User())->setEmail($email);
        //Initialisiere Model und befülle es mit Daten


        //speicher das Model/Entity
        $entityManager->persist($user);
        $entityManager->flush();

        //Wenn erfolgreich redirect an Liste

        //Wenn nicht
        return $this->redirectToRoute('app.user.add');
    }
}