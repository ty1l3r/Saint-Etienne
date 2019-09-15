<?php

namespace App\Form;

use App\Entity\Datas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MesseType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
   
            ->add('imageFile', VichImageType::class,$this->getConfiguration("Horaire des messes", "Veuillez télécharger votre image"))   
            ->add('Confirmer', SubmitType::class);  
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Datas::class,
        ]);
    }
}
