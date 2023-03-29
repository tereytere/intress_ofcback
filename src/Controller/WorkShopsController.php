<?php

namespace App\Controller;

use App\Entity\WorkShops;
use App\Form\WorkShopsType;
use App\Repository\WorkShopsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/work/shops')]
class WorkShopsController extends AbstractController
{
    #[Route('/', name: 'app_work_shops_index', methods: ['GET'])]
    public function index(WorkShopsRepository $workShopsRepository): Response
    {
        return $this->render('work_shops/index.html.twig', [
            'work_shops' => $workShopsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_work_shops_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WorkShopsRepository $workShopsRepository): Response
    {
        $workShop = new WorkShops();
        $form = $this->createForm(WorkShopsType::class, $workShop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workShopsRepository->save($workShop, true);

            return $this->redirectToRoute('app_work_shops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_shops/new.html.twig', [
            'work_shop' => $workShop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_work_shops_show', methods: ['GET'])]
    public function show(WorkShops $workShop): Response
    {
        return $this->render('work_shops/show.html.twig', [
            'work_shop' => $workShop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_work_shops_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WorkShops $workShop, WorkShopsRepository $workShopsRepository): Response
    {
        $form = $this->createForm(WorkShopsType::class, $workShop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $workShopsRepository->save($workShop, true);

            return $this->redirectToRoute('app_work_shops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('work_shops/edit.html.twig', [
            'work_shop' => $workShop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_work_shops_delete', methods: ['POST'])]
    public function delete(Request $request, WorkShops $workShop, WorkShopsRepository $workShopsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workShop->getId(), $request->request->get('_token'))) {
            $workShopsRepository->remove($workShop, true);
        }

        return $this->redirectToRoute('app_work_shops_index', [], Response::HTTP_SEE_OTHER);
    }
}
