<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 10/01/18
 * Time: 18:06
 */

namespace App\Controller;


use App\Entity\Partner;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class PartnerController
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

    public function footerAction()
    {
        $partners = $this->doctrine->getRepository(Partner::class)->findActive();

        return new Response($this->twig->render('partner.html.twig', compact('partners')));
    }
}