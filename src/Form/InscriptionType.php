<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Montant', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Statut', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Annee', EntityType::class, [
                'class' => 'App\Entity\AnneeScolaire',
                'choice_label' => 'Annee',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Anné scolaire'
            ])
            ->add('Eleve', EntityType::class, [
                'class' => 'App\Entity\Eleves',
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Elève'
            ])
            ->add('NomClasse', EntityType::class, [
                'class' => 'App\Entity\Classe',
                'choice_label' => 'NomClasse',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'NomClasse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
