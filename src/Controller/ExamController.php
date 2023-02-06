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
    public function __construct
    (
        private readonly ExamRepository  $examRepository,
        private readonly LoggerInterface $logger
    ){}

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $this->logger->debug('Entered: ' . __CLASS__ . '::' . __FUNCTION__);

        return $this->render('exam/index.html.twig', [
            'exams' => $this->examRepository->findAll(),
        ]);
    }

    #[Route('/exams/{id}', name: 'exam_show')]
    public function show(Exam $exam): Response
    {
        $this->logger->debug('Entered: ' . __CLASS__ . '::' . __FUNCTION__);

        return $this->render('exam/show.html.twig', [
            'exam' => $exam
        ]);
    }
}
