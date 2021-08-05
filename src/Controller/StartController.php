<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class StartController extends AbstractController
{
    #[Route('/start', name: 'start')]
    public function Carusel(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $threeArticles = $entityManager->getRepository(Article::class)->findLastByArticle();
        $oneArticles = $entityManager->getRepository(Article::class)->findLastByOneArticle();
        $twoArticles = $entityManager->getRepository(Article::class)->findLastByTwoArticle();
        $freeArticles = $entityManager->getRepository(Article::class)->findLastByFreeArticle();
        $oneComments = $entityManager->getRepository(Comment::class)->findLastByoneComment();
        $twoComments = $entityManager->getRepository(Comment::class)->findLastByTwoComment();
        $threeComments = $entityManager->getRepository(Comment::class)->findLastByThreeComment();
        
        return $this->render('start/index.html.twig', [
            'threeArticles' => $threeArticles,
            'oneArticles' => $oneArticles,
            'twoArticles' => $twoArticles,
            'freeArticles' => $freeArticles,
            'oneComments' => $oneComments,
            'twoComments' => $twoComments,
            'threeComments' => $threeComments,
        ]);
    }
}
