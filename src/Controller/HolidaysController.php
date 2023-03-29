<?php

namespace App\Controller;

use App\Entity\Holidays;
use App\Form\HolidaysType;
use App\Repository\HolidaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/holidays')]
class HolidaysController extends AbstractController
{
    #[Route('/', name: 'app_holidays_index', methods: ['GET'])]
    public function index(HolidaysRepository $holidaysRepository): Response
    {
        return $this->render('holidays/index.html.twig', [
            'holidays' => $holidaysRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_holidays_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HolidaysRepository $holidaysRepository): Response
    {
        $holiday = new Holidays();
        $form = $this->createForm(HolidaysType::class, $holiday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $holidaysRepository->save($holiday, true);

            return $this->redirectToRoute('app_holidays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('holidays/new.html.twig', [
            'holiday' => $holiday,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_holidays_show', methods: ['GET'])]
    public function show(Holidays $holiday): Response
    {
        return $this->render('holidays/show.html.twig', [
            'holiday' => $holiday,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_holidays_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Holidays $holiday, HolidaysRepository $holidaysRepository): Response
    {
        $form = $this->createForm(HolidaysType::class, $holiday);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $holidaysRepository->save($holiday, true);

            return $this->redirectToRoute('app_holidays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('holidays/edit.html.twig', [
            'holiday' => $holiday,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_holidays_delete', methods: ['POST'])]
    public function delete(Request $request, Holidays $holiday, HolidaysRepository $holidaysRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$holiday->getId(), $request->request->get('_token'))) {
            $holidaysRepository->remove($holiday, true);
        }

        return $this->redirectToRoute('app_holidays_index', [], Response::HTTP_SEE_OTHER);
    }
}
