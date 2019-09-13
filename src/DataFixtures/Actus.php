<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Datas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;




class Actus extends Fixture
{   
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
        
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) 
    {
        
        $faker = Factory::create('FR-fr');

//Création d'un role Admin dans la BDD

//Création d'un role Admin dans la BDD
$adminRole = new Role();
$adminRole->setTitle('ROLE_ADMIN');
$manager->persist($adminRole);
// Création d'un Administrateur
$adminUser = new User();
$adminUser->setFirstName('Admin')
        ->setLastName('')
        ->setEmail('a@a.com')
        ->setHash($this->encoder->encodePassword($adminUser, 'password'))
        ->addUserRole($adminRole)
        ->setSexe('Homme')
        ->setEglise('Toutes');

     $manager->persist($adminUser);  


//Nous gérons les Utilisateurs

$users = [];
$genres = ['male','female'];
$sexes = ['Femme', 'Homme'];
$eglises = ['Aunay-sous-Crécy','Broué','Charpont','Chérisy','Crécy-Couvé','Ecluzelles','Fermaincourt','Garancières-en-Drouais','Garnay', 
'Germainville','La Chapelle Forainvilliers','Luray','Mézières','Montreuil','Saulnières','Ste Gemme Moronval','Tréon','Vernouillet'];

for ($i = 1; $i <= 10; $i++) {

    $user = new User();

     $genre = $faker->randomElement($genres);
     $sexe = $faker->randomElement($sexes);
     $eglise = $faker->randomElement($eglises);
 
    $hash = $this->encoder->encodePassword($user,'password');

    $user->setfirstName($faker->firstname($genre))
             ->setLastName($faker->lastname)
             ->setHash($hash)
             ->setEmail($faker->email)
             ->setSexe($sexe)
             ->setEglise($eglise);
          

        $manager->persist($user);
        $users[] = $user;
}

// Nous géron les annonces
        for ($i = 1; $i <= 8; $i++) {

            $datas = new Datas();

            // $images = ['https://lorempixel.com/800/600/nightlife','https://lorempixel.com/600/800/nightlife/'];
            $widthPortrait=600;
            $heightPortrait=800;
            $widthPaysage=800;
            $heightPaysage=600;
            

        $title = $faker->sentence($nbWords = 6);
        $imagePay = $faker->imageUrl($widthPaysage,$heightPaysage,'nightlife');
        // $imagePort = $faker->imageUrl($widthPortrait,$heightPortrait,'nightlife');
        $rdvTime = $faker->dateTime($max = 'now');
        $subtitle = $faker->sentence($nbWords = 4);
        $createdAt = $faker->dateTime();
        $place = $faker->country();
        $content = $faker->realText($maxNbChars = 200, $indexSize = 2);
        $lien = $faker->url();
        $file = $faker->uuid();
        // $image = $faker->imageUrl();

        $user = $users[ mt_rand(0, count($users) -1)];
        

        $datas
        ->setTitle($title)
        ->setSubTitle($subtitle)
        ->setPlace($place)
        ->setrdvTime($rdvTime)
        ->setcontent($content)
        ->setImageName($imagePay)
        ->setcreatedAt($createdAt)
        ->setpdf($file)
        ->setAuthor($user)
        ->setRendu(mt_rand (1,8));
        // ->setimgPortrait($imagePort)
        // ->setimgPaysage($imagePay) 
        // ->setLien($lien)


        $manager->persist($datas);

        }


        $manager->flush();
    }
}
