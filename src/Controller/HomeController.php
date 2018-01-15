<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Partner;
use App\Form\Type\ContactType;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController {

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
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $form,
        RegistryInterface $doctrine
    )
    {
        $this->twig = $twig;
        $this->form = $form;
        $this->doctrine = $doctrine;
    }

    /**
     * @Route(path="/", name="homepage")
     */
    public function __invoke()
    {
        $contact = new Contact();
        $form = $this->form->createBuilder(ContactType::class, $contact)->getForm();

        $partners = $this->doctrine
            ->getRepository(Partner::class)
            ->findActive();

        return Response::create(
            $this->twig->render('home.html.twig', [
                'form' => $form->createView(),
                'partners' => $partners,
            ])
        );
    }
}