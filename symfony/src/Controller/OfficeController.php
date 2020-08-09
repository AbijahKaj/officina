<?php

namespace App\Controller;

use App\Entity\Office;
use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

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
     * @Route("/office-delete/{id}", name="office_delete", methods={"POST"})
     */
    public function delete(Request $request, Office $office): Response
    {
        if ($this->isCsrfTokenValid('delete' . $office->getId(), $request->request->get('_token'))) {
            $this->deleteOffice($office);
        }

        return $this->redirectToRoute('my-offices-for-renting');
    }

    /**
     * Update approved status of an order.
     *
     * @param Office $office
     * @param $availability bool
     */
    public function updateOfficeAvailability(Office $office, $availability)
    {
        $office->setAvailable($availability);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($office);
        $entityManager->flush();
    }

    /**
     * Delete an office.
     *
     * @param Office $office
     */
    public function deleteOffice(Office $office)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $orderRepository = $entityManager->getRepository(Order::class);
        $allOrders = $orderRepository->findAllByOffice($office);
        if ($allOrders) {
            foreach ($allOrders as $order) {
                $entityManager->remove($order);
            }
        }

        $entityManager->remove($office);
        if ($images = $office->getImages()) {
            foreach ($images as $image)
                $this->deleteFile($this->getParameter('upload_directory') . $image);
        }

        $entityManager->flush();
    }

    /**
     * Delete a file from the system.
     *
     * @param string $filename
     */
    public function deleteFile(string $filename)
    {
        $filesystem = new Filesystem();
        $filesystem->remove($filename);
    }
}
