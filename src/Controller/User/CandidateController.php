<?php

namespace App\Controller\User;

use App\Entity\Candidate;
use App\Entity\Media;
use App\Entity\User;
use App\Form\Type\CandidateType;
use App\Service\FileUploader;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
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
    /**
     * @var FileUploader
     */
    private $fileUploader;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;

    public function __construct(
        TokenStorageInterface $token,
        RouterInterface $router,
        RegistryInterface $doctrine,
        Environment $twig,
        FormFactoryInterface $form,
        FileUploader $fileUploader,
        FlashBagInterface $flashBag
    )
    {
        $this->token = $token;
        $this->twig = $twig;
        $this->form = $form;
        $this->doctrine = $doctrine;
        $this->router = $router;
        $this->fileUploader = $fileUploader;
        $this->flashBag = $flashBag;
    }

    /**
     * @Route(path="user/participate", name="user_candidate")
     * @Security("has_role('ROLE_USER')")
     */
    public function participate(Request $request)
    {
        $user = $this->token->getToken()->getUser();

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

            $user->setCandidate($candidate);

            $em = $this->doctrine->getManager();
            $em->persist($user);
            $em->persist($mediaPortrait);
            $em->persist($mediaFullBody);
            $em->flush();

            $this->flashBag->add('success', 'Votre candidature a été enregistrée');

            return new RedirectResponse($this->router->generate('user_profil'));
        }

        return Response::create($this->twig->render('user/candidate.html.twig', [ 'form' => $form->createView()] ));
    }

    /**
     * @Route(path="user/toggle/{user}", name="user_toggle")
     * @Security("has_role('ROLE_JURY')")
     */
    public function toggle(User $user)
    {
        $user->getCandidate()->setIsSelected(
            ! $user->getCandidate()->isSelected()
        );

        $em = $this->doctrine->getManager();
        $em->persist($user);
        $em->flush();

        return new RedirectResponse($this->router->generate('jury_selection'));
    }
}
