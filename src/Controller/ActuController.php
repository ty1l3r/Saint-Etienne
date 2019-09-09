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

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActuController extends AbstractController
{
    /**
     * @Route("/actu", name="actu")
     */
    public function print(ObjectManager $manager)
    {   
          
          $renduAlls = $manager->createQuery(
            "SELECT u
            FROM App\Entity\Datas u
            ORDER BY u.createdAt DESC
            ")
            ->getResult();
        return $this->render('actu/index.html.twig', [
            'renduAlls' =>$renduAlls
        ]);
    }
}

