<?php

namespace App\Form;

use App\Entity\Configuration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigurationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array<mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la configuration',
                'attr' => [
                    'placeholder' => 'Saisissez le nom de la configuration',
                    'class' => 'mb-3'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Saisissez le contenu de la configuration',
                'attr' => [
                    'placeholder' => 'Saisissez le nom de la compétence',
                    'class' => 'mb-3'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter'
            ]);
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Configuration::class,
        ]);
    }
}
