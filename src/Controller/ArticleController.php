<?php

namespace App\Controller;

use App\Entity\FirstArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        // get the Doctrine Manager
        $em = $this->getDoctrine()->getManager();
        // Get all entities from Article table
        $articles = $em->getRepository(FirstArticle::class)->findAll();
        //FindBy Permet de recuperer les articles publié
        $articlesPublished = $em->getRepository(FirstArticle::class)->findBy(['published' => false]);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articlesPublished,
        ]);
    }
}       
