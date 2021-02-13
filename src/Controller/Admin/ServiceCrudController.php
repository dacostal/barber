<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Service'),
            Field::new('Title'),
            TextareaField::new('Description'),
            FormField::addPanel('Details'),
            TimeField::new('Time') ,
            Field::new('Price'),
            FormField::addPanel('Barbers'),
            AssociationField::new('barbers'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('deletedAt')->hideOnForm(),
        ];
    }

}
