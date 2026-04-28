<?php

namespace App\Controller;

use App\Entity\Aboba;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AbobaController extends AbstractController
{
    #[Route('aboba/{id<\d+>}', name: 'app_aboba_page', methods: ['GET'])]
    public function abobaPage(EntityManagerInterface $em, int $id) : Response
    {
        $currentAboba = $em->getRepository(Aboba::class)->find($id);
        if (!$currentAboba) {
            throw $this->createNotFoundException('Aboba not found');
        }
        return $this->render('app/abobaPage.html.twig', ['aboba' => $currentAboba, 'id' => $id]);
    }
}

