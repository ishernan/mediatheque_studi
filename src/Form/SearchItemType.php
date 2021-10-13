<?php

namespace App\Form;

use App\Classe\SearchItem;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchItemType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('string', TextType::class, [
                'label' => false,
                'required'=>false,
                 'attr' => [
                     'placeholder' => 'cherchez un document'
                 ]
            ])
            ->add('categories', EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Category::class,
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => '',
                    'type'=>'',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Chercher',
                'attr' => [
                    'class' => 'btn btn-outline-warning text-start'
                ]
            ])
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchItem::class,
            'method'=>'GET',

        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }



}