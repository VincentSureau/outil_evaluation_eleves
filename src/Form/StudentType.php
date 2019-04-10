<?php

namespace App\Form;

use App\Entity\Srm;
use App\Entity\Cirfa;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\Referent;
use App\Entity\Specialisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'label' => 'Civilité',
                'choices' => ['M.' => 'M.', 'Mme.' => 'Mme.']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('birthplace', TextType::class, [
                'label' => 'Ville de naissance'
            ])
            ->add('birthdate', BirthdayType::class, [
                'label' => 'Date de naissance',
                'format' => 'dd-MM-yyyy'
            ])
            ->add('school', EntityType::class, [
                'class' => School::class,
                'choice_label' => 'name',
                'label' => 'Lycée'
            ])
            ->add('specialisation', EntityType::class, [
                'class' => Specialisation::class,
                'choice_label' => 'name',
                'label' => 'Spécialisation'
            ])
            ->add('srm', EntityType::class, [
                'class' => Srm::class,
                'choice_label' => 'name',
                'label' => 'SRM'
            ])
            ->add('cirfa', EntityType::class, [
                'class' => Cirfa::class,
                'choice_label' => 'city',
                'label' => 'CIRFA'
            ])
            ->add('referent', EntityType::class, [
                'class' => Referent::class,
                // 'choice_label' => '',
                'label' => 'Prof. principal'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
