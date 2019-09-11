<?php

namespace App\Form;

use App\Entity\Datas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MaParoisseType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('title', TextType::class, $this->getConfiguration("Titre", "Veuillez entrer le titre de votre actualité"))
        ->add('subTitle', TextType::class, $this->getConfiguration("Sous-titre", "Décrivrez en quelques mots votre actualité"))
        ->add('content', TextareaType::class, $this->getConfiguration("Contenu", "Un commentaire à propos de cet édition ?"))
        ->add('imageFile', VichImageType::class,$this->getConfiguration("une phoo de couverture ?", "Veuillez télécharger votre fichier"))
        ->add('name', FileType::class,$this->getConfiguration("Joindre votre version numérique", "Veuillez télécharger votre fichier pdf"),
        ['mapped' => false])
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
