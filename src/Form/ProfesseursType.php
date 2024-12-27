<?php

namespace App\Form;

use App\Entity\Professeurs;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProfesseursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('DateNaissance', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('LieuNaissance', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Telephone', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Profession', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Nationalite', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Diplome', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Salaire', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('DebutContrat', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('FinContrat', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Sexe', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Contrat', EntityType::class, [
                'class' => 'App\Entity\Contrat',
                'choice_label' => 'TypeContrat',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('Adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])->add('photo', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '5000k',
                        'maxSizeMessage' => 'La taille du fichier est supérieur à 5Mo',
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeurs::class,
        ]);
    }
}
