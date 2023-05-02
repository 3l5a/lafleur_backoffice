<?php

namespace App\Controller;

use App\Entity\SupplierOrder;
use App\Form\SupplierOrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
#[Route('/supplier/order')]
class SupplierOrderController extends AbstractController
{
    #[Route('/', name: 'app_supplier_order_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $supplierOrders = $entityManager
            ->getRepository(SupplierOrder::class)
            ->findAll();

        return $this->render('supplier_order/index.html.twig', [
            'supplier_orders' => $supplierOrders,
        ]);
    }

    #[Route('/new', name: 'app_supplier_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $supplierOrder = new SupplierOrder();
        $form = $this->createForm(SupplierOrderType::class, $supplierOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($supplierOrder);
            $entityManager->flush();

            return $this->redirectToRoute('app_supplier_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supplier_order/new.html.twig', [
            'supplier_order' => $supplierOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_supplier_order_show', methods: ['GET'])]
    public function show(SupplierOrder $supplierOrder): Response
    {
        return $this->render('supplier_order/show.html.twig', [
            'supplier_order' => $supplierOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_supplier_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SupplierOrder $supplierOrder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SupplierOrderType::class, $supplierOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_supplier_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supplier_order/edit.html.twig', [
            'supplier_order' => $supplierOrder,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_supplier_order_delete', methods: ['POST'])]
    public function delete(Request $request, SupplierOrder $supplierOrder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$supplierOrder->getId(), $request->request->get('_token'))) {
            $entityManager->remove($supplierOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_supplier_order_index', [], Response::HTTP_SEE_OTHER);
    }
}
