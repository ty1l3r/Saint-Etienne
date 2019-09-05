<?php

namespace App\Form;

use App\Entity\Actus;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class FormRdvImgPaysageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('imgPaysage',FileType::class, array(
                'label' => 'Image',
                'attr' => [
                    'placeholder' => 'télécharger votre image'
                ]
            ))*/
            ->add('title')
            ->add('subtitle')
            ->add('content')
            ->add('place')
            ->add('rdvTime')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Actus::class,
        ]);
    }
}
