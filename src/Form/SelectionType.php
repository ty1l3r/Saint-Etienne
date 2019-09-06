<?php

namespace App\Form;

use App\Entity\Selection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;

    class SelectionType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            // $builder  
            // ->add('selection', ChoiceType::class, [
            //     'placeholder' => 'Choisissez une catégorie',
            //     'choices'  => [

            //         'image' => 'image',
            //         'Texte' => 'texte',
            //         'Texte et image' => 'texteEtImg',
            //         'Manifestation ou Rendez-vous' => 'rdv',
            //         'Dernier numéro de "Ma Paroisse"' => 'maParoisse' ,     
            //     ], 
            
            
                
            // ]);
            $builder->add('category', ChoiceType::class, [
                'choices' => [
                    new Category('Cat1'),
                    new Category('Cat2'),
                    new Category('Cat3'),
                    new Category('Cat4'),
                ],
                // 'choice_label' => function(Category $category, $key, $value) {
                //     return strtoupper($category->getImage());
                // },
                // 'choice_attr' => function(Category $category, $key, $value) {
                //     return ['class' => 'category_'.strtolower($category->getName())];
                // },
                // 'group_by' => function(Category $category, $key, $value) {
                //     // randomly assign things into 2 groups
                //     return rand(0, 1) == 1 ? 'Group A' : 'Group B';
                // },
                // 'preferred_choices' => function(Category $category, $key, $value) {
                //     return $category->getName() == 'Cat2' || $category->getName() == 'Cat3';
                // },
            ]);
            
            
        }
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'image' => true
            ]);
        }
    }
