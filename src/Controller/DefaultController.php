<?php

namespace App\Controller;

use App\Entity\Logement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $logements = $this->getDoctrine()->getRepository(Logement::class)->findAll();
        return $this->render('default/homepage.html.twig', [
            'logements' => $logements
        ]);
    }
}
