<?php

namespace App\Controller\Front;

// use App\Entity\Task;
// use App\Form\TaskType;
use App\Entity\Specialisation;
// use App\Repository\TaskRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/Task")
 */
class TaskController extends AbstractController
{
    // /**
    //  * @Route("/", name="task_index", methods={"GET"})
    //  */
    // public function index(TaskRepository $taskRepository): Response
    // {
    //     return $this->render('front/task/index.html.twig', [
    //         'tasks' => $taskRepository->findAll(),
    //     ]);
    // }


    // /**
    //  * @Route("/{id}", name="task_show", methods={"GET"}, requirements={"id":"\d+"})
    //  */
    // public function show(Task $task): Response
    // {
    //     return $this->render('front/task/show.html.twig', [
    //         'task' => $task,
    //     ]);
    // }

    // /**
    //  * @Get(
    //  *     path = "/specialisation/{id}",
    //  *     name="tasks_specialisation_list",
    //  *     requirements={"id":"\d+"}
    //  * )
    //  * @Rest\View(serializerGroups={"Default"})
    //  */
    // public function getStudents(Specialisation $specialisation, TaskRepository $tasksRepository)
    // {     
    //     return $tasksRepository->findBy([
    //         'specialisation' => $specialisation
    //     ]);
    // }
}
