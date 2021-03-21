<?php

namespace App\Controller\Admin;

use App\Entity\Barber;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;

class BarberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Barber::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Information personnelle'),
            Field::new('FirstName','Prénom'),
            Field::new('Password', 'Mot de passe'),

            FormField::addPanel('Contactes')
                ->setIcon('Phone')->addCssClass('optional'),
            TelephoneField::new('Phone','Téléphone'),
            EmailField::new('Email', 'Adresse mail'),

            FormField::addPanel('Services'),

            AssociationField::new('services'),
            DateTimeField::new('createdAt', 'Date de création'),
            DateTimeField::new('deletedAt','Date de suppression')->hideOnForm(),
            Field::new('isAdmin','Administrator'),
        ];
    }



}
