<?php

namespace App\Controller;

use App\Entity\Aboba;
use App\Repository\AbobaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AbobaController extends AbstractController
{
    #[Route('aboba/{aboba}', name: 'app_aboba_page', methods: ['GET'])]
    public function abobaPage(Aboba $aboba) : Response
    {
        return $this->render('app/abobaPage.html.twig', ['aboba' => $aboba]);
    }
}

