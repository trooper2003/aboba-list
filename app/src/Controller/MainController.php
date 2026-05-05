<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\MarriedStatusEnum;
use App\Repository\TestTableRepository;
use App\Service\AbobaService;
use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
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
    public function appHomePage(
        AbobaService $abobaService,
        WeatherService $weatherService,
        #[MapQueryParameter] ?MarriedStatusEnum $marriedStatus = null,
        #[MapQueryParameter] int $page = 1,
    ): Response {
        $temp = $weatherService->getCurrentTemperature();
        $abobaPaginator = $abobaService->getByMarriedStatusPaginated($marriedStatus, $page);

        return $this->render('app/homepage.html.twig', ['aboba' => $abobaPaginator, 'temp' => $temp]);
    }
}
