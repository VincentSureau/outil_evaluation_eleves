<?php

namespace App\Controller\Back;

use App\Entity\Specialisation;
use App\Form\Specialisation1Type;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\SpecialisationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/specialisation")
 */
class SpecialisationController extends AbstractController
{
    /**
     * @Route("/", name="specialisation_index", methods={"GET"})
     */
    public function index(SpecialisationRepository $specialisationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $specialisationRepository->findAll();
        $specialisations = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );        
        return $this->render('back/specialisation/index.html.twig', [
            'pagination' => $specialisations,
        ]);
    }

    /**
     * @Route("/new", name="specialisation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $specialisation = new Specialisation();
        $form = $this->createForm(Specialisation1Type::class, $specialisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($specialisation);
            $entityManager->flush();

            return $this->redirectToRoute('specialisation_index');
        }

        return $this->render('back/specialisation/new.html.twig', [
            'specialisation' => $specialisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialisation_show", methods={"GET"})
     */
    public function show(Specialisation $specialisation): Response
    {
        return $this->render('back/specialisation/show.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="specialisation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Specialisation $specialisation): Response
    {
        $form = $this->createForm(Specialisation1Type::class, $specialisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('specialisation_index', [
                'id' => $specialisation->getId(),
            ]);
        }

        return $this->render('back/specialisation/edit.html.twig', [
            'specialisation' => $specialisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialisation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Specialisation $specialisation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specialisation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($specialisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('specialisation_index');
    }
}
