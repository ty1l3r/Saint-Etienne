<?php

namespace App\Controller;

use App\Entity\Datas;
use App\Form\MesseType;
use App\Form\TexteSeulType;
use App\Service\MaParoisse;
use App\Form\MaParoisseType;
use App\Form\RdvPaysageType;
use App\Form\RdvPortraitType;
use App\Form\ImageSeulPaysageType;
use App\Form\TexteImgPortraitType;
use App\Form\ImageSeulPortraitType;
use App\Form\TexteImagePaysageType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PublicationStep2Controller extends AbstractController
{
/**===================================================================
*===============              TEXTE SEUL                ==============
*====================================================================*/
    /**
     * @Route("/publication/step2/texte-seul", name="texteSeulStep2")
     */
    public function texteSeulForm(Request $request, ObjectManager $manager, Datas $texteSeul =null) {
        if (!$texteSeul) {
            $texteSeul = new Datas(); 
        }
       $renduLasts = $manager->createQuery(
        "SELECT u FROM App\Entity\Datas u
        WHERE u.id ='36'
        ")
        ->getResult();

    $form = $this->createForm(TexteSeulType::class, $texteSeul);
    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){    
        $texteSeul->setAuthor($this->getUser());
        $texteSeul->setRendu(8);
        $texteSeul->setCreatedAt(new \DateTime());
        $manager->persist($texteSeul);
        $manager->flush();
        $this->addFlash(
            'success',
            "           Votre annonce a bien été enregistré !");
        return $this->redirectToRoute('accueil');
    }
    {
        return $this->render('Forms/texteSeul.html.twig', [
            'form' => $form->createView(),
            'renduLasts' =>$renduLasts
        ]);
    }
}

/**===================================================================
 *=========        FORM IMAGES SEULES  PORTRAIT /PAYSAGE      ========
 *====================================================================*/
    /**
     * @Route("/publication/step2/image-seule-paysage", name="form-choice-paysage")
     */
    public function imageSeulPaysage(Request $request, ObjectManager $manager, Datas $imgSeulPaysage =null) {

        if (!$imgSeulPaysage) {
            $imgSeulPaysage = new Datas(); 
        }
    
    $form = $this->createForm(ImageSeulPaysageType::class, $imgSeulPaysage);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){ 

    $imgSeulPaysage->setAuthor($this->getUser());
    $imgSeulPaysage->setRendu(5);
    $imgSeulPaysage->setCreatedAt(new \DateTime());
    $manager->persist($imgSeulPaysage);
    $manager->flush();
    $this->addFlash(
        'success',
        "           Votre annonce a bien été publié !");
    return $this->redirectToRoute('accueil');
    }
    {
        return $this->render('Forms/imageSeulFormPaysage.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

    /**
     * @Route("/publication/step2/image-seule-portrait", name="form-choice-portrait")
     */
    public function imageSeulPortrait(Request $request, ObjectManager $manager, Datas $imgSeulPortrait =null) {

        if (!$imgSeulPortrait) {
            $imgSeulPortrait = new Datas(); 
        }

    $form = $this->createForm(ImageSeulPortraitType::class, $imgSeulPortrait);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){    
        $imgSeulPortrait->setAuthor($this->getUser());
        $imgSeulPortrait->setRendu(6);
        $imgSeulPortrait->setCreatedAt(new \DateTime());

        $manager->persist($imgSeulPortrait);
        $manager->flush();
        $this->addFlash(
            'success',
            "           Votre annonce a bien été enregistré !");
        return $this->redirectToRoute('accueil');
    }
    {
        return $this->render('Forms/imageSeulFormPortrait.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
/**===================================================================
*=================           MA PAROISSE                ==============
*====================================================================*/
    /**
     * @Route("/publication/step2/ma-paroisse", name="form-paroisse")
     */
    public function maParoisse(Request $request, ObjectManager $manager, Datas $maParoisse =null) {

        if (!$maParoisse) {
            $maParoisse = new Datas(); 
        }

    $form = $this->createForm(MaParoisseType::class, $maParoisse);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){  
        
       $file = $request->files->get('ma_paroisse')['name'];
       $upload_directory = $this->getParameter('upload_directory');
       $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move(
                $upload_directory,
                $fileName
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }
        /* sauvagarde le chemin */
        $maParoisse->setName($fileName);
        $maParoisse->setAuthor($this->getUser());
        $maParoisse->setRendu(7);
        $maParoisse->setCreatedAt(new \DateTime());
        $maParoisse->setPdf($file);
 

        $manager->persist($maParoisse);
        $manager->flush();
        $this->addFlash(
            'success',
            "           Votre annonce a bien été enregistré !");
        return $this->redirectToRoute('accueil'); 
    }
    {
        return $this->render('Forms/maParoisse.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
/**===================================================================
 *=================        RDV  PORTRAIT /PAYSAGE      ===============
 *====================================================================*/
    /**
     * @Route("/publication/step2/rdv-portrait", name="rdv-Form-Portrait")
     */
    public function rdvPortrait(Request $request, ObjectManager $manager, Datas $rdvPortrait =null) {

        if (!$rdvPortrait) {
            $rdvPortrait = new Datas(); 
        }

    $form = $this->createForm(RdvPortraitType::class, $rdvPortrait);
    $form->handleRequest($request);
       $renduLasts = $manager->createQuery(
        "SELECT u FROM App\Entity\Datas u
        WHERE u.id ='36'
        ")
        ->getResult();

    if($form->isSubmitted() && $form->isValid()){    
        $rdvPortrait->setAuthor($this->getUser());
        $rdvPortrait->setRendu(3);
        $rdvPortrait->setCreatedAt(new \DateTime());

        $manager->persist($rdvPortrait);
        $manager->flush();
        $this->addFlash(
            'success',
            "           Votre annonce a bien été enregistré !");
        return $this->redirectToRoute('accueil');
    }
    {
        return $this->render('Forms/rdvFormPortrait.html.twig', [
            'form' => $form->createView(),
            'renduLasts' =>$renduLasts
        ]);
    }
}

 /**
     * @Route("/publication/step2/rdv-paysage", name="rdv-Form-Paysage")
     */
    public function rdvPaysage(Request $request, ObjectManager $manager, Datas $rdvPaysage =null) {

        if (!$rdvPaysage) {
            $rdvPaysage = new Datas(); 
        }

    $form = $this->createForm(RdvPaysageType::class, $rdvPaysage);
    $form->handleRequest($request);
       $renduLasts = $manager->createQuery(
        "SELECT u FROM App\Entity\Datas u
        WHERE u.id ='36'
        ")
        ->getResult();

    if($form->isSubmitted() && $form->isValid()){    
        $rdvPaysage->setAuthor($this->getUser());
        $rdvPaysage->setRendu(4);
        $rdvPaysage->setCreatedAt(new \DateTime());

        $manager->persist($rdvPaysage);
        $manager->flush();
        $this->addFlash(
            'success',
            "           Votre annonce a bien été enregistré !");
        return $this->redirectToRoute('accueil');
    }
    {
        return $this->render('Forms/rdvFormPaysage.html.twig', [
            'form' => $form->createView(),
            'renduLasts' =>$renduLasts
        ]);
    }
}

/**===================================================================
 *=================   TEXTE IMAGE  PORTRAIT /PAYSAGE   ===============
 *====================================================================*/

    /**
    * @Route("/publication/step2/texte+image-portrait", name="texteEtImagesForm-Portrait")
    */
    public function texteImgPortrait(Request $request, ObjectManager $manager, Datas $texteImgPortrait =null) {

        if (!$texteImgPortrait) {
            $texteImgPortrait = new Datas(); 
        }

    $form = $this->createForm(TexteImgPortraitType::class, $texteImgPortrait);
    $form->handleRequest($request);

         $renduLasts = $manager->createQuery(
        "SELECT u FROM App\Entity\Datas u
        WHERE u.id ='36'
        ")
        ->getResult();

    if($form->isSubmitted() && $form->isValid()){    
        $texteImgPortrait->setAuthor($this->getUser());
        $texteImgPortrait->setRendu(1);
        $texteImgPortrait->setCreatedAt(new \DateTime());
        // $texteImgPortrait->setImageName($this->getImageName());
     

        $manager->persist($texteImgPortrait);
        $manager->flush();
        $this->addFlash(
            'success',
            "           Votre annonce a bien été enregistré !");
        return $this->redirectToRoute('accueil');
    }
    {
        return $this->render('Forms/texteEtImageFormPortrait.html.twig', [
            'form' => $form->createView(),
            'renduLasts' =>$renduLasts,
            
        ]);
    }
}

    /**
    * @Route("/publication/step2/texte+image-paysage", name="texteEtImagesForm-Paysage")
    */
   public function texteImgPaysage(Request $request, ObjectManager $manager, Datas $texteImgPaysage =null) {

    if (!$texteImgPaysage) {
        $texteImgPaysage = new Datas(); 
    }

$form = $this->createForm(TexteImagePaysageType::class, $texteImgPaysage);
$form->handleRequest($request);
      $renduLasts = $manager->createQuery(
        "SELECT u FROM App\Entity\Datas u
        WHERE u.id ='36'
        ")
        ->getResult();

if($form->isSubmitted() && $form->isValid()){    
    $texteImgPaysage->setAuthor($this->getUser());
    $texteImgPaysage->setRendu(2);
    $texteImgPaysage->setCreatedAt(new \DateTime());


    $manager->persist($texteImgPaysage);
    $manager->flush();
    $this->addFlash(
        'success',
        "           Votre annonce a bien été enregistré !");
    return $this->redirectToRoute('accueil');
}
{
    return $this->render('Forms/texteEtImageFormPaysage.html.twig', [
        'form' => $form->createView(),
        'renduLasts' =>$renduLasts
    ]);
}
}

/**===================================================================
*=================                Messe               =================
*====================================================================*/

    /**
     * SELECTION   
     * @Route("/admin/create-messe", name="messe")
     */
     public function messeForm(Request $request, ObjectManager $manager, Datas $imageName =null, MaParoisse $maParoisse) {

    if (!$imageName) {
        $imageName = new Datas(); 
    }
        $form2 = $this->createForm(MesseType::class, $imageName);
        $form2->handleRequest($request);
    
        if ($form2->isSubmitted() && $form2->isValid()) {  

    $imageName->setAuthor($this->getUser());
    $imageName->setRendu(9);
    $imageName->setCreatedAt(new \DateTime());
        $manager->persist($imageName);
    $manager->flush();
      $this->addFlash(
        'success',
        "           Votre annonce a bien été enregistré !");
    return $this->redirectToRoute('messes');            
        }
        return $this->render('Forms/messeForm.html.twig', [
            'form' => $form2->createView() ,     
        ]);
    } 



}
