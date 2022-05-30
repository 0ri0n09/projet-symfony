<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_liste_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->FindAll();

        return $this->render('article/list.html.twig', [
            "article" => $article,
            'controller_name' => 'ListeArticleController',
        ]);
    }

    #[Route('/{id}', name: 'app_article_detail')]
    public function acteurDetail($id, ArticleRepository $articleRepository, CommentaireRepository $commentaireRepository)
    {
        $article = $articleRepository->find($id);

        $commentaires = $commentaireRepository->findBy(array("id_article" => $article));

        $commentaire = new Commentaire();

        $form = $this->createForm(CommentaireType::class, $commentaire);

        return $this->render('/article/detail.html.twig', [
            "commentaire" => $commentaires,
            "form" => $form->createView(),
            "article" => $article
        ]);
    }
}
