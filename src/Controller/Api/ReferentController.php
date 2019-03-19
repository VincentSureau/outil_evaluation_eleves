<?php

namespace App\Controller\Api;

use App\Entity\Referent;
use App\Repository\ReferentRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/referents")
 */
class ReferentController extends AbstractController
{
    /**
     * @Get(
     *     path = "/referents",
     *     name="referents_list",
     * )
     * @Rest\View(serializerGroups={"referent"})
     */
    public function getCirfas(ReferentRepository $repository)
    {
        return $repository->findAll();
    }
}
