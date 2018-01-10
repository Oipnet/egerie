<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CandidateController
{
    /**
     * @return Response
     *
     * @Route(path="/candidates", name="candidate")
     */
    public function __invoke()
    {
        return new Response('WIP');
    }
}