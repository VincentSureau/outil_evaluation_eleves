<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TpRepository;

class TpManager
{
    private $em, $repository;
    public function __construct(EntityManagerInterface $em, TpRepository $repository){
        $this->em               = $em;
        $this->repository       = $repository;
    }

    public function save($tp, $form){

        switch($tp->getSpecialisation()->getName()){
            case 'MELEC':
                $tasks = [];
                $subCompetences = [];

                foreach($tp->getSpecialisation()->getMELECCompetences() as $competence) {
                    $subCompetences[$competence->getReference()] = [];
                    foreach ($form->get($competence->getReference())->getData() as $subComp) {
                        $subCompetences[$competence->getReference()][] = $subComp->getId();
                    }
                }

                foreach($form->get('tasks')->getData() as $task){
                    $tasks[] = $task->getId();
                }

                $datas = [
                    'tasks' => $tasks,
                    'subCompetences' => $subCompetences,
                ];
                break;
            
            case 'MEI':
                $datas = [
                    'tasks' => $form->get('tasks')->getData(),
                ];
                break;

            case 'SN':
                $tasks = [];

                foreach($form->get('tasks')->getData() as $task){
                    $tasks[] = $task->getId();
                }

                $datas = [
                    'tasks' => $tasks,
                ];
                break;
        }

        $tp->setDatas($datas);
        $this->em->persist($tp);
        $this->em->flush();

        return true;

    }
}