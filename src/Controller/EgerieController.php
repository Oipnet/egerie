<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class EgerieController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route(path="/egerie", name="egerie")
     */
    public function __invoke()
    {
        return new Response($this->twig->render('egerie.html.twig'));
    }
}
