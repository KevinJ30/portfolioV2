<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label' => "Adresse e-mail de connexion",
                'attr' => [
                    'placeholder' => 'email@em.fr',
                    'class' => 'mb-3'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Membre' => 'ROLE_MEMBER'
                ],
                'attr' => [
                    'class' => 'mb-3'
                ]
            ])
            ->add('password', TextType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => 'Mot de passe',
                    'class' => 'mb-3'
                ],
                'required' => false
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Créer l\'utilisateur'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
