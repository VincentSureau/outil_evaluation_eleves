<?php

namespace App\Controller\Back;

use App\Entity\Referent;
use App\Form\ReferentType;
use App\Repository\ReferentRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/referent")
 */
class ReferentController extends AbstractController
{
    /**
     * @Route("/", name="referent_index", methods={"GET"})
     */
    public function index(ReferentRepository $referentRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $referentRepository->findAll();
        $referents = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('back/referent/index.html.twig', [
            'pagination' => $referents,
        ]);
    }

    /**
     * @Route("/new", name="referent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $referent = new Referent();
        $form = $this->createForm(ReferentType::class, $referent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($referent);
            $entityManager->flush();

            return $this->redirectToRoute('referent_index');
        }

        return $this->render('back/referent/new.html.twig', [
            'referent' => $referent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="referent_show", methods={"GET"})
     */
    public function show(Referent $referent): Response
    {
        return $this->render('back/referent/show.html.twig', [
            'referent' => $referent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="referent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Referent $referent): Response
    {
        $form = $this->createForm(ReferentType::class, $referent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('referent_index', [
                'id' => $referent->getId(),
            ]);
        }

        return $this->render('back/referent/edit.html.twig', [
            'referent' => $referent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="referent_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Referent $referent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$referent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($referent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('referent_index');
    }
}
