<?php

namespace App\Form;

use App\Entity\Classe;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomClasse', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-group'
                ],
                'label' => 'Classe'
            ])
            ->add('CapaciteAccueil', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control form-group'
                ],
                'label' => 'Capacité d\'accueil'
            ])
            ->add('MontantIsncription', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control form-group'
                ],
                'label' => 'Montant scolarité'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
