<?php

namespace App\Controller;

use DateTime;
use App\Entity\Article;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Form\ArticleCreateType;
use App\Repository\ArticleRepository;
use App\Repository\CommentaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/create', name: 'app_create_article')]
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

        return $this->render('article/create.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'CreateArticleController',
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
