<?php

namespace App\Controller;


use App\Entity\Selection;
use App\Form\SelectionType;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PublicationController extends AbstractController
{   

    /**
     * @Route("/admin/create", name="accueil")
     */
    public function index(Request $request)
    {   
        $selection = new Selection();
        $form = $this->createForm(SelectionType::class);
        $form->handleRequest($request, $selection);

        
        //recupération du choix utilisateur
        $selection = $request->request->get('selection');
        dump($selection);
      
        if ($form->isSubmitted() && $form->isValid()) {

        // if($selection->getTexteEtImg()){
        //     dump($selection);
        // }
   
        //reçois toutes les infromations du formulaire :    
        // $form->getData();
        // dump($form);

        // isole le choix de l'utilisateur

        // $form->$request->get('image');
        // dump($form);
           
        // if($request->request->get('image')){
            // return $this->redirectToRoute('home');
       
        // } else{
        //     return $this->redirectToRoute('account_profile');
        //  }
        // if($form->getData('texteEtImage')){
        //     return $this->redirectToRoute('autre');
        // }
        
        //etc..

        }

        return $this->render('publication/step1.html.twig', [
        'form' => $form->createView() ,  
        'selection' => $selection  
    ]);
    }

//     /**
//      * @Route("/admin/create", name="image")
//      */
//     public function selectImage(Request $request, Selection $selection =null)
//     {   
             
//         $form = $this->createForm(SelectionType::class, $selection);
//         $form->handleRequest($request); 
        
        
//         if ($form->isSubmitted() && $form->isValid())
//      {
       
//             return $this->redirectToRoute('form-texteSeul');
            
//     }
        
//         return $this->render('publication/step1.html.twig', [
//         'form' => $form->createView(),
    
//     ]);
// }
        


// =======FORMULAIRE EXTERIEURS=========

    /**
     * @Route("/admin/create/formulaire-image", name="form-imageSeule")
     */
    public function formImageSeule(){
        return $this->render('publication/formulaireImageSeule.html.twig', [
            
        ]);
    }     

    /**
     * @Route("/admin/create/formulaire-texte", name="form-texteSeul")
     */
    public function formTexteSeul(){
        return $this->render('publication/formulaireTexteSeul.html.twig', [
            
        ]);
    }            




}