<?php

namespace App\Controller\Front;

use App\Entity\Bordee;
use App\Form\BordeeType;
use App\Repository\BordeeRepository;
use App\Repository\ReferentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/bordee")
 */
class BordeeController extends AbstractController
{
    /**
     * @Route("/", name="bordee_index", methods={"GET"})
     */
    public function index(BordeeRepository $bordeeRepository, ReferentRepository $referentRepository): Response
    {
        return $this->render('bordee/index.html.twig', [
            'bordees' => $bordeeRepository->findAll(),
            'referents' => $referentRepository->findAll()
        ]);
    }


    /**
     * @Route("/{id}", name="bordee_show", methods={"GET"})
     */
    public function show(Bordee $bordee): Response
    {
        return $this->render('bordee/show.html.twig', [
            'bordee' => $bordee,
        ]);
    }

}
