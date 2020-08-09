<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class OfficeFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'price',
                TextType::class,
                [
                    'label' => 'Price',
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'location',
                TextType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control', 'id' => 'address']
                ]
            )
            ->add(
                'lat',
                TextType::class,
                [
                    'label' => 'Latitude',
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control', 'id' => 'lat', 'readonly' => true]
                ]
            )
            ->add(
                'lon',
                TextType::class,
                [
                    'label' => 'Longitude',
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control', 'id' => 'lon', 'readonly' => true]
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add(
                'available',
                ChoiceType::class,
                [
                    'choices'  => [
                        'Yes' => true,
                        'No' => false,
                    ],
                    'constraints' => [new NotBlank()],
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('upload', FileType::class,
                [
                    'label' => 'Images',
                    'attr' => ['class' => 'form-control'],
                    'mapped' => false,
                    'multiple' => true,
                    'required' => false,
                    'constraints' => [
                        new All([
                            new Image([
                                'maxSize' => '5M'
                            ])
                        ])

                    ],

                ]
            )
            ->add(
                'create',
                SubmitType::class,
                [
                    'attr' => ['class' => 'form-control btn-primary pull-right'],
                    'label' => 'Create!'
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Office'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'author_form';
    }
}