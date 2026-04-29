<?php

namespace App\Controller;

use App\Repository\AbobaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AbobaApiController extends AbstractController
{
    #[Route('/api/aboba/{id<\d+>}', name: 'app_aboba_get', methods: ['GET'])]
    public function getAboba(Request $request, AbobaRepository $abobaRepository, int $id): Response
    {
        $currentAboba = $abobaRepository->find($id);
        return !$currentAboba ? throw $this->createNotFoundException('Aboba not found') : $this->json($currentAboba);
    }
}
