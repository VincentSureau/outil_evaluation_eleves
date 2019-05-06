<?php

namespace App\Controller\Back;

use App\Entity\Tp;
use App\Form\TpType;
use App\Entity\Specialisation;
use App\Repository\TpRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\TpManager;

/**
 * @Route("/tp")
 */
class TpController extends AbstractController
{
    /**
     * @Route("/{id}", name="tp_index", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function index(Specialisation $specialisation): Response
    {
        return $this->render('back/tp/index.html.twig', [
            'specialisation' => $specialisation,
        ]);
    }

    /**
     * @Route("/specialisation/{id}/new", name="tp_new", methods={"GET","POST"}, requirements={"id"="\d+"})
     */
    public function new(Specialisation $specialisation, Request $request, TpManager $tpManager): Response
    {
        $tp = new Tp();
        $tp->setSpecialisation($specialisation);
        $form = $this->createForm(TpType::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($tpManager->save($tp, $form)) {
                $this->addFlash('success', 'Le TP ' . $tp->getName() . ' a bien été ajouté');
            } else {
                $this->addFlash('danger', 'Une erreur est survenue, le TP n\'a pas été enregistré');
            }
            return $this->redirectToRoute('admin_tp_index', ['id' => $specialisation->getId()]);
        }

        return $this->render('back/tp/new.html.twig', [
            'specialisation' => $specialisation,
            'tp' => $tp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tp_show", methods={"GET"}, requirements={"id":"\d+"})
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
    public function edit(Request $request, Tp $tp, TpManager $tpManager): Response
    {
        $form = $this->createForm(TpType::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($tpManager->save($tp, $form)) {
                $this->addFlash('success', 'Le TP ' . $tp->getName() . ' a bien été ajouté');
            } else {
                $this->addFlash('danger', 'Une erreur est survenue, le TP n\'a pas été modifié');
            }
            return $this->redirectToRoute('admin_tp_index', [
                'id' => $tp->getSpecialisation()->getId(),
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

        $specialisation = $tp->getSpecialisation();

        if ($this->isCsrfTokenValid('delete'.$tp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tp);
            $entityManager->flush();

            $this->addFlash('danger', 'le TP a bien été supprimé');
        }

        return $this->redirectToRoute('admin_tp_index', ['id' => $specialisation->getId()]);
    }
}
