<?php

namespace App\Form\Skill;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class CreateType
 *
 * Formulaire type pour la création d'une compétence
 *
 * @package App\Form\Skill
 **/
class CreateType extends AbstractType {

    /**
     * Construit le formulaire
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     **/
    public function buildForm(FormBuilderInterface $builder, array $options):  void {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la compétence',
                'attr' => [
                    'placeholder' => 'Saisissez le nom de la compétence'
                ]
            ])
            ->add('level', NumberType::class, [
                'label' => 'Niveau de maitrise'
            ])
            ->add('type', TextType::class, [
                'label' => 'Type de la compétence',
                'attr' => [
                    'placeholder' => 'Saisissez le type'
                ]
            ])
            ->add('icons', TextareaType::class, [
                'label' => 'Ajouter le code SVG de la coméptence',
                'attr' => [
                    'placeholder' => '<svg ...>'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Créer la compétence',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
    }

}