<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => new Length(0, 2, 40),
                'required'=>true
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => new Length(0, 2, 40),
                'required'=>true,
            ])
            ->add('date_naissance', DateType::class, [
                'label' => "Date de Naissance",
                'widget' => 'single_text',
                'required'=>true,
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Votre Adresse',
                'constraints' => new Length(0, 2, 40),
                'required'=>true,

            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => new Length(0, 2, 40),
                'required'=>true,

            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'required'=>true,
                'first_options' => ['label'=>'Mot de passe'],
                'second_options' => ['label'=> 'Confirmez votre mot de passe'],
                'label' => 'Mot de passe'
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'btn btn-outline-warning'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
