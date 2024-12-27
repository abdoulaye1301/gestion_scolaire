<?php

namespace App\Form;

use App\Entity\Devoir;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevoirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDevoir', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Date du devoir'
            ])
            ->add('Note', NumberType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('NomEvaluation', EntityType::class, [
                'class' => 'App\Entity\Evaluation',
                'choice_label' => 'NomEvaluation',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Numéro de l\'évaluation'
            ])
            ->add('Semestre', EntityType::class, [
                'class' => 'App\Entity\Semestre',
                'choice_label' => 'Semestre',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Matiere', EntityType::class, [
                'class' => 'App\Entity\Matieres',
                'choice_label' => 'Matiere',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Matière'
            ])
            ->add('email', EntityType::class, [
                'class' => 'App\Entity\Eleves',
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Élève'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devoir::class,
        ]);
    }
}
