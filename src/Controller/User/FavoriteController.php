<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Security\FavoriteVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class FavoriteController
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var TokenStorageInterface
     */
    private $token;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(
        RegistryInterface $doctrine,
        TokenStorageInterface $token,
        FlashBagInterface $flashBag,
        RouterInterface $router,
        AuthorizationCheckerInterface $authorizationChecker
    )
    {
        $this->doctrine = $doctrine;
        $this->token = $token;
        $this->flashBag = $flashBag;
        $this->router = $router;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @Route(path="favorite/{slug}/add", name="add_favorite")
     * @Security("has_role('ROLE_USER')")
     */
    public function __invoke(string $slug)
    {
        $candidate = $this->doctrine
            ->getRepository(User::class)
            ->findOneBy(['slug' => $slug])
            ->getCandidate();

        /*if (! $this->authorizationChecker->isGranted($candidate, FavoriteVoter::ADD)) {
            $this->flashBag->add('error', 'Vous ne pouvez pas ajouter cette candidate');

            return new RedirectResponse(
                $this->router->generate(
                'candidate_show', ['slug' => $slug]
                )
            );
       };*/



        $user = $this->token->getToken()->getUser();

        $user->addFavorite($candidate);

        $em = $this->doctrine->getManager();
        $em->persist($user);
        $em->flush();

        $this->flashBag->add("success", "La candidate a été ajoutée à vos favorites");

        return new RedirectResponse(
            $this->router->generate(
                'candidate_show', ['slug' => $slug]
            )
        );
    }
}