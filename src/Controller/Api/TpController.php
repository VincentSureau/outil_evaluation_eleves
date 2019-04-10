<?php

namespace App\Controller\Api;

use App\Entity\Tp;
use App\Form\TpType;
use App\Entity\Specialisation;
use App\Repository\TpRepository;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/tp")
 */
class TpController extends AbstractController
{
    /**
     * @Get(
     *     path = "/specialisations/{id}",
     *     name="tps_list",
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
}
