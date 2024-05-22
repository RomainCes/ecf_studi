<?php

// src/Controller/StreamerController.php
namespace App\Controller;

use App\Entity\Live;
use App\Form\LiveFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StreamerController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/streamer/home", name="streamer_home")
     */
    public function home(): Response
    {
        // Récupération des lives à partir de la base de données
        $lives = $this->entityManager->getRepository(Live::class)->findAll();

        return $this->render('streamer/home.html.twig', [
            'lives' => $lives,
        ]);
    }

    /**
     * @Route("/streamer/live_form", name="streamer_live_form")
     */
    public function liveForm(Request $request): Response
    {
        $live = new Live();
        $form = $this->createForm(LiveFormType::class, $live);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Lier le live au streamer connecté
            $streamer = $this->getUser(); // Assurez-vous que l'utilisateur connecté est un streamer
            $live->setStreamer($streamer);

            // Traitement du formulaire
            $this->entityManager->persist($live);
            $this->entityManager->flush();

            $this->addFlash('success', 'Live enregistré avec succès.');

            // Redirection vers la page d'accueil après l'enregistrement
            return $this->redirectToRoute('streamer_home');
        }

        return $this->render('streamer/live_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/streamer/statistics", name="streamer_statistics")
     */
    public function statistics(): Response
    {
        // Récupération des données statistiques à partir de votre source de données
        $statistics = [
            ['live' => 'Live 1', 'date' => new \DateTime(), 'visitors' => 100],
            ['live' => 'Live 2', 'date' => new \DateTime(), 'visitors' => 150],
            // Ajoutez d'autres données statistiques ici
        ];

        return $this->render('streamer/statistics.html.twig', [
            'statistics' => $statistics,
        ]);
    }
}
