<?php 

namespace App\Service;

use App\Entity\Datas;
use Doctrine\Common\Persistence\ObjectManager;


class MaParoisse
{
    //acceder au Manager de Doctrine ====================
    public function __construct(ObjectManager $manager){
        $this->manager = $manager; 
          
    }

    public function getMaParoisse()
    {   
      $message = "coucou";

      $manager = $this->manager;
      $results = $manager->createQuery(
          "SELECT u 
          FROM App\Entity\Datas u 
          WHERE u.rendu ='7' "
      )
      ->getResult();
      
        return $results;
    }


}




