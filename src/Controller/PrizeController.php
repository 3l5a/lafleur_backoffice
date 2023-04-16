<?php

namespace App\Controller;

use App\Entity\Prize;
use App\Form\PrizeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prize')]
class PrizeController extends AbstractController
{
    #[Route('/', name: 'app_prize_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $prizes = $entityManager
            ->getRepository(Prize::class)
            ->findAll();

        return $this->render('prize/index.html.twig', [
            'prizes' => $prizes,
        ]);
    }

    #[Route('/new', name: 'app_prize_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $prize = new Prize();
        $form = $this->createForm(PrizeType::class, $prize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($prize);
            $entityManager->flush();

            return $this->redirectToRoute('app_prize_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prize/new.html.twig', [
            'prize' => $prize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prize_show', methods: ['GET'])]
    public function show(Prize $prize): Response
    {
        return $this->render('prize/show.html.twig', [
            'prize' => $prize,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_prize_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Prize $prize, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrizeType::class, $prize);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_prize_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prize/edit.html.twig', [
            'prize' => $prize,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_prize_delete', methods: ['POST'])]
    public function delete(Request $request, Prize $prize, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prize->getId(), $request->request->get('_token'))) {
            $entityManager->remove($prize);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_prize_index', [], Response::HTTP_SEE_OTHER);
    }
}
