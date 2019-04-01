<?php

namespace App\Controller\Api;

// use App\Entity\Competence;
use App\Repository\CompetenceRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/competences")
 */
class CompetenceController extends AbstractController
{
    /**
     * @Get(
     *     path = "/competences",
     *     name="competences_list",
     * )
     * @Rest\View(serializerGroups={"competence"})
     */
    // public function getCirfas(CompetenceRepository $repository)
    // {
    //     return $repository->findAll();
    // }
}
