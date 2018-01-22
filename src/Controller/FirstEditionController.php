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

class FirstEditionController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    public function __construct(Environment $twig, RegistryInterface $doctrine)
    {
        $this->twig = $twig;
        $this->doctrine = $doctrine;
    }

    /**
     * @Route(path="/1er-edition", name="first_edition")
     */
    public function __invoke()
    {
        $partners = $this->doctrine
            ->getRepository(Partner::class)
            ->findActive();

        return new Response($this->twig->render('first_edition.html.twig',
            ['partners' => $partners,]
        ));
    }
}