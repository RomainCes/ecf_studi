<?php

// src/Controller/LiveController.php
namespace App\Controller;

use App\Entity\Live;
use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LiveController extends AbstractController
{
    #[Route('/lives', name: 'lives_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        $liveRepository = $em->getRepository(Live::class);

        // Récupérer les filtres
        $filters = [];
        if ($request->query->get('date')) {
            $filters['date'] = new \DateTime($request->query->get('date'));
        }
        if ($request->query->get('theme')) {
            $filters['theme'] = $request->query->get('theme');
        }
        if ($request->query->get('streamer')) {
            $filters['streamer'] = $request->query->get('streamer');
        }

        // Appliquer les filtres
        $query = $liveRepository->createQueryBuilder('l');
        foreach ($filters as $key => $value) {
            $query->andWhere("l.$key = :$key")
                  ->setParameter($key, $value);
        }
        $lives = $query->getQuery()->getResult();

        return $this->render('live/index.html.twig', [
            'lives' => $lives,
        ]);
    }

    #[Route('/live/{id}', name: 'live_show', methods: ['GET', 'POST'])]
    public function show($id, EntityManagerInterface $em, Request $request): Response
    {
        $live = $em->getRepository(Live::class)->find($id);

        if (!$live) {
            throw $this->createNotFoundException('The live does not exist');
        }

        // Inscription à l'email de notification
        if ($request->isMethod('POST')) {
            $email = $request->request->get('email');
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Créer une nouvelle notification
                $notification = new Notification();
                $notification->setEmail($email);
                $notification->setLive($live);

                $em->persist($notification);
                $em->flush();

                $this->addFlash('success', 'You have been successfully subscribed to the live notification.');
            } else {
                $this->addFlash('error', 'Invalid email address.');
            }
        }

        return $this->render('live/show.html.twig', [
            'live' => $live,
        ]);
    }
}