<?php

// src/Controller/NewsController.php
namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $newsRepository = $em->getRepository(News::class);
        $news = $newsRepository->findAll();

        return $this->render('news/index.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/news/new', name: 'news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('news_index');
        }

        return $this->render('news/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
