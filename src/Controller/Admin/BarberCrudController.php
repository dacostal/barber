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
            FormField::addPanel('Personal Information'),
            Field::new('FirstName','Name'),
            Field::new('Password'),

            FormField::addPanel('Contact information')
                ->setIcon('Phone')->addCssClass('optional'),
            TelephoneField::new('Phone','Phone number'),
            EmailField::new('Email'),

            FormField::addPanel('Services'),

            AssociationField::new('services'),
            DateTimeField::new('createdAt'),
            DateTimeField::new('deletedAt')->hideOnForm(),
            Field::new('isAdmin','Administrator'),
        ];
    }



}
