<?php

namespace App\Controller;

use App\Entity\Workshops;
use App\Form\WorkshopsType;
use App\Repository\WorkshopsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/workshops')]
class WorkshopsController extends AbstractController
{
    #[Route('/', name: 'app_workshops_index', methods: ['GET'])]
    public function index(WorkshopsRepository $workshopsRepository): Response
    {
        return $this->render('workshops/index.html.twig', [
            'workshops' => $workshopsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_workshops_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WorkshopsRepository $workshopsRepository): Response
    {
        $workshop = new Workshops();
        $form = $this->createForm(WorkshopsType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workshopsRepository->save($workshop, true);

            return $this->redirectToRoute('app_workshops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('workshops/new.html.twig', [
            'workshop' => $workshop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workshops_show', methods: ['GET'])]
    public function show(Workshops $workshop): Response
    {
        return $this->render('workshops/show.html.twig', [
            'workshop' => $workshop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_workshops_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workshops $workshop, WorkshopsRepository $workshopsRepository): Response
    {
        $form = $this->createForm(WorkshopsType::class, $workshop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workshopsRepository->save($workshop, true);

            return $this->redirectToRoute('app_workshops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('workshops/edit.html.twig', [
            'workshop' => $workshop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_workshops_delete', methods: ['POST'])]
    public function delete(Request $request, Workshops $workshop, WorkshopsRepository $workshopsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workshop->getId(), $request->request->get('_token'))) {
            $workshopsRepository->remove($workshop, true);
        }

        return $this->redirectToRoute('app_workshops_index', [], Response::HTTP_SEE_OTHER);
    }
}
