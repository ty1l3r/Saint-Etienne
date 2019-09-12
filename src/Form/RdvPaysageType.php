<?php

namespace App\Form;

use App\Entity\Datas;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RdvPaysageType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         
            ->add('imageFile', VichImageType::class,$this->getConfiguration("Votre image (Format paysage)", "Veuillez télécharger votre image")) 
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Veuillez entrer le titre de votre actualité"))
            ->add('subTitle', TextType::class, $this->getConfiguration("Sous-titre", "Décrivrez en quelques mots votre image"))
            ->add('place', TextareaType::class, array('attr' => array('class' =>'formPlace')),$this->getConfiguration("Lieu de l'évenement", "Ya t'il ue addresse de rendez-vous")) 
            ->add('rdvTime', DateTimeType::class, array('attr' => array('class' =>'formAnnee')), $this->getConfiguration("Date de l\'evenement", "Ya t'il ue addresse de rendez-vous"), array(

            'date_widget' => 'single_text',
            'date_format' => 'dd.MM.yyyyTH:i',
            'html5' => false,
                
            ))
         
            ->add('content', TextareaType::class, array('attr' => array('class' =>'formTexte')), $this->getConfiguration("Lieu de l'évenement", "Ya t'il ue addresse de rendez-vous"))
            ->add('Confirmer', SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Datas::class,
        ]);
    }
}
