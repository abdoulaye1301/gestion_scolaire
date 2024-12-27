<?php

namespace App\Form;

use App\Entity\Eleves;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Image;

class ElevesType extends AbstractType
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
            ->add('Sexe', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('TelephoneParent', EntityType::class, [
                'class' => 'App\Entity\Parents',
                'choice_label' => 'Telephone',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Téléphone parent'
            ])
            ->add('TelephoneTuteur', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Téléphone Tuteur'
            ])
            ->add('PrenomMere', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom Mère'
            ])
            ->add('NomMere', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom Mère'
            ])
            ->add('NomTuteur', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom Tuteur'
            ])
            ->add('PrenomTuteur', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom Tuteur'
            ])
            ->add('PrenomPere', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom Père'
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
            'data_class' => Eleves::class,
        ]);
    }
}
