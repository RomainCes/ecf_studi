<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminStreamerController extends AbstractController
{
    #[Route('/admin/streamer', name: 'app_admin_streamer')]
    public function index(): Response
    {
        return $this->render('admin_streamer/index.html.twig', [
            'controller_name' => 'AdminStreamerController',
        ]);
    }
}
