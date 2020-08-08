<?php

namespace App\Controller;

use App\Entity\Office;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class OfficeController extends AbstractController
{
    /**
     * @Route("/add-office", name="add-office")
     */
    public function index()
    {
        return $this->render('office/index.html.twig', [
            'controller_name' => 'OfficeController',
        ]);
    }

    /**
     * @Route("/office-enable/{id}", name="office_enable", methods={"POST"})
     */
    public function enable(Request $request, Office $office): Response
    {
        if ($this->isCsrfTokenValid('update' . $office->getId(), $request->request->get('_token'))) {
            $this->updateOfficeAvailability($office, TRUE);
        }

        return $this->redirectToRoute('my-offices-for-renting');

    }

    /**
     * @Route("/office-disable/{id}", name="office_disable", methods={"POST"})
     */
    public function disable(Request $request, Office $office): Response
    {
        if ($this->isCsrfTokenValid('update' . $office->getId(), $request->request->get('_token'))) {
            $this->updateOfficeAvailability($office, FALSE);
        }

        return $this->redirectToRoute('my-offices-for-renting');
    }

    /**
     * Update approved status of an order.
     */

    public function updateOfficeAvailability(Office $office, $availability)
    {
        $office->setAvailable($availability);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($office);
        $entityManager->flush();
    }

}
