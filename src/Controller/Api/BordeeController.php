<?php

namespace App\Controller\Api;

use App\Entity\Bordee;
use App\Repository\BordeeRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/bordees")
 */
class BordeeController extends AbstractController
{
    /**
     * @Get(
     *     path = "/bordees",
     *     name="bordees_list",
     * )
     * @Rest\View(serializerGroups={"bordee"})
     */
    public function getCirfas(BordeeRepository $repository)
    {
        return $repository->findAll();
    }
}
