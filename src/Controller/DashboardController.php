<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'app_dashboard_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager, ProductRepository $product): Response
    {
        $products = $product->findAll();
        $needMore = [];
        foreach ($products as $product) {
            if ($product->getQuantityProduct() < 3) {
                $needMore[] = $product;
            }
        }
        return $this->render('dashboard/index.html.twig', [
            'products' => $needMore,
        ]);
    }
}
