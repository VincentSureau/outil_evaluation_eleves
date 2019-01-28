<?php

namespace App\Controller;

use App\Entity\Srm;
use App\Form\SrmType;
use App\Repository\SrmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/srm")
 */
class SrmController extends AbstractController
{
    /**
     * @Route("/", name="srm_index", methods={"GET"})
     */
    public function index(SrmRepository $srmRepository): Response
    {
        return $this->render('srm/index.html.twig', [
            'srms' => $srmRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="srm_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $srm = new Srm();
        $form = $this->createForm(SrmType::class, $srm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($srm);
            $entityManager->flush();

            return $this->redirectToRoute('srm_index');
        }

        return $this->render('srm/new.html.twig', [
            'srm' => $srm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="srm_show", methods={"GET"})
     */
    public function show(Srm $srm): Response
    {
        return $this->render('srm/show.html.twig', [
            'srm' => $srm,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="srm_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Srm $srm): Response
    {
        $form = $this->createForm(SrmType::class, $srm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('srm_index', [
                'id' => $srm->getId(),
            ]);
        }

        return $this->render('srm/edit.html.twig', [
            'srm' => $srm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="srm_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Srm $srm): Response
    {
        if ($this->isCsrfTokenValid('delete'.$srm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($srm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('srm_index');
    }
}
