<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TpEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $student = $event->getData();
            $form = $event->getForm();

            

            // if ($student->getId()){
            //     $form->add('tp', ChoiceType::class,[
            //         'label' => 'Choisir un TP à évaluer',
            //         'multiple' => false,
            //         'choices' => $student->getSpecialisation()->getTps(),
            //         'choice_label' => function($tp){
            //             if($tp->getId()){
            //                 return $tp->getName();
            //             }
            //             else{
            //                 return null;
            //             }
            //         },
            //         'choice_value' => function($tp){
            //             return $tp ? $tp->getId() : '';
            //         },
            //         'mapped'=> false,
            //     ]);
            // }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
