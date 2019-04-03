<?php

namespace App\Controller\Back;

use App\Entity\Specialisation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MELECTaskController extends AbstractController
{
    /**
     * @Route("/melec/task/{id}", name="melec_task")
     */
    public function index(Specialisation $specialisation)
    {
        return $this->render('back/melec_task/index.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }
}
