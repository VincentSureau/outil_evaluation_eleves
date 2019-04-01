<?php

namespace App\Controller\Api;

use App\Entity\School;
use App\Repository\SchoolRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/schools")
 */
class SchoolController extends AbstractController
{
    /**
     * @Get(
     *     path = "/schools",
     *     name="schools_list",
     * )
     * @Rest\View(serializerGroups={"school"})
     */
    public function getCirfas(SchoolRepository $repository)
    {
        return $repository->findAll();
    }
}
