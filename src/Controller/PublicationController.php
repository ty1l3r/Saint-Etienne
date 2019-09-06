<?php

namespace App\Controller;

use App\Entity\Selection;
use App\Form\SelectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class PublicationController extends AbstractController
{   

 
    /**
     * @Route("/admin/create", name="accueil")
     * 
     * 
     */
    public function index(Request $request)
    {   
        $selections = new Selection();
        $form = $this->createForm(SelectionType::class);
        $form->handleRequest($request, $selections);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $selections = $request->request->get('selection');
            dump($selections); 
            $selections = $selections['selection'];
            dump($selections); 

            if($selections == ('image'))
            {
                return $this->redirectToRoute('form-imageSeule');
            }
            if($selections == ('texte'))
            {
                return $this->redirectToRoute('form-texteSeul');
            }
            if($selections == ('texteEtImg'))
            {
                return $this->redirectToRoute('');
            }
            if($selections == ('rdv'))
            {
                return $this->redirectToRoute('');
            }
            if($selections == ('maParoisse'))
            {
                return $this->redirectToRoute('');
            }

        }
        return $this->render('publication/step1.html.twig', [
            'form' => $form->createView() ,  
            'selection' => $selections  
        ]);
        }


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