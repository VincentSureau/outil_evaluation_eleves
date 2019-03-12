<?php

namespace App\Controller\Front;

use App\Entity\Srm;
use App\Form\SrmType;
use App\Repository\SrmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/srm")
 */
class SrmController extends AbstractController
{
    /**
     * @Route("/", name="srm_index", methods={"GET"})
     */
    public function index(SrmRepository $srmRepository): Response
    {
        return $this->render('srm/index.html.twig', [
            'srms' => $srmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="srm_show", methods={"GET"})
     */
    public function show(Srm $srm): Response
    {
        return $this->render('srm/show.html.twig', [
            'srm' => $srm,
        ]);
    }
}
