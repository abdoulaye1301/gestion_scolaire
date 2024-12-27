<?php

namespace App\Form;

use App\Model\RechercheDonnee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q', options: [
                'attr' => [
                    'placeholder' => 'Recherche par mot clé...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheDonnee::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
}
