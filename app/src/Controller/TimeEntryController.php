<?php

namespace App\Controller;

use App\Entity\TimeEntry;
use App\Form\TimeEntryType;
use App\Repository\TimeEntryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TimeEntryController extends AbstractController
{
    public function __construct(protected TimeEntryRepository $timeEntryRepository)
    {
    }

    #[Route('/timeentry/list', name: 'app.timeEntry.list')]
    public function list(): Response
    {
        return $this->render('time_entry/list.html.twig', [
            'timeEntries' => $this->timeEntryRepository->findBy(['user' => $this->getUser()])
        ]);
    }

    #[Route('/timeentry/add', name: 'app.timeEntry.add')]
    public function add(Request $request): Response
    {
        $timeEntry = new TimeEntry();
        $form = $this->createForm(TimeEntryType::class, $timeEntry);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeEntry->setUser($this->getUser());
            $this->timeEntryRepository->save($timeEntry, true);

            $this->addFlash('success', 'Zeiteintrag hinzugefügt');

            return $this->redirectToRoute('app.timeEntry.list');
        }

        return $this->renderForm('time_entry/add.html.twig', [
            'timeEntryForm' => $form,
        ]);
    }
}
