<?php

namespace App\Controller\Api;

use App\Entity\Srm;
use App\Repository\SrmRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/cirfas")
 */
class SrmController extends AbstractController
{
    /**
     * @Get(
     *     path = "/srms",
     *     name="srms_list",
     * )
     * @Rest\View(serializerGroups={"srm"})
     */
    public function getCirfas(SrmRepository $repository)
    {
        return $repository->findAll();
    }
}
