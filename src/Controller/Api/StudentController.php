<?php

namespace App\Controller\Api;

use App\Entity\Cirfa;
use App\Entity\Bordee;
use App\Entity\School;
use App\Entity\Referent;
use App\Entity\Specialisation;
use App\Repository\CirfaRepository;
use App\Repository\StudentRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/students")
 */
class StudentController extends AbstractController
{
    /**
     * @Get(
     *     path = "/students",
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
}
