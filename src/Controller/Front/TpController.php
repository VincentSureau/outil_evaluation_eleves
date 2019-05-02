<?php

namespace App\Controller\Front;

use App\Entity\Tp;
use App\Form\TpType;
use App\Entity\Specialisation;
use App\Repository\TpRepository;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tp")
 */
class TpController extends AbstractController
{
    /**
     * @Route("/specialisation/{id}", name="tp_index", methods={"GET"})
     */
    public function index(Specialisation $specialisation, TpRepository $tpRepository): Response
    {
        return $this->render('front/tp/index.html.twig', [
            'specialisation' => $specialisation
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

        return $this->render('front/tp/new.html.twig', [
            'tp' => $tp,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tp_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Tp $tp): Response
    {
        return $this->render('front/tp/show.html.twig', [
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

        return $this->render('front/tp/edit.html.twig', [
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


    /**
     * @Get(
     *     path = "/specialisations/{id}",
     *     name="specialisation_tps_list",
     *     requirements={"id":"\d+"}
     * )
     * @Rest\View()
     */
    public function getTpsBySpecialisation(Specialisation $specialisation, TpRepository $tpRepository)
    {
        return $tpRepository->findBy([
            'specialisation' => $specialisation,
        ]);
    }

    /**
     * @Get(
     *     path = "/list",
     *     name="tps_list",
     * )
     * @Rest\View(serializerGroups={"tp"})

     */
    public function getTps(TpRepository $tpRepository)
    {
        return $tpRepository->findAll();
    }
}
