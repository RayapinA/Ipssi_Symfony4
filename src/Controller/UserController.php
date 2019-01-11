<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Manager\UserManager;
use App\Form\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(Request $request, UserManager $userManager)
    {
        $users = $userManager->getAllUser();

        $user = new User();
        $form = $this->createForm(RegisterUserType::class,$user);
        $form->handleRequest($request);


        if($form->isSubmitted() &&  $form->isValid()){
            $userManager->connect();
            $userManager->save($user);
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
            'users' => $users,
        ]);
    }

    /**
     * @Route("/user/{firstname}", name="userby")
     */
    public function indexById(Request $request, User $user)
    {
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        return $this->render('user/oneUser.html.twig', [
            'user' => $user,
        ]);
    }
    
}
