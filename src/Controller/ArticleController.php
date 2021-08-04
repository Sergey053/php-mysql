<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles/{id<\d+>}', name: 'article_by_id', methods:['GET'])]
    public function byId(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $articleRepository = $entityManager->getRepository(Article::class);
        $article = $articleRepository->find($id);
        $articles = $entityManager->getRepository(Article::class)->findLastByThreeArticle();
        return $this->render('article/by-id.html.twig', [
            'article' => $article,
            'articles' => $articles
        ]);
    }

    #[Route('/articles/{type}', name: 'article_by_type', methods:['GET'])]
    public function byType(string $type): Response
{
    $entityManager = $this->getDoctrine()->getManager();
    $articleRepository = $entityManager->getRepository(Article::class);
    $article = $articleRepository->$articleRepository($type);
    return $this->render('article/by-type.html.twig', [
        'article' => $article,
        'type' => $article[0]->getType()->getName()
    ]);
}
    #[Route('/articles', name: 'add-article-form', methods: ['GET'])]
public function addArticleForm(): Response
{
    // if ($this->getUser()) {
    //     return $this->redirectToRoute('article');
    // }
    return $this->render('article/add-article.html.twig');
}
    #[Route('/articles', name: 'add_article', methods: ['POST'])]
    public function addArticle(Request $request, FileUploader $fileUploader): Response
    {

        $newArticle = new Article();
        if ($request->files->get('investment') != null) {
            $investment = $fileUploader->upload($request->files->get('investment'));
            $newArticle->setInvestment($investment);
        }

        $articleData = $request->request;
        $newArticle->setTitle($articleData->get('title'));
        $newArticle->setType($articleData->get('type'));
        $newArticle->setDescription($articleData->get('description'));
        $newArticle->setPublished(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        // $type = $entityManager->getRepository(Article::class)->find($articleData->get('type_id'));
        
        

        // // получение авторизованного пользователя из контроллера:
        // $user = $this->getUser();
        $user = $entityManager->getRepository(User::class)->find(1);
    

       
        $newArticle->setUser($user);

        $entityManager->persist($newArticle);
        $entityManager->flush();

        return $this->render('article/add-article.html.twig'
        );
    }

}

