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

class MediaController
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
     * @Route(path="/media", name="media")
     */
    public function __invoke()
    {

        return new Response($this->twig->render('media.html.twig'));
    }
}