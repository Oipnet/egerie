<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 22/01/18
 * Time: 14:36
 */

namespace App\Controller;

use App\Entity\Partner;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PresentationController
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
     * @Route(path="/presentation", name="presentation")
     */
    public function __invoke()
    {

        return new Response($this->twig->render('presentation.html.twig'));
    }
}