<?php
/**
 * Created by PhpStorm.
 * User: arnaud
 * Date: 22/01/18
 * Time: 14:36
 */

namespace App\Controller;

use App\Entity\Partner;
use App\Form\Type\PartnerType;
use App\Service\FileUploader;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

class PartnerController
{
    /**
     * @var Environment
     */
    private $twig;
    /**
     * @var FormFactoryInterface
     */
    private $form;
    /**
     * @var FileUploader
     */
    private $fileUploader;
    /**
     * @var RegistryInterface
     */
    private $doctrine;
    /**
     * @var FlashBagInterface
     */
    private $flashBag;
    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(
        Environment $twig,
        FormFactoryInterface $form,
        FileUploader $fileUploader,
        RegistryInterface $doctrine,
        FlashBagInterface $flashBag,
        RouterInterface $router
    )
    {
        $this->twig = $twig;
        $this->form = $form;
        $this->fileUploader = $fileUploader;
        $this->doctrine = $doctrine;
        $this->flashBag = $flashBag;
        $this->router = $router;
    }

    /**
     * @Route(path="/partenaire", name="partner")
     */
    public function partner2017Action()
    {

        return new Response($this->twig->render('partner.html.twig'));
    }

    /**
     * @Route(path="/partenaire-2018", name="partner_2018")
     */
    public function partner2018Action()
    {
        $partners = $this->doctrine->getRepository(Partner::class)->findActive();

        return new Response($this->twig->render('partner_2018.html.twig', compact("partners")));
    }

    /**
     * @Route(path="/devenir-partenaire", name="become_partner")
     */
    public function becomePartnerAction(Request $request)
    {
        $partner = new Partner();
        $form = $this->form->createBuilder(PartnerType::class, $partner)->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $partner = $form->getData();

            $logo = $request->files->get('logo');
            $logoName = $this->fileUploader->upload($logo);

            $partner->setLogo($logoName);

            $em = $this->doctrine->getManager();
            $em->persist($partner);
            $em->flush();

            $this->flashBag->add(
                'success',
                'Votre demande a bien été enregistrée'
            );

            return new RedirectResponse($this->router->generate('homepage'));
        }

        return new Response($this->twig->render('become_partner.html.twig', ['form' => $form->createView()]));
    }
}