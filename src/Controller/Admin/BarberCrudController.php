<?php

namespace App\Controller\Admin;

use App\Entity\Barber;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BarberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Barber::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
