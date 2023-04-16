<?php

namespace App\Controller;

use App\Entity\SuppliedItem;
use App\Form\SuppliedItemType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/supplied/item')]
class SuppliedItemController extends AbstractController
{
    #[Route('/', name: 'app_supplied_item_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $suppliedItems = $entityManager
            ->getRepository(SuppliedItem::class)
            ->findAll();

        return $this->render('supplied_item/index.html.twig', [
            'supplied_items' => $suppliedItems,
        ]);
    }

    #[Route('/new', name: 'app_supplied_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $suppliedItem = new SuppliedItem();
        $form = $this->createForm(SuppliedItemType::class, $suppliedItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($suppliedItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_supplied_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supplied_item/new.html.twig', [
            'supplied_item' => $suppliedItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_supplied_item_show', methods: ['GET'])]
    public function show(SuppliedItem $suppliedItem): Response
    {
        return $this->render('supplied_item/show.html.twig', [
            'supplied_item' => $suppliedItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_supplied_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SuppliedItem $suppliedItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SuppliedItemType::class, $suppliedItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_supplied_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('supplied_item/edit.html.twig', [
            'supplied_item' => $suppliedItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_supplied_item_delete', methods: ['POST'])]
    public function delete(Request $request, SuppliedItem $suppliedItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$suppliedItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($suppliedItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_supplied_item_index', [], Response::HTTP_SEE_OTHER);
    }
}
