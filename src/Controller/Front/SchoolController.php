<?php

namespace App\Controller\Front;

use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\SchoolRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/school")
 */
class SchoolController extends AbstractController
{
    /**
     * @Route("/", name="school_index", methods={"GET"})
     */
    public function index(SchoolRepository $schoolRepository): Response
    {
        return $this->render('front/school/index.html.twig', [
            'schools' => $schoolRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="school_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(School $school): Response
    {
        return $this->render('front/school/show.html.twig', [
            'school' => $school,
        ]);
    }

    /**
     * @Get(
     *     path = "/list",
     *     name="schools_list",
     * )
     * @Rest\View(serializerGroups={"school"})
     */
    public function getSchools(SchoolRepository $schoolRepository)
    {     
        return $schoolRepository->findAll();
    }
}
