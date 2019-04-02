<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MELECCompetenceController extends AbstractController
{
    /**
     * @Route("/back/m/e/l/e/c/competence", name="back_m_e_l_e_c_competence")
     */
    public function index()
    {
        return $this->render('back/melec_competence/index.html.twig', [
            'controller_name' => 'MELECCompetenceController',
        ]);
    }
}
