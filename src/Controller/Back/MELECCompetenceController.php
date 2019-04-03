<?php

namespace App\Controller\Back;

use App\Entity\Specialisation;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MELECCompetenceController extends AbstractController
{
    /**
     * @Route("/melec/competence/{id}", name="melec_competence")
     */
    public function index(Specialisation $specialisation)
    {
        return $this->render('back/melec_competence/index.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }
}
