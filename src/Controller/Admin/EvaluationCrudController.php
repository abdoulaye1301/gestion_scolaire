<?php

namespace App\Controller\Admin;

use App\Entity\Evaluation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EvaluationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evaluation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Evaluations')
            ->setEntityLabelInSingular('Evaluation')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des évaluations');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('NomEvaluation'),
        ];
    }
}
