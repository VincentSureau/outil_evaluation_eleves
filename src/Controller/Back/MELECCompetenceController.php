<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MELECCompetenceController extends AbstractController
{
    /**
     * @Route("/melec/competence", name="melec_competence")
     */
    public function index()
    {
        return $this->render('back/melec_competence/index.html.twig', [
            'controller_name' => 'MELECCompetenceController',
        ]);
    }
}
