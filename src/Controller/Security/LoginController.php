<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\Type\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class LoginController
{
    /**
     * @var AuthenticationUtils
     */
    private $authUtils;
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $form;

    public function __construct(AuthenticationUtils $authUtils, Environment $twig, FormFactoryInterface $form)
    {
        $this->authUtils = $authUtils;
        $this->twig = $twig;
        $this->form = $form;
    }

    /**
     * @Route(path="/login", name="login")
     */
    public function __invoke(Request $request)
    {
        $error = $this->authUtils->getLastAuthenticationError();
        $lastUsername = $this->authUtils->getLastUsername();

        $user = new User();
        $form = $this->form->createBuilder(LoginType::class, $user)->getForm();

        return new Response($this->twig->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'form' => $form->createView(),
        ]));
    }
}