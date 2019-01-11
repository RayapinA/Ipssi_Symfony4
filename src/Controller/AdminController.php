<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Manager\UserManager;
use App\Manager\ArticleManager;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(UserManager $userManager, ArticleManager $articleManager)
    {
        $users = $userManager->getAllUser();
        $articles = $articleManager->getAllArticle();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'articles' => $articles
        ]);
    }
}
