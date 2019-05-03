<?php

namespace App\Controller\Back;

use App\Entity\Tp;
use App\Entity\Student;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfController extends AbstractController
{;
    /**
     * @Route("/pdf/{id}/tp/{tp}", name="student_tp_evaluate", methods={"GET"}, requirements={"id":"\d+", "tp":"\d+"})
     */
    public function evaluateTp(Student $student, Tp $tp)
    {
        $html2pdf = new Html2Pdf();


        return $this->renderView('front/tp/tpevaluate.html.twig', [
            'student' => $student,
            'tp' => $tp,
            // 'form' => $form->createView(),
        ]);

        // dd($html);

        // $html2pdf->writeHTML($html);

        // $html2pdf->output('test.pdf');
    }
}
