<?php

namespace App\Controller\Back;

use App\Entity\Cirfa;
use App\Form\CirfaType;
use App\Repository\CirfaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/cirfa")
 */
class CirfaController extends AbstractController
{
    /**
     * @Route("/", name="cirfa_index", methods={"GET"})
     */
    public function index(CirfaRepository $cirfaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $cirfaRepository->findAll();
        $cirfas = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('back/cirfa/index.html.twig', [
            'pagination' => $cirfas,
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

        return $this->render('back/cirfa/new.html.twig', [
            'cirfa' => $cirfa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cirfa_show", methods={"GET"})
     */
    public function show(Cirfa $cirfa): Response
    {
        return $this->render('back/cirfa/show.html.twig', [
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

        return $this->render('back/cirfa/edit.html.twig', [
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
