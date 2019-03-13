<?php

namespace App\Controller\Back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomeController extends AbstractController
{
    /**
     * @Route("/back/admin", name="back_admin_home")
     */
    public function index()
    {
        return $this->render('back/admin_home/index.html.twig', [
            
        ]);
    }
}
