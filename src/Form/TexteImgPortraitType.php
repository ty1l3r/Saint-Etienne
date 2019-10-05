<?php

namespace App\Form;

use App\Entity\Datas;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TexteImgPortraitType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class,$this->getConfiguration("Votre image (Format portrait)", "Veuillez télécharger votre image")) 
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Veuillez entrer le titre de votre actualité"))
            ->add('subTitle', TextType::class, $this->getConfiguration("Sous-titre", "Décrivrez en quelques mots votre image"))
             ->add('content', CKEditorType::class, 
            [
                'label' => 'Votre texte',
                'attr' => [
                    'class' =>'formTexte',
                    'placeholder' => 'Ecrivez ou copier/coller votre texte'
                    ],
            ])
            ->add('Confirmer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Datas::class,
        ]);
    }
}
