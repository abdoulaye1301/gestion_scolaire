<?php

namespace App\Form;

use App\Entity\Calendar;
use DateTime;
use Doctrine\DBAL\Types\BlobType;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Titre'
            ])
            ->add('start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Date et Heure de début'
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'label' => 'Date et Heure de fin'
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description'
            ])
            ->add('all_day')
            ->add('background_color', ColorType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Couleur arrière plan'
            ])
            ->add('border_color', ColorType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Couleur de bordure'
            ])
            ->add('text_color', ColorType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Couleur du texte'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
