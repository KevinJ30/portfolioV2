<?php

namespace App\Form\Skill;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options):  void {
        $builder
            ->add('name', TextType::class)
            ->add('level', NumberType::class)
            ->add('type', TextType::class)
            ->add('icons', TextType::class);
    }

}