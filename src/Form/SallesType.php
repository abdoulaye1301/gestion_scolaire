<?php

namespace App\Form;

use App\Entity\Salles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SallesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomSalle', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Salle'
            ])
            ->add('CapaciteAccueil', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Capacité d\'accueil'
            ])
            ->add('Emplacement', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('NomClasse', EntityType::class, [
                'class' => 'App\Entity\Classe',
                'choice_label' => 'NomClasse',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Classe'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salles::class,
        ]);
    }
}
