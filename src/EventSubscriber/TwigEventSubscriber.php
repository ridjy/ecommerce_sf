<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;
use App\Entity\Citation;
use Doctrine\ORM\EntityManagerInterface;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private string $version = 'v1.0';
    //ajout de la version en tant que var globale de twig

    public function __construct(Environment $twig,EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->em = $em;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('version', $this->version);
        $o_citation = $this->em->getRepository(Citation::class)->findRandom();
        $this->twig->addGlobal('citation', $o_citation->getCitation());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
