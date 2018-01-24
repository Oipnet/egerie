<?php

namespace App\EventSubscriber;

use App\Event\CandidateRegisterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

class CandidateRegisterSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function onCandidateRegister(CandidateRegisterEvent $event)
    {
        $candidate = $event->getCandidate();

        $message = (new \Swift_Message("Confirmation d'inscription"))
            ->setFrom('emilie.sun7@yahoo.fr')
            ->setTo($candidate->getEmail())
            ->setBody($this->twig->render('emails/inscription.html.twig', compact('user')), 'text/html');

        $this->mailer->send($message);
    }

    public static function getSubscribedEvents()
    {
        return [
            CandidateRegisterEvent::NAME => 'onCandidateRegister',
        ];
    }
}
