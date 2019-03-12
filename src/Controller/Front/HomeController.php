<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        if($this->isGranted('ROLE_USER')){
            return $this->render('front/home/index.html.twig', [
            ]);
        }else{
            return $this->redirectToRoute('app_register');
        }
    }
}
