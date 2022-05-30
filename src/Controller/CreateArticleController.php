<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleCreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateArticleController extends AbstractController
{
    #[Route('/Create_article', name: 'app_create_article')]
    public function createArticle(): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleCreateType::class, $article);

        return $this->render('create_article/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'CreateArticleController',
        ]);
    }
}
