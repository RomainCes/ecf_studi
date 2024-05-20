<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobalLivesController extends AbstractController
{
    /**
     * @Route("/global-lives", name="global_lives")
     */
    public function index(): Response
    {
        return $this->render('global_lives.html.twig');
    }

    public function showDetailedLive($id): Response
    {
        return $this->render('detailed_live.html.twig', [
            'id' => $id,
        ]);
    }
}
