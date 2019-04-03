<?php

namespace App\Controller\Api;

use App\Entity\SNTask;
use App\Repository\SNTaskRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/sn/tasks")
 */
class TaskController extends AbstractController
{
    /**
     * @Get(
     *     path = "/",
     *     name="sn_tasks_list",
     * )
     * @Rest\View(serializerGroups={"sntask"})
     */
    public function getTasks(SNTaskRepository $repository)
    {
        return $repository->findAll();
    }
}
