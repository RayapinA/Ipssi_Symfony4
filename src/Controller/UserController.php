<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $users = $userRepository->findAll();

        //dump($users);exit();
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);


        if($form->isSubmitted() &&  $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            unset($entityManager);
            unset($form);
            $entityManager = $this->getDoctrine()->getManager();
            $form = $this->createForm(UserType::class,$user);

            //$this->redirectToRoute('register success')
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/{firstname}", name="userby")
     */
    public function indexById(Request $request, UserRepository $userRepository, User $user)
    {
        
        //$currentUser = $userRepository->findBy('id');
        //$user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);


        if($form->isSubmitted() &&  $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            unset($entityManager);
            unset($form);
            $entityManager = $this->getDoctrine()->getManager();
            $form = $this->createForm(UserType::class,$user);

            //$this->redirectToRoute('register success')
        }

        return $this->render('user/oneUser.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
        ]);
    }
    
}
