<?php

namespace App\Controller;

use App\Entity\Area;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $areas = $this->getDoctrine()->getRepository(Area::class)->findAll();

        return $this->render('area/list.html.twig', ['areas' => $areas]);
    }
}
