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
use App\Service\MaParoisse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     *  @Route ("/", name ="home")
     */   
    public function home(ObjectManager $manager, MaParoisse $maParoisse)
    {
      $renduAlls = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Datas u
        ORDER BY u.createdAt DESC
        ")
        ->getResult();

    // Service MaParoisse
    $result = $maParoisse->getMaParoisse();
     
        return $this->render('home/index.html.twig', [
      
          'renduAlls' =>$renduAlls,
          'renduLasts' => $result
          
        ]);
    }

    /**
     * Retourne à lapage d'accueil sans le carousel
     *  @Route ("/accueil", name ="accueil")
     */
    public function accueil(ObjectManager $manager, MaParoisse $maParoisse)
    { 
    // Service MaParoisse
    $result = $maParoisse->getMaParoisse();

      $renduAlls = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Datas u
        ORDER BY u.createdAt DESC
        ")
        ->getResult();

        return $this->render('home/index2.html.twig', [
      
          'renduAlls' => $renduAlls,
          'renduLasts' => $result
          
        ]); 
    }

    /**
     *  
     * @Route("/horaire-des-messes", name="messes")
     */
     public function messe(Request $request, ObjectManager $manager, Datas $imageName =null, MaParoisse $maParoisse) {
    
    // Service MaParoisse
    $result = $maParoisse->getMaParoisse();

        $renduAlls = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Datas u
        WHERE u.rendu = '9'
        ORDER BY u.createdAt DESC
        ")
        ->getResult();

    return $this->render('content/messe.html.twig', [
            
             'renduAlls' =>$renduAlls,
              'renduLasts' => $result
        ]);

     }
  
 }