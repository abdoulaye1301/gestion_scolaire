<?php

namespace App\Form;

use App\Entity\Emargement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class EmargementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('TitreCours', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Titre du cours'
            ])
            ->add('Professeurs', EntityType::class, [
                'class' => 'App\Entity\Professeurs',
                'choice_label' => 'Prenom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Professeur'
            ])
            ->add('Classe', EntityType::class, [
                'class' => 'App\Entity\Classe',
                'choice_label' => 'NomClasse',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Matieres', EntityType::class, [
                'class' => 'App\Entity\Matieres',
                'choice_label' => 'Matiere',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Matière'
            ])
            ->add('Semestre', EntityType::class, [
                'class' => 'App\Entity\Semestre',
                'choice_label' => 'Semestre',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('AnneeScolaire', EntityType::class, [
                'class' => 'App\Entity\AnneeScolaire',
                'choice_label' => 'Annee',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Année scolaire'
            ])
            ->add('Duree', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Durée (en heure)'
            ])
            ->add('Debut', TimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Début cours'
            ])
            ->add('Fin', TimeType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Fin cours'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emargement::class,
        ]);
    }
}
