<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaysController extends AbstractController
{
    /**
     * @Route("/pays", name="pays")
     */
    public function index()
    {
        return $this->render('pays/index.html.twig', [
            'controller_name' => 'PaysController',
        ]);
    }
}
