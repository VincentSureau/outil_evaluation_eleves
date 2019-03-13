<?php

namespace App\Controller;

use App\Entity\Tp;
use App\Form\Tp1Type;
use App\Repository\TpRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tp")
 */
class TpController extends AbstractController
{
    /**
     * @Route("/", name="tp_index", methods={"GET"})
     */
    public function index(TpRepository $tpRepository): Response
    {
        return $this->render('tp/index.html.twig', [
            'tps' => $tpRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tp_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tp = new Tp();
        $form = $this->createForm(Tp1Type::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tp);
            $entityManager->flush();

            return $this->redirectToRoute('tp_index');
        }

        return $this->render('tp/new.html.twig', [
            'tp' => $tp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tp_show", methods={"GET"})
     */
    public function show(Tp $tp): Response
    {
        return $this->render('tp/show.html.twig', [
            'tp' => $tp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tp_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tp $tp): Response
    {
        $form = $this->createForm(Tp1Type::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tp_index', [
                'id' => $tp->getId(),
            ]);
        }

        return $this->render('tp/edit.html.twig', [
            'tp' => $tp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tp_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tp $tp): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tp_index');
    }
}
