<?php

namespace App\Form;

use App\Entity\Tp;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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

            if ($tp->getId()){
                switch($tp->getSpecialisation()->getName()){
                    case "MEI":
                        foreach($tp->getSpecialisation()->getMEICompetences() as $competences) {
                            //traitement
                        }
                        break;  

                    case "MELEC":
                        foreach($tp->getSpecialisation()->getMELECCompetences() as $competences) {
                            //traitement
                        }
                        break;

                    case "SN":
                        foreach($tp->getSpecialisation()->getSNCompetences() as $competences) {
                            //traitement
                        }
                        break;                    
                }
                $form->add('task', EntityType::class,[
                    'label' => 'Tâche',
                    'class' => Task::class,
                    'multiple' => true,
                    'choices' => $tp->getSpecialisation()->getTask(),
                ]);
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
