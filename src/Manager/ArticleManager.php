<?php

namespace App\Manager;

use App\Repository\FirstArticleRepository;
use App\Entity\FirstArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleManager extends AbstractController
{
    private $articlerRepository;

    public function __construct(FirstArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function getAllArticle()
    {
        return $this->articleRepository->findAll();
    }

    public function connect()
    {
        return $this->getDoctrine()->getManager();
    }
    
    public function save(FirstArticle $article)
    {
        $this->getDoctrine()->getManager()->persist($article);
        $this->getDoctrine()->getManager()->flush();
    }
}