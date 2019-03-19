<?php

namespace App\Controller\Back;

use App\Entity\Tp;
use App\Form\TpType;
use App\Repository\TpRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tp")
 */
class TpController extends AbstractController
{
    /**
     * @Route("/", name="tp_index", methods={"GET"})
     */
    public function index(TpRepository $tpRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $query = $tpRepository->findAll();
        $tps = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('back/tp/index.html.twig', [
            'pagination' => $tps,
        ]);
    }

    /**
     * @Route("/new", name="tp_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tp = new Tp();
        $form = $this->createForm(TpType::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tp);
            $entityManager->flush();

            return $this->redirectToRoute('tp_index');
        }

        return $this->render('back/tp/new.html.twig', [
            'tp' => $tp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tp_show", methods={"GET"})
     */
    public function show(Tp $tp): Response
    {
        return $this->render('back/tp/show.html.twig', [
            'tp' => $tp,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tp_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tp $tp): Response
    {
        $form = $this->createForm(TpType::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tp_index', [
                'id' => $tp->getId(),
            ]);
        }

        return $this->render('back/tp/edit.html.twig', [
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
