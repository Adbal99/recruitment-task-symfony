<?php

namespace App\EventSubscriber;

use App\Repository\ExamRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct
    (
        private readonly Environment    $twig,
        private readonly ExamRepository $examRepository,
    ){}

    public function onControllerEvent(ControllerEvent $event): void
    {
//        $this->twig->addGlobal('exams', $this->examRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onControllerEvent',
        ];
    }
}
