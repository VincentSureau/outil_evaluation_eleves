<?php

namespace App\Controller\Back;

use App\Entity\Specialisation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SNTaskController extends AbstractController
{
    /**
     * @Route("/sn/task/{id}", name="sn_task")
     */
    public function index(Specialisation $specialisation)
    {
        return $this->render('back/sn_task/index.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }
}
