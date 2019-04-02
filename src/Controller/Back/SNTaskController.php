<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SNTaskController extends AbstractController
{
    /**
     * @Route("/sn/task", name="sn_task")
     */
    public function index()
    {
        return $this->render('back/sn_task/index.html.twig', [
            'controller_name' => 'SNTaskController',
        ]);
    }
}
