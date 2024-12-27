<?php

namespace App\Controller\Admin;

use App\Entity\Parents;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ParentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Parents::class;
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
