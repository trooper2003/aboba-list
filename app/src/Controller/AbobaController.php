<?php

namespace App\Controller;

use App\Repository\AbobaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AbobaController extends AbstractController
{
    #[Route('aboba/{id<\d+>}', name: 'app_aboba_page', methods: ['GET'])]
    public function abobaPage(Request $request, AbobaRepository $aboba, int $id): Response
    {
        $currentAboba = $aboba->getOne($id);
        if (!$currentAboba) {
            throw $this->createNotFoundException('Aboba not found');
        }
        return $this->render('app/abobaPage.html.twig', ['aboba' => $currentAboba, 'id' => $id]);
    }
}

