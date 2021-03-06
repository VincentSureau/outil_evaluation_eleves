<?php

namespace App\Controller\Back;

use App\Entity\School;
use App\Form\SchoolType;
use App\Repository\SchoolRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/school")
 */
class SchoolController extends AbstractController
{
    /**
     * @Route("/", name="school_index", methods={"GET"})
     */
    public function index(SchoolRepository $schoolRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $schoolRepository->findAll();
        $schools = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('back/school/index.html.twig', [
            'pagination' => $schools,
        ]);
    }

    /**
     * @Route("/new", name="school_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $school = new School();
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($school);
            $entityManager->flush();

            return $this->redirectToRoute('school_index');
        }

        return $this->render('back/school/new.html.twig', [
            'school' => $school,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="school_show", methods={"GET"})
     */
    public function show(School $school): Response
    {
        return $this->render('back/school/show.html.twig', [
            'school' => $school,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="school_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, School $school): Response
    {
        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('school_index', [
                'id' => $school->getId(),
            ]);
        }

        return $this->render('back/school/edit.html.twig', [
            'school' => $school,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="school_delete", methods={"DELETE"})
     */
    public function delete(Request $request, School $school): Response
    {
        if ($this->isCsrfTokenValid('delete'.$school->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($school);
            $entityManager->flush();
        }

        return $this->redirectToRoute('school_index');
    }
}
