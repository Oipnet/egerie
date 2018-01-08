<?php

namespace App\Controller\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ConfirmationController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var AuthenticationManagerInterface
     */
    private $auth;

    private $providerKey;
    /**
     * @var TokenStorageInterface
     */
    private $token;

    public function __construct(EntityManagerInterface $em, AuthenticationManagerInterface $auth, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->auth = $auth;
        $this->token = $token;
    }

    /**
     * @Route(path="/user/confirm/{token}", name="user_confirm")
     */
    public function __invoke(string $token, Request $request)
    {
        $manager = $this->em->getRepository(User::class);

        $user = $manager->findOneBy(['confirmationToken' => $token]);

        if ($user) {
            $user->setIsActive(true);
            $user->setConfirmationToken(null);

            $this->em->persist($user);
            $this->em->flush();

            $unauthenticatedToken = new UsernamePasswordToken(
                $user, $user->getPassword(), 'main'
            );


            $authenticatedToken = $this->auth->authenticate($unauthenticatedToken);

            $this->token->setToken($authenticatedToken);
        }

        return new RedirectResponse('/');
    }

}