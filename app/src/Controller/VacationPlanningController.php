<?php

namespace App\Controller;

use App\Entity\VacationPlanning;
use App\Form\VacationPlanningType;
use App\Repository\VacationPlanningRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vacation/planning')]
class VacationPlanningController extends AbstractController
{
    #[Route('/', name: 'app_vacation_planning_index', methods: ['GET'])]
    public function index(VacationPlanningRepository $vacationPlanningRepository): Response
    {
        return $this->render('vacation_planning/index.html.twig', [
            'vacation_plannings' => $vacationPlanningRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vacation_planning_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VacationPlanningRepository $vacationPlanningRepository): Response
    {
        $vacationPlanning = new VacationPlanning();
        $form = $this->createForm(VacationPlanningType::class, $vacationPlanning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacationPlanning->setUser($this->getUser());
            $vacationPlanningRepository->save($vacationPlanning, true);

            return $this->redirectToRoute('app_vacation_planning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacation_planning/new.html.twig', [
            'vacation_planning' => $vacationPlanning,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vacation_planning_show', methods: ['GET'])]
    public function show(VacationPlanning $vacationPlanning): Response
    {
        return $this->render('vacation_planning/show.html.twig', [
            'vacation_planning' => $vacationPlanning,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vacation_planning_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VacationPlanning $vacationPlanning, VacationPlanningRepository $vacationPlanningRepository): Response
    {
        $form = $this->createForm(VacationPlanningType::class, $vacationPlanning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacationPlanningRepository->save($vacationPlanning, true);

            return $this->redirectToRoute('app_vacation_planning_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vacation_planning/edit.html.twig', [
            'vacation_planning' => $vacationPlanning,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vacation_planning_delete', methods: ['POST'])]
    public function delete(Request $request, VacationPlanning $vacationPlanning, VacationPlanningRepository $vacationPlanningRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacationPlanning->getId(), $request->request->get('_token'))) {
            $vacationPlanningRepository->remove($vacationPlanning, true);
        }

        return $this->redirectToRoute('app_vacation_planning_index', [], Response::HTTP_SEE_OTHER);
    }
}
