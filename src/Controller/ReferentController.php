<?php

namespace App\Controller;

use App\Entity\Referent;
use App\Form\ReferentType;
use FOS\RestBundle\View;
use App\Repository\ReferentRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/referent")
 */
class ReferentController extends AbstractController
{
    /**
     * @Route("/", name="referent_index", methods={"GET"})
     */
    public function index(ReferentRepository $referentRepository): Response
    {
        return $this->render('referent/index.html.twig', [
            'referents' => $referentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="referent_show", methods={"GET"}, requirements = {"id"="\d+"})
     */
    public function show(Referent $referent): Response
    {
        return $this->render('referent/show.html.twig', [
            'referent' => $referent,
        ]);
    }

    /**
     * @Get(
     *     path = "/{id}/students",
     *     name="referent_students",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(serializerGroups={"student"})
     */
    public function getStudents(Referent $referent)
    {     
        return $referent->getStudents();
    }

    /**
     * @Get(
     *     path = "/list",
     *     name="referents_list",
     * )
     * @Rest\View()
     */
    public function getReferents(ReferentRepository $referentRepository)
    {     
        return $referentRepository->findAll();
    }
}
