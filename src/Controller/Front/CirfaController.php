<?php

namespace App\Controller\Front;

use App\Entity\Cirfa;
use App\Form\CirfaType;
use App\Repository\CirfaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cirfa")
 */
class CirfaController extends AbstractController
{
    /**
     * @Route("/", name="cirfa_index", methods={"GET"})
     */
    public function index(CirfaRepository $cirfaRepository): Response
    {
        return $this->render('front/cirfa/index.html.twig', [
            'cirfas' => $cirfaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="cirfa_show", methods={"GET"})
     */
    public function show(Cirfa $cirfa): Response
    {
        return $this->render('front/cirfa/show.html.twig', [
            'cirfa' => $cirfa,
        ]);
    }

}
