<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Aboba;
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
    public function appHomePage(EntityManagerInterface $em, WeatherService $weatherService): Response
    {
        $abobas = $em->createQueryBuilder()
        ->select('a')
        ->from(Aboba::class, 'a')
        ->getQuery()
        ->getResult();
        $temp = $weatherService->getCurrentTemperature();

        return $this->render('app/homepage.html.twig', ['aboba' => $abobas, 'temp' => $temp]);
    }
}

