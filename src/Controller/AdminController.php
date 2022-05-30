<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\MessageContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();

        return $this->render('admin/article.html.twig', [
            'articles' => $articles,
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(Request $request, ArticleRepository $articleRepository, $id)
    {
        $articleRepository->remove($articleRepository->find($id));
 
        return $this->redirect($this->generateUrl('admin'));
    }

    #[Route('/contact', name: 'app_admin_contact')]
    public function contact(MessageContactRepository $messageContactRepository): Response
    {
        $contacts = $messageContactRepository->findAll();

        return $this->render('admin/contact.html.twig', [
            'contacts' => $contacts,
            'controller_name' => 'AdminController',
        ]);
    }
}
