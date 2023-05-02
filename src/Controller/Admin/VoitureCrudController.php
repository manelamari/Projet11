<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('modele'),
            TextField::new('carburant'),
            TextField::new('boiteVitesse'),
            NumberField::new('nombreDePlace'),
            BooleanField::new('disponibility'),
            AssociationField::new('category'),
            MoneyField::new('prix')->setCurrency('EUR'),
            ImageField::new('image')->setBasePath('assets/upload/voitures')
                                               ->setUploadDir('public/assets/upload/voitures')

                                            ->setUploadedFileNamePattern('[randomhash].[extension]'),
        ];
    }
}
