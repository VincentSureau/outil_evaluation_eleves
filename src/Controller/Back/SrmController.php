<?php

namespace App\Controller\Back;

use App\Entity\Srm;
use App\Form\SrmType;
use App\Repository\SrmRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/srm")
 */
class SrmController extends AbstractController
{
    /**
     * @Route("/", name="srm_index", methods={"GET"})
     */
    public function index(SrmRepository $srmRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $srmRepository->findAll();
        $srms = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('back/srm/index.html.twig', [
            'pagination' => $srms,
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

        return $this->render('back/srm/new.html.twig', [
            'srm' => $srm,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="srm_show", methods={"GET"})
     */
    public function show(Srm $srm): Response
    {
        return $this->render('back/srm/show.html.twig', [
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

        return $this->render('back/srm/edit.html.twig', [
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
