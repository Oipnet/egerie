<?php

namespace App\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class ProfilController
{
    /**
     * @var TokenStorageInterface
     */
    private $token;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(TokenStorageInterface $token, Environment $twig)
    {
        $this->token = $token;
        $this->twig = $twig;
    }

    /**
     * @Route(path="/user/profil", name="user_profil")
     */
    public function index()
    {
        $user = $this->token->getToken()->getUser();

        return new Response($this->twig->render('user/profil.html.twig', compact('user')));
    }

}