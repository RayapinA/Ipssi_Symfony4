<?php

namespace App\Manager;

use App\Repository\FirstArticleRepository;
use App\Entity\FirstArticle;
use Doctrine\ORM\EntityManagerInterface;


class ArticleManager
{
    private $articlerRepository;
    private $userDoctrine;

    public function __construct(FirstArticleRepository $articleRepository, EntityManagerInterface $em)
    {
        $this->articleRepository = $articleRepository;
        $this->userDoctrine = $em;
    }

    public function getAllArticle()
    {
        return $this->articleRepository->findAll();
    }
    
    public function save(FirstArticle $article)
    {
        $this->userDoctrine->persist($article);
        $this->userDoctrine->flush();
    }
}