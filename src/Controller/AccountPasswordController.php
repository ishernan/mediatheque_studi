<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager= $entityManager;
    }

    #[Route('/compte/changer-password', name: 'account_password')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $old_mdp = $form->get('old_password')->getData();

            if($passwordHasher->isPasswordValid($user, $old_mdp)){
                $new_mdp = $form->get('new_password')->getData();
                $password = $passwordHasher->hashPassword($user,$new_mdp);

                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $message = "Votre mot de passe a été mis à jour !";
            } else {
                $message = 'Votre mot de passe est incorrect';
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'message' => $message
        ]);
    }
}
