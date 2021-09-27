<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array<mixed> $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('fullname', TextType::class, [
                'label' => 'Nom complet',
                'attr' => [
                    'placeholder' => 'John DOE'
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Adresse e-mail',
                'attr' => [
                    'placeholder' => 'john.doe@john.fr'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Vous avez besoins de mes services ?'
                ]
            ])

            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary btn-outline'
                ]
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'allow_extra_fields' => true
        ]);
    }
}
