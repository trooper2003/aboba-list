<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Aboba;
use App\Repository\AbobaRepository;
use App\Repository\TestTableRepository;
use App\Service\WeatherService;
use Doctrine\ORM\EntityManagerInterface;
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
    public function appHomePage(AbobaRepository $abobaRepository, WeatherService $weatherService): Response
    {
        $abobas = $abobaRepository->findAll();
        $temp = $weatherService->getCurrentTemperature();

        return $this->render('app/homepage.html.twig', ['aboba' => $abobas, 'temp' => $temp]);
    }

    #[Route('/married', name: 'app_married', methods: ['GET'])]
    public function appMarried(AbobaRepository $abobaRepository, WeatherService $weatherService): Response
    {
        $abobas = $abobaRepository->findMarried();
        $temp = $weatherService->getCurrentTemperature();

        return $this->render('app/homepage.html.twig', ['aboba' => $abobas, 'temp' => $temp]);
    }

    #[Route('/not_married', name: 'app_not_married', methods: ['GET'])]
    public function appNotMarried(AbobaRepository $abobaRepository, WeatherService $weatherService): Response
    {
        $abobas = $abobaRepository->findNotMarried();
        $temp = $weatherService->getCurrentTemperature();

        return $this->render('app/homepage.html.twig', ['aboba' => $abobas, 'temp' => $temp]);
    }
}

