<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class FileController
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @Route(path="file/create", name="file_create")
     * @Method({"POST"})
     */
    public function create(Request $request)
    {
        $file = $request->files->get('file');

        $uploadPath = $this->container->getParameter('kernel.root_dir').'../public/uploads/';
        $file->move($uploadPath, md5($file->getClientOriginalName()).'.'.$file->getClientOriginalExtension());

        return new Response('ok');
    }

}