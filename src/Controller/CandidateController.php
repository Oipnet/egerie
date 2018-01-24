<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Media;
use App\Entity\User;
use App\Event\CandidateRegisterEvent;
use App\Form\Type\CandidateType;
use App\Service\FileUploader;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
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
    /**
     * @var FormFactoryInterface
     */
    private $form;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var FileUploader
     */
    private $fileUploader;
    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        RegistryInterface $em,
        Environment $twig,
        FormFactoryInterface $form,
        EventDispatcherInterface $dispatcher,
        FlashBagInterface $flashBag,
        FileUploader $fileUploader,
        RouterInterface $router
    )
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->form = $form;
        $this->dispatcher = $dispatcher;
        $this->flashBag = $flashBag;
        $this->fileUploader = $fileUploader;
        $this->router = $router;
    }

    /**
     * @Route(path="/inscription", name="register")
     */
    public function indexAction(Request $request): Response
    {
        $candidate = new Candidate();
        $form = $this->form->createBuilder(CandidateType::class, $candidate)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $candidate = $form->getData();

            $portrait = $request->files->get('portrait');
            $portraitName = $this->fileUploader->upload($portrait);

            $mediaPortrait = new Media();
            $mediaPortrait->setFilename($portraitName);
            $mediaPortrait->setType(Media::PORTRAIT_TYPE);
            $mediaPortrait->setPath($this->fileUploader->getTargetDir());
            $mediaPortrait->setCandidate($candidate);

            $fullBody = $request->files->get('full_body');
            $fullBodyName = $this->fileUploader->upload($fullBody);

            $mediaFullBody = new Media();
            $mediaFullBody->setFilename($fullBodyName);
            $mediaFullBody->setType(Media::PLEIN_PIED_TYPE);
            $mediaFullBody->setPath($this->fileUploader->getTargetDir());
            $mediaFullBody->setCandidate($candidate);

            $em = $this->em->getManager();
            $em->persist($candidate);
            $em->persist($mediaPortrait);
            $em->persist($mediaFullBody);
            $em->flush();

            $event = new CandidateRegisterEvent($candidate);
            $this->dispatcher->dispatch(CandidateRegisterEvent::NAME, $event);

            $this->flashBag->add(
                'success',
                'Votre inscription a bien été validée ! L’équipe SUN7 BOULEVARD et E&J Prod vous souhaites bonne chance et vous recontacte bientôt pour la suite de votre aventure !'
            );

            return new RedirectResponse($this->router->generate('homepage'));
        }

        return Response::create($this->twig->render('inscription.html.twig', [ 'form' => $form->createView()] ));
    }
}