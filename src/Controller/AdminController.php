<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UserRepository;
use App\Repository\FirstArticleRepository;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserRepository $userRepository, FirstArticleRepository $articleRepository)
    {
        $users = $userRepository->findAll();
        $articles = $articleRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'articles' => $articles
        ]);
    }
}
