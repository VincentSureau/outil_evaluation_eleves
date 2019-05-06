<?php

namespace App\Controller\Back;

use App\Entity\Student;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PdfController extends AbstractController
{
    /**
     * @Route("/pdf/student/{id}", name="student_generate_pdf", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function evaluateTp(Student $student): BinaryFileResponse
    {
        $html2pdf = new Html2Pdf();

        
        $html = $this->renderView('back/pdf/index.html.twig', [
            'student' => $student
        ]);

        $html2pdf->writeHTML($html);
        
        return new BinaryFileResponse($html2pdf->output());

    }
}
