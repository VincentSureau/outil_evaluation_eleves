<?php

namespace App\Form;

use App\Entity\Cirfa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class CirfaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('number', TelType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cirfa::class,
        ]);
    }
}
