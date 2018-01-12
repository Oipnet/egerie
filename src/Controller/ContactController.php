<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Event\ContactEvent;
use App\Form\Type\ContactType;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class ContactController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $form;
    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(Environment $twig, FormFactoryInterface $form, RegistryInterface $doctrine, RouterInterface $router, EventDispatcherInterface $dispatcher)
    {
        $this->twig = $twig;
        $this->form = $form;
        $this->doctrine = $doctrine;
        $this->router = $router;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route(path="contact", name="contact")
     * @Method({"POST"})
     */
    public function __invoke(Request $request)
    {
        $contact = new Contact();
        $form = $this->form->createBuilder(ContactType::class, $contact)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $em = $this->doctrine->getManager();
            $em->persist($contact);
            $em->flush();

            $event = new ContactEvent($contact);
            $this->dispatcher->dispatch(ContactEvent::NAME, $event);
        }

        return new RedirectResponse($this->router->generate('homepage'));
    }
}