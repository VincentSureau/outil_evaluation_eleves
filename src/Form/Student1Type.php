<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Student1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city')
            ->add('lastname')
            ->add('firstname')
            ->add('gender')
            ->add('birthplace')
            ->add('birthdate')
            ->add('specialisation')
            ->add('srm')
            ->add('cirfa')
            ->add('school')
            ->add('referent')
            ->add('review')
            ->add('bordee')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
