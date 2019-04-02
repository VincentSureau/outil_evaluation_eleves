<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SNCompetenceController extends AbstractController
{
    /**
     * @Route("/sn/competence", name="sn_competence")
     */
    public function index()
    {
        return $this->render('back/sn_competence/index.html.twig', [
            'controller_name' => 'SNCompetenceController',
        ]);
    }
}
