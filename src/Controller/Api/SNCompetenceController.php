<?php

namespace App\Controller\Api;

use App\Entity\SNCompetence;
use App\Repository\SNCompetenceRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/sn/competences")
 */
class SNCompetenceController extends AbstractController
{
    /**
     * @Get(
     *     path = "/",
     *     name="sn_competences_list",
     * )
     * @Rest\View(serializerGroups={"sncompetence"})
     */
    public function getCompetences(SNCompetenceRepository $repository)
    {
        return $repository->findAll();
    }
}
