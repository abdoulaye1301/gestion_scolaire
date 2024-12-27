<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateCours', DateType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('DebutCours', TimeType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('FinCours', TimeType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Classe', EntityType::class, [
                'class' => 'App\Entity\Classe',
                'choice_label' => 'NomClasse',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Classe'
            ])
            ->add('Matiere', EntityType::class, [
                'class' => 'App\Entity\Matieres',
                'choice_label' => 'Matiere',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Matière'
            ])
            ->add('Enseignant', EntityType::class, [
                'class' => 'App\Entity\Professeurs',
                'choice_label' => 'Prenom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Enseignant'
            ])
            ->add('Semestre', EntityType::class, [
                'class' => 'App\Entity\Semestre',
                'choice_label' => 'Semestre',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('TypeCours', EntityType::class, [
                'class' => 'App\Entity\TypeCours',
                'choice_label' => 'TypeCours',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Type de cours'
            ])
            ->add('Etat', EntityType::class, [
                'class' => 'App\Entity\EtatCours',
                'choice_label' => 'Etat',
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
