<?php

namespace App\Controller\Security;

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

    public function __construct(AuthenticationUtils $authUtils, Environment $twig)
    {
        $this->authUtils = $authUtils;
        $this->twig = $twig;
    }

    /**
     * @Route(path="/login", name="login")
     */
    public function __invoke(Request $request)
    {
        $error = $this->authUtils->getLastAuthenticationError();
        $lastUsername = $this->authUtils->getLastUsername();

        return new Response($this->twig->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]));
    }
}