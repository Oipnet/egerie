<?php
namespace App\Controller\Security;

use App\Entity\User;
use App\Event\CandidateRegisterEvent;
use App\Form\Type\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

class RegisterController {

    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $form;
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $form,
        RegistryInterface $doctrine,
        RouterInterface $router,
        EventDispatcherInterface $dispatcher,
        UserPasswordEncoderInterface $passwordEncoder,
        FlashBagInterface $flashBag
    )
    {
        $this->twig = $twig;
        $this->form = $form;
        $this->doctrine = $doctrine;
        $this->router = $router;
        $this->dispatcher = $dispatcher;
        $this->passwordEncoder = $passwordEncoder;
        $this->flashBag = $flashBag;
    }


    public function __invoke(Request $request)
    {
        $user = new User();
        $form = $this->form->createBuilder(RegisterType::class, $user)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->flush();

            $event = new CandidateRegisterEvent($user);
            $this->dispatcher->dispatch(CandidateRegisterEvent::NAME, $event);

            $this->flashBag->add(
                'success',
                'Votre inscription a bien été enregistrée. Un e-mail de validation vous a été transmis'
            );

            return new RedirectResponse($this->router->generate('homepage'));
        }

        return Response::create($this->twig->render('security/register.html.twig', [ 'form' => $form->createView()] ));
    }
}