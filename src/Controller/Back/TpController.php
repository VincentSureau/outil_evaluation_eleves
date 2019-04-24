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
    public function new(Specialisation $specialisation, Request $request): Response
    {
        $tp = new Tp();
        $tp->setSpecialisation($specialisation);
        $form = $this->createForm(TpType::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tp);
            $entityManager->flush();

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
    public function edit(Request $request, Tp $tp): Response
    {
        $form = $this->createForm(TpType::class, $tp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            switch($tp->getSpecialisation()->getName()){
                case 'MELEC':
                    $tasks = [];
                    $subCompetences = [];

                    foreach($form->get('tasks')->getData() as $task){
                        $tasks[] = $task->getId();
                    }

                    foreach($form->get('subCompetences')->getData() as $subCompetence){
                        $subCompetences[] = $subCompetence->getId();
                    }

                    $datas = [
                        'tasks' => $tasks,
                        'subCompetences' => $subCompetences,
                    ];
                    break;
                
                case 'MEI':
                    $datas = [
                        'tasks' => $form->get('tasks')->getData(),
                    ];
                    break;

                case 'SN':
                    $tasks = [];

                    foreach($form->get('tasks')->getData() as $task){
                        $tasks[] = $task->getId();
                    }

                    $datas = [
                        'tasks' => $tasks,
                    ];
                    break;
            }

            $tp->setDatas($datas);
            $this->getDoctrine()->getManager()->flush();
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
        if ($this->isCsrfTokenValid('delete'.$tp->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tp);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tp_index');
    }
}
