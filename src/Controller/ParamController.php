<?php

namespace App\Controller;

use App\Entity\Param;
use App\Form\ParamType;
use App\Repository\ParamRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParamController extends AbstractController
{
    public function __construct
    (
        private readonly LoggerInterface $logger
    ){}

    #[Route('/params', name: 'params')]
    public function index(ParamRepository $paramRepository): Response
    {
        return $this->render('param/index.html.twig', [
            'params' => $paramRepository->findAll(),
        ]);
    }

    #[Route('/params/create', name: 'add_param', methods: ['GET', 'POST'])]
    public function store(Request $request, EntityManagerInterface $entityManager): Response
    {
        $param = new Param();
        $form = $this->createForm(ParamType::class, $param);
        $form->handleRequest($request);

        $this->logger->debug("Entered: add_param");

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Param $parameter */
            $parameter = $form->getData();

            if ($parameter->getExam() === null) {
                $this->logger->error("Exam is not given for {$parameter}");
                // render error page or something
                return $this->json($parameter->toArray(), Response::HTTP_BAD_REQUEST);
            }

            $entityManager->persist($parameter);
            $entityManager->flush();

            $this->logger->debug("Added new parameter for {$parameter->getExam()} named {$parameter}");

            return $this->redirectToRoute('params', ['success' => true]);
        }

        return $this->render('param/create.html.twig', [
            'form' => $form,
        ]);
    }
}
