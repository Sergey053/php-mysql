<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'comment', methods: ['POST'])]
    public function addComment(Request $request, FileUploader $fileUploader): Response
    
    {
        $commentData = $request->request;

        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($articleData->get('article_id'));

        $comment = new Comment();
        $comment->setText($commentData->get('text'));

        // получение авторизованного пользователя из контроллера:
        // $user = $this->getUser();
        $user = $entityManager->getRepository(User::class)->find(1);

        $comment->setUser($user);
        $comment->setArticle($article);
        $entityManager->persist($comment);
        $entityManager->flush();
        return $this->json([
            'comment' => [
                'id' => $comment->getId(),
                'text' => $comment->getText(),
                'user'=> $comment->getUser()->getLogin(),
                'added'=>$comment->getAdded()->format('d.m.Y H:i:s')
            ]
        ]);


        // return $this->render('comment/index.html.twig', [
        //     'controller_name' => 'CommentController',
        // ]);
    }
}
