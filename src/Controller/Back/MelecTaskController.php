<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MelecTaskController extends AbstractController
{
    /**
     * @Route("/back/melec/task", name="back_melec_task")
     */
    public function index()
    {
        return $this->render('back/melec_task/index.html.twig', [
            'controller_name' => 'MelecTaskController',
        ]);
    }
}
