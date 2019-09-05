<?php

/**========================= CONTROLLER ================================
 *======================================================================
 *===============  __  __     __  __     __  __     ====================  
 *=============== /\ \_\ \   /\ \/ /    /\ \_\ \    ==================== 
 *=============== \ \  __ \  \ \  _"-.  \ \  __ \   ====================
 *===============  \ \_\ \_\  \ \_\ \_\  \ \_\ \_\  ====================
 *===============   \/_/\/_/   \/_/\/_/   \/_/\/_/  ====================
 *======================================================================
 *====================================================================*/

namespace App\Controller;


use App\Entity\Datas;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{
 


    /**
     *  @Route ("/", name ="home")
     */
    
    public function home(ObjectManager $manager)
    {
      $renduAlls = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Datas u
        ORDER BY u.createdAt DESC
        ")
        ->getResult();

        return $this->render('home/index.html.twig', [
      
          'renduAlls' =>$renduAlls
          
        ]);
     
   
    }


    
      
//         $form = $this->createForm(FormRdvImgPaysageType::class, $actus);
//         $form->HandleRequest($request);

//             /* Validation du formulaire */
//             if($form->isSubmitted() && $form->isValid()) {

//                 $actus->setCreatedAt(new \DateTime());
//                 $manager->persist($actus);
//                 $manager->flush();

//                 $this->addFlash(
//                     'success', 
//                     "Votre publication a bien été ajoutée"
//                 );

//                 return $this->redirectToRoute('home');
//                 }
//             else {
//                 $this->addFlash(
//                     'danger',
//                     "Problème pendant l\'enregistrement, l\'actualité n\as pas été posté"
//                 );
//             }

//             /*EO Validation */ 


//         return $this->render('home/create.html.twig', [
//            'form' => $form->createView(),
//         ]);
//     }

 }