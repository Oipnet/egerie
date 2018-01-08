<?php

namespace App\Controller\User;

use App\Entity\Candidate;
use App\Form\CandidateType;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CandidateController
{
    /**
     * @var FormFactoryInterface
     */
    private $form;
    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(TokenStorageInterface $token, RouterInterface $router, RegistryInterface $doctrine, Environment $twig, FormFactoryInterface $form)
    {
        $this->token = $token;
        $this->twig = $twig;
        $this->form = $form;
        $this->doctrine = $doctrine;
        $this->router = $router;
    }

    /**
     * @Route(path="user/participate", name="user_candidate")
     * @Security("has_role('ROLE_USER')")
     */
    public function __invoke(Request $request)
    {
        $user = $this->token->getToken()->getUser();

        $candidate = new Candidate();
        $form = $this->form->createBuilder(CandidateType::class, $candidate)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate = $form->getData();

            $user->setCandidate($candidate);

            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();

            return new RedirectResponse($this->router->generate('homepage'));
        }

        return Response::create($this->twig->render('user/candidate.html.twig', [ 'form' => $form->createView()] ));
    }

}