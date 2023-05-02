<?php

namespace App\Controller;

use App\Entity\LineCustomer;
use App\Form\LineCustomerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
#[Route('/line/customer')]
class LineCustomerController extends AbstractController
{
    #[Route('/', name: 'app_line_customer_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $lineCustomers = $entityManager
            ->getRepository(LineCustomer::class)
            ->findAll();

        return $this->render('line_customer/index.html.twig', [
            'line_customers' => $lineCustomers,
        ]);
    }

    #[Route('/new', name: 'app_line_customer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lineCustomer = new LineCustomer();
        $form = $this->createForm(LineCustomerType::class, $lineCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lineCustomer);
            $entityManager->flush();

            return $this->redirectToRoute('app_line_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('line_customer/new.html.twig', [
            'line_customer' => $lineCustomer,
            'form' => $form,
        ]);
    }

    #[Route('/{prize}', name: 'app_line_customer_show', methods: ['GET'])]
    public function show(LineCustomer $lineCustomer): Response
    {
        return $this->render('line_customer/show.html.twig', [
            'line_customer' => $lineCustomer,
        ]);
    }

    #[Route('/{prize}/edit', name: 'app_line_customer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LineCustomer $lineCustomer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LineCustomerType::class, $lineCustomer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_line_customer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('line_customer/edit.html.twig', [
            'line_customer' => $lineCustomer,
            'form' => $form,
        ]);
    }

    #[Route('/{prize}', name: 'app_line_customer_delete', methods: ['POST'])]
    public function delete(Request $request, LineCustomer $lineCustomer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lineCustomer->getPrize(), $request->request->get('_token'))) {
            $entityManager->remove($lineCustomer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_line_customer_index', [], Response::HTTP_SEE_OTHER);
    }
}
