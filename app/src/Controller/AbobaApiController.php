<?php

namespace App\Controller;

use App\Entity\Aboba;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AbobaApiController extends AbstractController
{
    #[Route('/api/aboba/{aboba}', name: 'app_aboba_get', methods: ['GET'])]
    public function getAboba(Aboba $aboba): Response
    {
        return $this->json($aboba);
    }
}
