<?php

namespace App\Controller\User;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    public function __construct(
        RegistryInterface $doctrine,
        TokenStorageInterface $token,
        FlashBagInterface $flashBag,
        RouterInterface $router
    )
    {
        $this->doctrine = $doctrine;
        $this->token = $token;
        $this->flashBag = $flashBag;
        $this->router = $router;
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