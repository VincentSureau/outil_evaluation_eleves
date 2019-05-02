<?php

namespace App\Controller\Api;

use App\Entity\MELECTask;
use App\Repository\MELECTaskRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/melec/tasks")
 */
class MELECTaskController extends AbstractController
{
    /**
     * @Get(
     *     path = "/",
     *     name="melec_tasks_list",
     * )
     * @Rest\View(serializerGroups={"melectask"})
     */
    public function getTasks(MELECTaskRepository $repository)
    {
        return $repository->findAll();
    }
}
