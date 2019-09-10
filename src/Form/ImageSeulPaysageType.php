<?php

namespace App\Form;

use App\Entity\Datas;
use App\Form\ApplicationType;
use phpDocumentor\Reflection\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ImageSeulPaysageType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder



            // ->add('imgPaysage',FileType::class, array(
            // 'label' => 'Image',
            // 'attr' => [
            // 'placeholder' => 'télécharger votre image'
            // ]
            // ))

            // ->add('imgPaysage', FileType::class, $this->getConfiguration("Image", "Veuillez joindre votre image"))
            ->add('imageFile', VichImageType::class)   
            ->add('title', TextType::class, $this->getConfiguration("Titre", "Veuillez entrer le titre de votre actualité"))
            ->add('subTitle', TextType::class, $this->getConfiguration("Sous-titre", "Décrivrez en quelques mots votre image"))



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
