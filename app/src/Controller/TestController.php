<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Aboba;
use App\Repository\AbobaRepository;
use App\Repository\TestTableRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    public function __construct(private readonly TestTableRepository $testTableRepository)
    {
    }

    #[Route('/api/test', name: 'test', methods: ['GET'])]
        public function index(Request $request, AbobaRepository $aboba): Response
    {
    //        $records = $this->testTableRepository->findAll();

    //        return $this->json(['records' => $records], Response::HTTP_OK);

            return $this->json($aboba->getAll());

        }

    #[Route('/', name: 'app_home_page', methods: ['GET'])]
    public function appHomePage(Request $request, AbobaRepository $aboba): Response
    {
        $abobaArray = $aboba->getAll();
        return $this->render('app/home_page.html.twig', ['aboba' => $abobaArray]);
    }

    #[Route('/api/aboba/{id<\d+>}', name: 'app_aboba_get', methods: ['GET'])]
    public function getAboba(Request $request, AbobaRepository $aboba, int $id): Response
    {
        $currentAboba = $aboba->getOne($id);
        return !$currentAboba ? throw $this->createNotFoundException('Aboba not found') : $this->json($currentAboba);
    }

    #[Route('aboba/{id<\d+>}', name: 'app_aboba_page', methods: ['GET'])]
    public function abobaPage(Request $request, AbobaRepository $aboba, int $id): Response
    {
        $currentAboba = $aboba->getOne($id);
        if (!$currentAboba) {
            throw $this->createNotFoundException('Aboba not found');
        }

        return $this->render('app/aboba_page.html.twig', ['aboba' => $currentAboba, 'id' => $id]);
    }
}

