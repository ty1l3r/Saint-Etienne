<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;
class AccountController extends AbstractController
{
    /**
     * Permet d'afficher et de gérer le formulaire de connexion
     * 
     * @Route("/compte/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils){

        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        dump($error);

        return $this->render('account\login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username   
        ]);
    }

    /**
    * @Route("/logout", name="account_logout")
    * 
    */

    public function logout(){
        //rien
    }

    /**
     * Permet d'afficher le formulaire d'inscription
     *
     * @Route("/compte/register", name="account_register")
     * 
     * @return Reponse
     */
    public function register(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
 
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                "           Votre compte a bien été enregistré. Vous pouvez maintenant vous connecter !");
            return $this->redirectToRoute('account_login');
        }
  
        return $this->render('account/registration.html.twig', [
            'form' => $form->createView()
        ]);
        
    }

    /**
     * Permet d'éditer le profil
     * 
     * @Route("/compte/profile", name="account_profile")
     *
     * @return Respone
     */
    public function profile(Request $request, ObjectManager $manager) {

        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request); 

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                " Votre profil à bien été modifié");

        }

        return $this->render('account/profile.html.twig', [
            'form' => $form->createView()
        ]);
 
    }


    /**
    * Permet de modifier le mot de passe
    * 
    *@Route("/compte/update", name="account_password")
    * 
    * @return Response
    */

   public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder, ObjectManager $manager) {

    $passwordUpdate = new PasswordUpdate();
    $user = $this->getUser();
    $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);
    $form->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()) {
        
        if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash() )){
            $form->get('oldPassword')->addError(new FormError("le mot de passe est incorect"));
            //gérer l'erreur
        }  else {    
            $newPassword = $passwordUpdate->getNewPassword();
            $hash = $encoder->encodePassword($user, $newPassword);
            $user->setHash($hash);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre mot de passe à bien été mmodifié!"
            );
            return $this->redirectToRoute('home');
        }         
    }
    return $this->render('account/password.html.twig', [
        'form' => $form->createView()
    ]);
}


}
