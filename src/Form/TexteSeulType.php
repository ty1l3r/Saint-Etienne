<?php

namespace App\Form;

use App\Entity\Datas;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class TexteSeulType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Veuillez entrer le titre de votre actualité"))
            ->add('subTitle', TextType::class, $this->getConfiguration("Sous-titre", "Décrivrez en quelques mots votre anonnce"))
            ->add('content', CKEditorType::class, 
            [
                'label' => 'Votre texte',
                'attr' => [
                    'class' =>'formTexte',
                    'placeholder' => 'Ecrivez ou copier/coller votre texte'
                    ],
            ])
            ->add('Confirmer', SubmitType::class);
           
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Datas::class,
        ]);
    }
}
