<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormCheckType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder  
        ->add('selections', ChoiceType::class, ['placeholder' => 'Selectionner votre choix',
                'choices'  => [
                'Image Paysage' => 'paysage',
                'Image Portrait' => 'portrait',        
            ],         
        ]); 

    $builder->add('Confirmer', SubmitType::class); 
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
       
        ]);
    }
}