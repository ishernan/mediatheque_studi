<?php

namespace App\Controller\Admin;

use App\Entity\Contenus;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContenusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contenus::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            SlugField::new('slug')->setTargetFieldName('titre'),
            TextField::new('auteur'),
            DateField::new('date_parution'),
            TextareaField::new('description'),
            TextField::new('genre'),
            ImageField::new('image')
                ->setBasePath('images/')
                ->setUploadDir('public/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            //BooleanField::new('disponibilite'),
            AssociationField::new('category')

        ];

    }
}
