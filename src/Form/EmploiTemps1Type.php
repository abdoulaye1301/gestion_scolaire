<?php

namespace App\Form;

use App\Entity\EmploiTemps;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class EmploiTemps1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Jour')
            ->add('HeureDebut', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('HeureFin', TimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('Matiere', EntityType::class, [
                'class' => 'App\Entity\Matieres',
                'choice_label' => 'Matiere',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Matiere'
            ])
            ->add('NomSalle', EntityType::class, [
                'class' => 'App\Entity\Salles',
                'choice_label' => 'NomSalle',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Salle'
            ])
            ->add('Prenom', EntityType::class, [
                'class' => 'App\Entity\Professeurs',
                'choice_label' => 'Prenom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmploiTemps::class,
        ]);
    }
}
