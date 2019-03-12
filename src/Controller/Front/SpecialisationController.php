<?php

namespace App\Controller\Front;

use App\Entity\Specialisation;
use App\Form\SpecialisationType;
use App\Repository\SpecialisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialisation")
 */
class SpecialisationController extends AbstractController
{
    /**
     * @Route("/", name="specialisation_index", methods={"GET"})
     */
    public function index(SpecialisationRepository $specialisationRepository): Response
    {
        return $this->render('front/specialisation/index.html.twig', [
            'specialisations' => $specialisationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialisation_show", methods={"GET"})
     */
    public function show(Specialisation $specialisation): Response
    {
        return $this->render('front/specialisation/show.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }
}
