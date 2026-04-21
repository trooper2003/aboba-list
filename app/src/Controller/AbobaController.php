<?php

namespace App\Controller;

use App\Repository\AbobaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class AbobaController extends AbstractController
{
    #[Route('aboba/{id<\d+>}', name: 'app_aboba_page', methods: ['GET'])]
    public function abobaPage(AbobaRepository $aboba, int $id) : Response
    {
        $currentAboba = $aboba->getOne($id);
        if (!$currentAboba) {
            throw $this->createNotFoundException('Aboba not found');
        }
        return $this->render('app/abobaPage.html.twig', ['aboba' => $currentAboba, 'id' => $id]);
    }
}

