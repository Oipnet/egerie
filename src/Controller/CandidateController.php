<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CandidateController
{
    /**
     * @var ManagerRegistry
     */
    private $em;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(
        RegistryInterface $em,
        Environment $twig
    )
    {
        $this->em = $em;
        $this->twig = $twig;
    }

    /**
     * @return Response
     *
     * @Route(path="/candidates", name="candidate")
     */
    public function indexAction(): Response
    {
        return new Response('WIP');
    }

    /**
     * @return Response
     *
     * @Route(path="/candidates/{slug}", name="candidate_show")
     */
    public function showAction($slug): Response
    {
        $user = $this->em
            ->getRepository(User::class)
            ->findOneBy(['slug' => $slug]);

        return new Response(
            $this->twig->render('candidate_show.html.twig', compact("user"))
        );
    }
}