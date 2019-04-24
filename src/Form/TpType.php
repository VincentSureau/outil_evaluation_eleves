<?php

namespace App\Form;

use App\Entity\Tp;
use App\Entity\SNTask;
use App\Entity\MELECTask;
use App\Entity\SNCompetence;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\MELECSubCompetence;

class TpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Intitulé'
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $tp = $event->getData();
            $form = $event->getForm();

            if ($tp->getSpecialisation()){
                switch($tp->getSpecialisation()->getName()){
                    case "MEI":
                        //traitement
                        break;  

                    case "MELEC":
                        $form->add('tasks', EntityType::class,[
                            'label' => 'Activités',
                            'class' => MELECTask::class,
                            'multiple' => true,
                            'choices' => $tp->getSpecialisation()->getMELECTasks(),
                            'choice_label' => function ($choice) {
                                return $choice->getReference() . ' - ' . $choice->getLabel();
                            },
                            'choice_attr' => function ($choice) use ($tp) {
                                return ['selected' => in_array($choice->getId(), $tp->getDatas()['tasks'])];
                            },
                            'mapped' => false
                        ]);
                        $form->add('subCompetences', EntityType::class,[
                            'label' => 'Compétences',
                            'class' => MELECSubCompetence::class,
                            'multiple' => true,
                            'choices' => $tp->getSpecialisation()->getMelecSubCompetences(),
                            'choice_label' => function ($choice) {
                                return $choice->getLabel();
                            },
                            'choice_attr' => function ($choice) use ($tp) {
                                                return ['selected' => in_array($choice->getId(), $tp->getDatas()['subCompetences'])];
                                            },
                            'mapped' => false
                        ]);
                        break;

                    case "SN":
                        $form->add('tasks', EntityType::class,[
                            'label' => 'Activités',
                            'class' => SNTask::class,
                            'multiple' => true,
                            'choices' => $tp->getSpecialisation()->getSNTasks(),
                            'choice_label' => function ($choice) {
                                return $choice->getReference() . ' - ' . $choice->getLabel();
                            },
                            'choice_attr' => function ($choice) use ($tp) {
                                return ['selected' => in_array($choice->getId(), $tp->getDatas()['tasks'])];
                            },
                            'mapped' => false
                        ]);
                        break;                    
                }
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tp::class,
        ]);
    }
}
