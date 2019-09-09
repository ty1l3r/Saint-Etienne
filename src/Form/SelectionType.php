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
                    'Une image seule' => 'image',
                    'Un texte seul' => 'texte',
                    'Un texte accompagné d\'une image' => 'texteEtImg',
                    'Un Rendez-vous & Manifestations' => 'rdv',
                    '"Ma Paroisse" le dernier numéro' => 'maParoisse' ,     
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