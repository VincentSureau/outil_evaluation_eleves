<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('spreadsheet', FileType::class,[
                'label' => 'Selectionner votre fichier'
            ])
            ->add('sheet', TextType::class, [
                'label' => 'Entrez le nom de la feuille'
            ])
        ;
    }
}
