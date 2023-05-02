<?php

namespace App\Controller;

use App\Entity\OrderStatus;
use App\Form\OrderStatusType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
#[Route('/order/status')]
class OrderStatusController extends AbstractController
{
    #[Route('/', name: 'app_order_status_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $orderStatuses = $entityManager
            ->getRepository(OrderStatus::class)
            ->findAll();

        return $this->render('order_status/index.html.twig', [
            'order_statuses' => $orderStatuses,
        ]);
    }

    #[Route('/new', name: 'app_order_status_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orderStatus = new OrderStatus();
        $form = $this->createForm(OrderStatusType::class, $orderStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orderStatus);
            $entityManager->flush();

            return $this->redirectToRoute('app_order_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_status/new.html.twig', [
            'order_status' => $orderStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_status_show', methods: ['GET'])]
    public function show(OrderStatus $orderStatus): Response
    {
        return $this->render('order_status/show.html.twig', [
            'order_status' => $orderStatus,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_order_status_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OrderStatus $orderStatus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OrderStatusType::class, $orderStatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_order_status_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('order_status/edit.html.twig', [
            'order_status' => $orderStatus,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_order_status_delete', methods: ['POST'])]
    public function delete(Request $request, OrderStatus $orderStatus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderStatus->getId(), $request->request->get('_token'))) {
            $entityManager->remove($orderStatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_order_status_index', [], Response::HTTP_SEE_OTHER);
    }
}
