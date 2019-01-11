<?php

namespace App\Controller;

use App\Entity\FirstArticle;
use App\Form\ArticleType;
use App\Manager\ArticleManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
     public function index(ArticleManager $articleManager)
     {
        $articles = $articleManager->getAllArticle();

        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }   
    
     /**
     * @Route("/article/{id}",name="articleBy")
     */
    public function indexByName(Request $request, FirstArticle $article, ArticleManager $articleManager)
    {

       $form = $this->createForm(ArticleType::class,$article);
       $form->handleRequest($request);

       if($form->isSubmitted() &&  $form->isValid()){
            $articleManager->connect();
            $articleManager->save($article);
       }
       return $this->render('article/oneArticle.html.twig', [
           'article' => $article,
           'form' => $form->createView(),
       ]); 
           
       
   }  
}