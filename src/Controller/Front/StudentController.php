<?php

namespace App\Controller\Front;

use App\Entity\Tp;
use App\Entity\Srm;
use App\Entity\Cirfa;
use App\Entity\Bordee;
use App\Entity\School;
use App\Entity\Student;
use App\Entity\Referent;
use App\Form\StudentType;
use App\Form\StudentsType;
use App\Form\TpChoiceType;
use App\Service\Excel2Table;
use App\Entity\Specialisation;
use App\Form\TpEvaluationType;
use App\Form\ReviewCommentType;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        return $this->render('front/student/index.html.twig', ['referent' => $referent, 'bordee' => $bordee, 'params' => $params]);
    }

    /**
     * @Route("/add", name="students_add", methods={"GET","POST"})
     */
    public function add(Request $request, Excel2Table $excelConverter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StudentsType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $uploadedsheet = $form['spreadsheet']->getData();
            $sheetname = $form['sheet']->getData();

            $table = $excelConverter->convertSheet($uploadedsheet, $sheetname);

            $bordee = $this->getDoctrine()->getRepository(Bordee::class)->findOneByName($sheetname);
            if(!$bordee){
                $bordee = new Bordee();
                $bordee->setName($sheetname);
                $entityManager->persist($bordee);
            }

            foreach($table as $data){

                $student = $this->getDoctrine()->getRepository(Student::class)->findOneBy([
                    'lastname' => $data['NOM'],
                    'firstname' => $data['Prénom'],
                    'birthdate' => $data['Date de naissance']
                ]);

                if (!$student) {
                    $student = new Student();
                }

                $student->setLastname($data['NOM'])
                        ->setFirstname($data['Prénom'])
                        ->setBirthdate($data['Date de naissance'])
                        ->setBirthplace($data['Lieu de naissance'])
                        ->setCity($data['Ville LP'])
                        ->setGender($data['Sexe'])
                        ->setBordee($bordee);
                ;

                $specialisation = $this->getDoctrine()->getRepository(Specialisation::class)->findOneByName($data['SPE']);
                if($specialisation){
                    $student->setSpecialisation($specialisation);
                } else {
                    $this->addFlash(
                        'danger',
                        sprintf('La spécialisation %s, n\'existe pas, merci de l\'ajouter et recommencer', $data['SPE'])
                    );
                    return $this->redirectToRoute('students_add');
                }

                $srm = $this->getDoctrine()->getRepository(Srm::class)->findOneByName($data['SRM']);
                if($srm){
                    $student->setSrm($srm);
                } else {
                    $this->addFlash(
                        'danger',
                        sprintf('Le SRM %s, n\'existe pas, merci de l\'ajouter et recommencer', $data['SRM'])
                    );
                    return $this->redirectToRoute('students_add');
                }

                $school = $this->getDoctrine()->getRepository(School::class)->findOneBy([
                    'name' => $data['Lycée Prof'],
                    'academy' => $data['Académie']
                ]);
                if($school){
                    $student->setSchool($school);
                } else {
                    $this->addFlash(
                        'danger',
                        sprintf('Le lycée %s (Académie de %s), n\'existe pas, merci de l\'ajouter et recommencer', $data['Lycée Prof'], $data['Académie'])
                    );
                    return $this->redirectToRoute('students_add');
                }

                $cirfa = $this->getDoctrine()->getRepository(Cirfa::class)->findOneByCity($data['CIRFA']);
                if($cirfa){
                    $student->setCirfa($cirfa);
                } else {
                    $this->addFlash(
                        'danger',
                        sprintf('Le CIRFA %s, n\'existe pas, merci de l\'ajouter et recommencer', $data['CIRFA'])
                    );
                    return $this->redirectToRoute('students_add');
                }

                $referentName = explode(" ", $data['Professeur Principale'])[1];
                $referent = $this->getDoctrine()->getRepository(Referent::class)->findOneByLastname($referentName);
                if($referent){
                    $student->setReferent($referent);
                } else {
                    $this->addFlash(
                        'danger',
                        sprintf('Le prof. principal %s, n\'existe pas, merci de l\'ajouter et recommencer', $data['Professeur Principale'])
                    );
  
                    return $this->redirectToRoute('students_add');
                }
                $entityManager->persist($student);

            }

            $entityManager->flush();

            $this->addFlash('success', 'La bordée a été ajoutée avec succès');

            return $this->redirectToRoute('students_add');
        }

        return $this->render('front/student/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Student $student): Response
    {
        return $this->render('front/student/show.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/{id}/tp", name="student_tp_list", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function showTp(Student $student, Request $request): Response
    {
        $form = $this->createForm(TpChoiceType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(isset($request->request->get('tp_choice')['tp'])){
                $tpId = $request->request->get('tp_choice')['tp'];
                $review = $student->getReview();

                $tp = $this->getDoctrine()->getRepository(Tp::class)->find($tpId);

                $review->addTp($tp);
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('student_tp_evaluate', [
                    'id' => $student->getId(),
                    'tp' => $tpId,
                ]);
            }
        }

        return $this->render('front/student/tpchoice.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/tp/{tp}", name="student_tp_evaluate", methods={"GET","POST"}, requirements={"id":"\d+", "tp":"\d+"})
     */
    public function evaluateTp(Student $student, Tp $tp, Request $request): Response
    {
        return $this->render('front/tp/tpevaluate.html.twig', [
            'student' => $student,
            'tp' => $tp,
            // 'form' => $form->createView(),
        ]);
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


    /**
     * @Route("/{id}/review/comment", name="student_comment_review", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function commentReview(Student $student, Request $request): Response
    {
        $review = $student->getReview();
        $form = $this->createForm(ReviewCommentType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Votre commentaire a bien été enregistré');

            return $this->redirectToRoute('student_show', [
                'id' => $student->getId(),
            ]);
        }

        return $this->render('front/student/tpchoice.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }

}
