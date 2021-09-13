<?php

namespace App\Form;

use App\Entity\Projects;
use App\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre du projet',
                'attr' => [
                    'placeholder' => 'Saisissez le titre',
                    'class' => 'mb-3'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du projet',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Écrivez la description du projet',
                    'class' => 'CKEditor mb-3'
                ]
            ])
            ->add('url', TextType::class, [
                'label' => 'URL du projet',
                'attr' => [
                    'placeholder' => 'http://...',
                    'class' => 'mb-3'
                ]
            ])
            ->add('thumb', TextType::class, [
                'label' => 'Url de la miniature',
                'attr' => [
                    'placeholder' => 'http://...',
                    'class' => 'mb-3'
                ]
            ])
            ->add('excerpt', TextareaType::class, [
                'label' => 'Extrait du projet',
                'attr' => [
                    'placeholder' => 'Écrivez une description courte du projet',
                    'class' => 'mb-3'
                ]
            ])
            ->add('details', TextType::class, [
                'label' => 'Technologies',
                'attr' => [
                    'placeholder' => 'Indiquer les compétence métier utilisé',
                    'class' => 'mb-3'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Créer le projet',
                'attr' => [
                    'class' => 'mt-3 btn btn-primary'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projects::class,
        ]);
    }
}
