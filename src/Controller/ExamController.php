<?php

namespace App\Controller;

use App\Entity\Exam;
use App\Repository\ExamRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\DependencyInjection\Loader\Configurator\param;

class ExamController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ExamRepository $examRepository, LoggerInterface $logger): Response
    {
        $logger->alert('Entered index ExamController');

        return $this->render('exam/index.html.twig', [
            'exams' => $examRepository->findAll(),
        ]);
    }

    #[Route('/exams/{id}', name: 'exam_show')]
    public function show(Exam $exam): Response
    {
        return $this->render('exam/index.html.twig', [
            'exam' => $exam,
        ]);
    }
}
