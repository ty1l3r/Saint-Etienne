<?php
namespace App\Form;
use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends ApplicationType
{
   
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom ..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre Nom ..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            ->add('hash', PasswordType::class, $this->getConfiguration("Mot de Passe", "Choisissez un mot de passe ..."))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation de mot de passe", "Veuillez confirmer cotre mot de passe"))
            ->add('presentation', TextareaType::class, $this->getConfiguration("Decription", " Présentez-vous !"))
            ->add('sexe', ChoiceType::class, [
                'placeholder' => 'Selecionner',
                'choices'  => [
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                ], 
            ])
            ->add('eglise', ChoiceType::class, [
                'placeholder' => 'Selectioner votre église',
                'choices'  => [
                    'Aunay-sous-Crécy' => 'Aunay-sous-Crécy',
                    'Broué' => 'Broué',
                    'Charpont' => 'Charpont',
                    'MChérisy' => 'Chérisy',
                    'Crécy-Couvé' => 'Crécy-Couvé' ,
                    'Ecluzelles' => 'Ecluzelles',
                    'Fermaincourt' => 'Fermaincourt',
                    'Garancières-en-Drouais' => 'Garancières-en-Drouais' ,
                ], 
            ])
           
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}