<?php

namespace App\EventSubscriber;

use App\Event\UserRegisterEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

class UserRegisterSubscriber implements EventSubscriberInterface
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

    public function onUserRegister(UserRegisterEvent $event)
    {
        $user = $event->getUser();

        $message = (new \Swift_Message("Confirmation d'inscription"))
            ->setFrom('emilie.sun7@yahoo.fr')
            ->setTo($user->getEmail())
            ->setBody($this->twig->render('emails/registration.html.twig', compact('user')), 'text/html');

        $this->mailer->send($message);
    }

    public static function getSubscribedEvents()
    {
        return [
           'user.register' => 'onUserRegister',
        ];
    }
}
