<?php

namespace App\Controller;

use App\Entity\Specialisation;
use App\Form\Specialisation1Type;
use App\Repository\SpecialisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/specialisation")
 */
class SpecialisationController extends AbstractController
{
    /**
     * @Route("/", name="specialisation_index", methods={"GET"})
     */
    public function index(SpecialisationRepository $specialisationRepository): Response
    {
        return $this->render('specialisation/index.html.twig', [
            'specialisations' => $specialisationRepository->findAll(),
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

        return $this->render('specialisation/new.html.twig', [
            'specialisation' => $specialisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="specialisation_show", methods={"GET"})
     */
    public function show(Specialisation $specialisation): Response
    {
        return $this->render('specialisation/show.html.twig', [
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

        return $this->render('specialisation/edit.html.twig', [
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
