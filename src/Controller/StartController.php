<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StartController extends AbstractController
{
    #[Route('/start', name: 'start')]
    public function Carusel(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $threeArticles = $entityManager->getRepository(Article::class)->findLastByThreeArticle();
        return $this->render('start/index.html.twig', [
            'threeArticles' => $threeArticles,
        ]);
    }
}
