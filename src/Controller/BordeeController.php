<?php

namespace App\Controller;

use App\Entity\Bordee;
use App\Form\BordeeType;
use App\Repository\BordeeRepository;
use App\Repository\ReferentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/bordee")
 */
class BordeeController extends AbstractController
{
    /**
     * @Route("/", name="bordee_index", methods={"GET"})
     */
    public function index(BordeeRepository $bordeeRepository, ReferentRepository $referentRepository): Response
    {
        return $this->render('bordee/index.html.twig', [
            'bordees' => $bordeeRepository->findAll(),
            'referents' => $referentRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="bordee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bordee = new Bordee();
        $form = $this->createForm(BordeeType::class, $bordee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bordee);
            $entityManager->flush();

            return $this->redirectToRoute('bordee_index');
        }

        return $this->render('bordee/new.html.twig', [
            'bordee' => $bordee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bordee_show", methods={"GET"})
     */
    public function show(Bordee $bordee): Response
    {
        return $this->render('bordee/show.html.twig', [
            'bordee' => $bordee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bordee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bordee $bordee): Response
    {
        $form = $this->createForm(BordeeType::class, $bordee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bordee_index', [
                'id' => $bordee->getId(),
            ]);
        }

        return $this->render('bordee/edit.html.twig', [
            'bordee' => $bordee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bordee_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bordee $bordee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bordee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bordee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bordee_index');
    }
}
