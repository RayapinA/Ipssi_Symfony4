<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegisterUserType;
use App\Form\LoginUserType;
use App\Form\ProfileUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        $form = $this->createForm(RegisterUserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $password = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');

            //$this->redirectToRoute('register success')
        }

        return $this->render('security/register.html.twig', [
            'controller_name' => 'SecurityController',
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $user = new User();
        $form = $this->createForm(LoginUserType::class,$user);

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */

    public function profile(Request $request,EntityManagerInterface $entityManager)
    {

        $user = $this->getUser();
        $form = $this->createForm(ProfileUserType::class,$user);
        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('home');

            //$this->redirectToRoute('register success')
        }
        dump($user);exit();
        return $this->render('security/profile.html.twig', [
            'controller_name' => 'SecurityController',
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
