<?php

namespace App\Controller;

use App\Entity\Bordee;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\Referent;
use App\Form\StudentType;
use App\Entity\Specialisation;
use App\Repository\StudentRepository;
use App\Repository\SpecialisationRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
    /**
     * @Route("/", name="student_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $bordee = $request->query->get('bordee');
        $referent = $request->query->get('referent');
        $params = [];
        if($bordee){
            $params['bordee'] = $bordee;
        }
        if($referent){
            $params['referent'] = $referent;
        }
        return $this->render('student/index.html.twig', ['referent' => $referent, 'bordee' => $bordee, 'params' => $params]);
    }

    /**
     * @Route("/new", name="student_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();

            return $this->redirectToRoute('student_index');
        }

        return $this->render('student/new.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Student $student): Response
    {
        return $this->render('student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student_index', [
                'id' => $student->getId(),
            ]);
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student_index');
    }


    /**
     * @Get(
     *     path = "/list",
     *     name="students_list",
     * )
     * @Rest\View(serializerGroups={"student"})
     * @Rest\QueryParam(name="bordee", requirements="\d+", nullable=true, description="Id de la bordée")
     * @Rest\QueryParam(name="referent", requirements="\d+", nullable=true, description="Id du prof. principal")
     */
    public function getStudents($bordee, $referent, StudentRepository $studentRepository)
    {
        $params = [];
        if($referent){
            $referent = $this->getDoctrine()->getRepository(Referent::class)->find($referent);
            $params['referent'] = $referent;
        }
        if($bordee){
            $bordee = $this->getDoctrine()->getRepository(Bordee::class)->find($bordee);
            $params['bordee'] = $bordee;
        }
        return $studentRepository->findBy($params);
    }

    /**
     * @Get(
     *     path = "/schools/{id}",
     *     name="students_school_list",
     *     requirements={"id":"\d+"}
     * )
     * @Rest\View(serializerGroups={"student"})
     */
    public function getStudentsBySchool(School $school, StudentRepository $studentRepository)
    {     
        return $studentRepository->findBy([
            'school' => $school
        ]);
    }
    /**
     * @Get(
     *     path = "/specialisation/{id}",
     *     name="students_specialisation_list",
     *     requirements={"id":"\d+"}
     * )
     * @Rest\View(serializerGroups={"student"})
     */
    public function getStudentsBySpecialisation(Specialisation $specialisation, StudentRepository $studentRepository)
    {     
        return $studentRepository->findBy([
            'specialisation' => $specialisation
        ]);
    }
}
