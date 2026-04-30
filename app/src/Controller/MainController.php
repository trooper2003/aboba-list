<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\MarriedStatusEnum;
use App\Repository\AbobaRepository;
use App\Repository\TestTableRepository;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    public function __construct(private readonly TestTableRepository $testTableRepository)
    {
    }

//    #[Route('/api/test', name: 'test', methods: ['GET'])]
//    public function index(Request $request, AbobaRepository $aboba): Response
//    {
//        //        $records = $this->testTableRepository->findAll();
//
//        //        return $this->json(['records' => $records], Response::HTTP_OK);
//
//        return $this->json($aboba->getAll());
//
//    }

    #[Route('/', name: 'app_home_page', methods: ['GET'])]
    #[Route('/{marriedStatus}', name: 'app_home_page_filter', requirements:['marriedStatus' => 'married|not_married'], methods: ['GET'])]
    public function appHomePage(
        AbobaRepository $abobaRepository,
        WeatherService $weatherService,
        ?MarriedStatusEnum $marriedStatus = null,
    ): Response {
        $abobas = match ($marriedStatus) {
            MarriedStatusEnum::NOT_MARRIED => $abobaRepository->findNotMarried(),
            MarriedStatusEnum::MARRIED => $abobaRepository->findMarried(),
            null => $abobaRepository->findAll(),
        };
        $temp = $weatherService->getCurrentTemperature();

        return $this->render('app/homepage.html.twig', ['aboba' => $abobas, 'temp' => $temp]);
    }
}

