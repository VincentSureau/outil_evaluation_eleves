<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SNCompetenceController extends AbstractController
{
    /**
     * @Route("/back/s/n/competence", name="back_s_n_competence")
     */
    public function index()
    {
        return $this->render('back/sn_competence/index.html.twig', [
            'controller_name' => 'SNCompetenceController',
        ]);
    }
}
