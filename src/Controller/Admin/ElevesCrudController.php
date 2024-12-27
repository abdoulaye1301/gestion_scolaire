<?php

namespace App\Controller\Admin;

use App\Entity\Eleves;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Symfony\Component\Validator\Constraints\Date;

class ElevesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Eleves::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Elèves')
            ->setEntityLabelInSingular('Elève')
            ->setDateTimeFormat('y-m-d H:i:s')
            ->setDateFormat('y-m-d')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des élèves');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('Nom'),
            TextField::new('Prenom'),
            TextField::new('LieuNaissance'),
            IntegerField::new('Telephone_1'),
            IntegerField::new('Telephone_2'),
            AssociationField::new('email'),
            AssociationField::new('IdParent')->autocomplete(),
            AssociationField::new('IdClasse')->autocomplete(),
            AssociationField::new('IdSexe')->autocomplete(),
            AssociationField::new('IdEvaluation')->autocomplete(),
        ];
    }
}
