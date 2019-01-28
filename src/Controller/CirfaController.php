<?php

namespace App\Controller;

use App\Entity\Cirfa;
use App\Form\CirfaType;
use App\Repository\CirfaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cirfa")
 */
class CirfaController extends AbstractController
{
    /**
     * @Route("/", name="cirfa_index", methods={"GET"})
     */
    public function index(CirfaRepository $cirfaRepository): Response
    {
        return $this->render('cirfa/index.html.twig', [
            'cirfas' => $cirfaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cirfa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cirfa = new Cirfa();
        $form = $this->createForm(CirfaType::class, $cirfa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cirfa);
            $entityManager->flush();

            return $this->redirectToRoute('cirfa_index');
        }

        return $this->render('cirfa/new.html.twig', [
            'cirfa' => $cirfa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cirfa_show", methods={"GET"})
     */
    public function show(Cirfa $cirfa): Response
    {
        return $this->render('cirfa/show.html.twig', [
            'cirfa' => $cirfa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cirfa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cirfa $cirfa): Response
    {
        $form = $this->createForm(CirfaType::class, $cirfa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cirfa_index', [
                'id' => $cirfa->getId(),
            ]);
        }

        return $this->render('cirfa/edit.html.twig', [
            'cirfa' => $cirfa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cirfa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cirfa $cirfa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cirfa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cirfa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cirfa_index');
    }
}
