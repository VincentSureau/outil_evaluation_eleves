<?php

namespace App\Controller\Api;

use App\Entity\MELECCompetence;
use App\Repository\MELECCompetenceRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/melec/competences")
 */
class MELECCompetenceController extends AbstractController
{
    /**
     * @Get(
     *     path = "/",
     *     name="melec_competences_list",
     * )
     * @Rest\View(serializerGroups={"meleccompetence"})
     */
    public function getCompetences(MELECCompetenceRepository $repository)
    {
        return $repository->findAll();
    }
}
