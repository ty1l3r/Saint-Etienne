<?php
/**========================= CONTROLLER ================================
 *======================================================================
 *===============  __  __     __  __     __  __     ====================  
 *=============== /\ \_\ \   /\ \/ /    /\ \_\ \    ==================== 
 *=============== \ \  __ \  \ \  _"-.  \ \  __ \   ====================
 *===============  \ \_\ \_\  \ \_\ \_\  \ \_\ \_\  ====================
 *===============   \/_/\/_/   \/_/\/_/   \/_/\/_/  ====================
 *======================================================================
*================ CONTROLLER  QUI GERE LES FORMUALIRES =================
 *====================================================================*/

namespace App\Controller;

use App\Entity\Datas;
use App\Entity\Selection;
use App\Form\FormCheckType;
use App\Form\SelectionType;
use App\Form\TexteSeulType;
use App\Entity\SelectionImages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**===================================================================
 *=================        FORM 1        =============================
 *====================================================================*/
class PublicationController extends AbstractController
{   
    /**
     * @Route("/admin/create-etape-1", name="accueil")
     * 
     */
    public function index(Request $request)
    {   
        $selections = new Selection();
        $form = $this->createForm(SelectionType::class);
        $form->handleRequest($request, $selections);
        dump($form);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $selections = $request->request->get('selection'); 
            $selections = $selections['selection'];
    
            if($selections == ('image'))
            {
                return $this->redirectToRoute('imageSeuleForm');
            }
            if($selections == ('texte'))
            {
                return $this->redirectToRoute('texteSeulStep2');
            }
            if($selections == ('texteEtImg'))
            {
                return $this->redirectToRoute('textesEtImagesForm');
            }
            if($selections == ('rdv'))
            {
                return $this->redirectToRoute('rdvForm');
            }
            if($selections == ('maParoisse'))
            {
                return $this->redirectToRoute('form-paroisse');
            }

        }
        return $this->render('publication/step1.html.twig', [
            'form' => $form->createView() ,  
            'selection' => $selections  
        ]);
    }
        
/**===================================================================
 *=================        FORM IMAGES SEULES        =================
 *====================================================================*/

    /**
     * SELECTION   
     * @Route("/admin/create-image-selection", name="imageSeuleForm")
     */
    public function imgSeuleForm(Request $request){

        $selectionImage = new SelectionImages();
        $form2 = $this->createForm(FormCheckType::class);
        $form2->handleRequest($request, $selectionImage);
    
        if ($form2->isSubmitted() && $form2->isValid()) {  

            $selectionImage = $request->request->get('form_check'); 
                                $selectionImage = $selectionImage['selections'];
            if($selectionImage == ('paysage'))
            {
                         return $this->redirectToRoute('form-choice-paysage');
            }
            if($selectionImage == ('portrait'))
            {
                                return $this->redirectToRoute('form-choice-portrait');
            }
        }
        return $this->render('publication/imageSeulForm1.html.twig', [
            'form' => $form2->createView() ,
            'selectionImage' => $selectionImage
        ]);
    } 
   
/**===================================================================
 *=================         TEXTES ET IMAGES         =================
 *====================================================================*/

    /**
     * SELECTION   
     * @Route("/admin/create-ti-selection", name="textesEtImagesForm")
     */
    public function textesEtImagesForm(Request $request){

        $selectionImage = new SelectionImages();
        $form2 = $this->createForm(FormCheckType::class);
        $form2->handleRequest($request, $selectionImage);
    
        if ($form2->isSubmitted() && $form2->isValid()) {  

            $selectionImage = $request->request->get('form_check'); 
            $selectionImage = $selectionImage['selections'];
            if($selectionImage == ('paysage'))
            {
                return $this->redirectToRoute('texteEtImagesForm-Paysage');
            }
            if($selectionImage == ('portrait'))
            {
                return $this->redirectToRoute('texteEtImagesForm-Portrait');
            }
        }
        return $this->render('publication/imageSeulForm1.html.twig', [
            'form' => $form2->createView() ,
            'selectionImage' => $selectionImage
        ]);
    } 
 
/**===================================================================
*=================                RDV                =================
*====================================================================*/

    /**
     * SELECTION   
     * @Route("/admin/create-rdv-selection", name="rdvForm")
     */
    public function rdvForm(Request $request){

        $selectionRDV = new SelectionImages();
        $form2 = $this->createForm(FormCheckType::class);
        $form2->handleRequest($request, $selectionRDV);
    
        if ($form2->isSubmitted() && $form2->isValid()) {  

            $selectionRDV = $request->request->get('form_check'); 
            $selectionRDV = $selectionRDV['selections'];
            if($selectionRDV == ('paysage'))
            {
                return $this->redirectToRoute('rdv-Form-Paysage');
            }
            if($selectionRDV == ('portrait'))
            {
                return $this->redirectToRoute('rdv-Form-Portrait');
            }
        }
        return $this->render('publication/imageSeulForm1.html.twig', [
            'form' => $form2->createView() ,
            'selectionImage' => $selectionRDV
        ]);
    } 

} //EO ALL