<?php

namespace App\Controller\Api;

use App\Entity\Task;
use App\Repository\TaskRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/sasks")
 */
class TaskController extends AbstractController
{
    /**
     * @Get(
     *     path = "/tasks",
     *     name="tasks_list",
     * )
     * @Rest\View(serializerGroups={"task"})
     */
    public function getCirfas(TaskRepository $repository)
    {
        return $repository->findAll();
    }
}
