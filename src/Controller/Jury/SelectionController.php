<?php
namespace App\Controller\Jury;

use App\Entity\Candidate;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class SelectionController
{

    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(RegistryInterface $doctrine, Environment $twig)
    {
        $this->doctrine = $doctrine;
        $this->twig = $twig;
    }

    /**
     * @Route(path="jury/selection", name="jury_selection")
     * @Security("has_role('ROLE_JURY')")
     */
    public function __invoke()
    {
        $users = $this->doctrine->getRepository(User::class)->findAllCandidates();

        return new Response($this->twig->render('jury/selection.html.twig', compact('users')));
    }
}