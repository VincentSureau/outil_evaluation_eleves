<?php

namespace App\Controller\Back;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Student;
use Symfony\Component\HttpFoundation\Response;
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
    // On crée une  instance pour définir les options de notre fichier pdf
    $options = new Options();
    // Pour simplifier l'affichage des images, on autorise dompdf à utiliser 
    // des  url pour les nom de  fichier
    $options->set('isRemoteEnabled', TRUE);
    // On crée une instance de dompdf avec  les options définies
    $dompdf = new Dompdf($options);
    // On demande à Symfony de générer  le code html  correspondant à 
    // notre template, et on stocke ce code dans une variable
    $html = $this->renderView('back/pdf/index.html.twig', [
        'student' => $student
    ]);
    // On envoie le code html  à notre instance de dompdf
    $dompdf->loadHtml($html);        
    // On demande à dompdf de générer le  pdf
    $dompdf->render();
    // On renvoie  le flux du fichier pdf dans une  Response pour l'utilisateur
    return new Response ($dompdf->stream());
    }
}
