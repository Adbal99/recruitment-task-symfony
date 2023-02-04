<?php

namespace App\Controller;

use App\Entity\Param;
use App\Form\ParamType;
use App\Repository\ParamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParamController extends AbstractController
{
    #[Route('/params', name: 'params')]
    public function index(ParamRepository $paramRepository): Response
    {
        return $this->render('param/index.html.twig', [
            'params' => $paramRepository->findAll(),
        ]);
    }

    #[Route('/params/create', name: 'add_param', methods: ['GET', 'POST'])]
    public function store(Request $request): Response
    {
        $param = new Param();
        $form = $this->createForm(ParamType::class, $param);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('params', ['success' => true]);
        }

        return $this->render('param/create.html.twig', [
            'form' => $form,
        ]);
    }
}
