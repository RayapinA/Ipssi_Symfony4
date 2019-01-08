<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(Request $request)
    {
        // get the Doctrine Manager
        //$em = $this->getDoctrine()->getManager();
        // Get all entities from Article table
        //$users = $em->getRepository(User::class)->findAll();

        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //$this->redirectToRoute('register success')
        }



        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView()
        ]);
    }
}
