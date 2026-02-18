<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\TestTableRepository;
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
    public function index(Request $request): Response
    {
        $records = $this->testTableRepository->findAll();

        return $this->json(['records' => $records], Response::HTTP_OK);
    }
}
