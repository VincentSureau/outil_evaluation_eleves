<?php

namespace App\Controller\Api;

use App\Entity\Specialisation;
use App\Repository\SpecialisationRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/specialisations")
 */
class SpecialisationController extends AbstractController
{
    /**
     * @Get(
     *     path = "/specialisations",
     *     name="specialisations_list",
     * )
     * @Rest\View(serializerGroups={"specialisation"})
     */
    public function getCirfas(SpecialisationRepository $repository)
    {
        return $repository->findAll();
    }
}
