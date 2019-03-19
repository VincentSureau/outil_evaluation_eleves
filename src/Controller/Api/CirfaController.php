<?php

namespace App\Controller\Api;

use App\Entity\Cirfa;
use App\Repository\CirfaRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/cirfas")
 */
class CirfaController extends AbstractController
{
    /**
     * @Get(
     *     path = "/cirfas/list",
     *     name="cirfas_list",
     * )
     * @Rest\View(serializerGroups={"cirfa"})
     */
    public function getCirfas(CirfaRepository $repository)
    {
        return $repository->findAll();
    }
}
