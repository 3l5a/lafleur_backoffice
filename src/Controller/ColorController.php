<?php

namespace App\Controller;

use App\Entity\Color;
use App\Form\ColorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/color')]
class ColorController extends AbstractController
{
    #[Route('/', name: 'app_color_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $colors = $entityManager
            ->getRepository(Color::class)
            ->findAll();

        return $this->render('color/index.html.twig', [
            'colors' => $colors,
        ]);
    }

    #[Route('/new', name: 'app_color_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $color = new Color();
        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($color);
            $entityManager->flush();

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('color/new.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_color_show', methods: ['GET'])]
    public function show(Color $color): Response
    {
        return $this->render('color/show.html.twig', [
            'color' => $color,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_color_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Color $color, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ColorType::class, $color);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('color/edit.html.twig', [
            'color' => $color,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_color_delete', methods: ['POST'])]
    public function delete(Request $request, Color $color, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$color->getId(), $request->request->get('_token'))) {
            $entityManager->remove($color);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_color_index', [], Response::HTTP_SEE_OTHER);
    }
}
