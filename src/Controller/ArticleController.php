<?php

namespace App\Controller;

use App\Entity\FirstArticle;
use App\Form\ArticleType;
use App\Repository\FirstArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */

     public function index(Request $request, FirstArticleRepository $articleRepository)
     {
        $articles = $articleRepository->findAll();

        $article = new FirstArticle();
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);


        if($form->isSubmitted() &&  $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();


            unset($entityManager);
            unset($form);
            $entityManager = $this->getDoctrine()->getManager();
            $form = $this->createForm(ArticleType::class,$article);

            //$this->redirectToRoute('register success')
        }

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'form' => $form->createView(),
            'articles' => $articles,
        ]);
    }   
    
     /**
     * @Route("/article/{{name}}", name="article")
     */

    public function indexByName(Request $request, FirstArticleRepository $articleRepository)
    {
       $articles = $articleRepository->findAll();

       $article = new FirstArticle();
       $form = $this->createForm(ArticleType::class,$article);
       $form->handleRequest($request);


       if($form->isSubmitted() &&  $form->isValid()){
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($article);
           $entityManager->flush();


           unset($entityManager);
           unset($form);
           $entityManager = $this->getDoctrine()->getManager();
           $form = $this->createForm(ArticleType::class,$article);

           //$this->redirectToRoute('register success')
       }

       return $this->render('article/index.html.twig', [
           'controller_name' => 'ArticleController',
           'form' => $form->createView(),
           'articles' => $articles,
       ]);
   }  
}