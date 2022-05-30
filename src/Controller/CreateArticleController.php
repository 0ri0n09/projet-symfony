<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleCreateType;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateArticleController extends AbstractController
{
    #[Route('/Create_article', name: 'app_create_article')]
    public function createArticle(Request $request, ManagerRegistry $doctrine): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleCreateType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $article->setIdUser($this->getUser());
            $article->setCreateTime(new DateTime());
            $manager = $doctrine->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('app_liste_article');
        }

        return $this->render('create_article/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'CreateArticleController',
        ]);
    }
}
