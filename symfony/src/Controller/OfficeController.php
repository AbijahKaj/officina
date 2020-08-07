<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OfficeController extends AbstractController {
    /**
     * @Route("/add-office", name="add-office")
     */
    public function index()
    {
        return $this->render('office/index.html.twig', [
            'controller_name' => 'OfficeController',
        ]);
    }
}
