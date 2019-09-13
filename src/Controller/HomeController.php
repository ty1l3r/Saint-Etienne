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

    /**
     * Retourne à lapage d'accueil sans le carousel
     * 
     *  @Route ("/accueil", name ="accueil")
     */
    public function accueil(ObjectManager $manager)
    {
      $renduAlls = $manager->createQuery(
        "SELECT u
        FROM App\Entity\Datas u
        ORDER BY u.createdAt DESC
        ")
        ->getResult();

        return $this->render('home/index2.html.twig', [
      
          'renduAlls' =>$renduAlls
          
        ]); 
    }
 }