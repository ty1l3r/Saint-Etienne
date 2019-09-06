<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SelectionType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder  
            ->add('selection', ChoiceType::class, ['placeholder' => 'Choisissez une catégorie',
                    'choices'  => [
                    'image' => 'image',
                    'Texte' => 'texte',
                    'Texte et image' => 'texteEtImg',
                    'Manifestation ou Rendez-vous' => 'rdv',
                    'Dernier numéro de "Ma Paroisse"' => 'maParoisse' ,     
                ],         
            ]
        
        ); 

        $builder->add('save', SubmitType::class);
               
        }
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
           
            ]);
        }

 
    }
