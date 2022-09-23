<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private string $version = 'v1.0';
    //ajout de la version en tant que var globale de twig

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function onControllerEvent(ControllerEvent $event): void
    {
        $this->twig->addGlobal('version', $this->version);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
