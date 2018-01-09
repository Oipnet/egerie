<?php

namespace App\EventSubscriber;

use App\Event\ContactEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;

class ContactSubscriber implements EventSubscriberInterface
{
    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendEmailToAdmin(ContactEvent $event)
    {
        $contact = $event->getContact();

        $message = (new \Swift_Message("Nouvelle demande de contact"))
            ->setFrom($contact->getAuthor())
            ->setTo('emilie.sun7@yahoo.fr')
            ->setBody($this->twig->render('emails/admin/contact.html.twig', compact('contact')), 'text/html');

        $this->mailer->send($message);
    }

    public function sendEmailToAuthor(ContactEvent $event)
    {
        $contact = $event->getContact();

        $message = (new \Swift_Message("Demande de contact"))
            ->setFrom('emilie.sun7@yahoo.fr')
            ->setTo($contact->getAuthor())
            ->setBody($this->twig->render('emails/contact.html.twig', compact('contact')), 'text/html');

        $this->mailer->send($message);
    }

    public static function getSubscribedEvents()
    {
        return [
           'app.contact' => [
               ['sendEmailToAdmin', 10],
               ['sendEmailToAuthor', -10]
           ]
        ];
    }
}
