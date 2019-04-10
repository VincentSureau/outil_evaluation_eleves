<?php

namespace App\Controller\Back;

use App\Entity\Specialisation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SNCompetenceController extends AbstractController
{
    /**
     * @Route("/sn/competence/{id}", name="sn_competence")
     */
    public function index(Specialisation $specialisation)
    {
        return $this->render('back/sn_competence/index.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }
}
