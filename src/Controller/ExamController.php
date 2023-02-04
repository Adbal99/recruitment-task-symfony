<?php

namespace App\Controller;

use App\Repository\ExamRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExamController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ExamRepository $examRepository, LoggerInterface $logger): Response
    {
        $logger->alert('dupa dupa', [
            'some' => 'context'
        ]);

        return $this->render('exam/index.html.twig', [
            'controller_name' => 'ExamController',
            'conferences' => 'ExamController',
        ]);
    }
}
