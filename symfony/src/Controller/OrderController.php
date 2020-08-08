<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/", name="order_index", methods={"GET"})
     */
    public function index(OrderRepository $orderRepository): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('order/index.html.twig', [
            'orders' => $orderRepository->findAllByBookedUser($this->getUser()->getId()),
        ]);
    }

    /**
     * @Route("/new/{id}", name="order_new", methods={"GET","POST"})
     */
    public function new(Request $request, $id): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $order = new Order();
        $order->setOfficeId($id);
        $user = $this->getUser();
        $order->setBookedBy($user->getId());
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/new.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_show", methods={"GET"})
     */
    public function show(Order $order): Response
    {
        return $this->render('order/show.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Order $order): Response
    {
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_index');
        }

        return $this->render('order/edit.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('delete' . $order->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($order);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_index');
    }

    /**
     * @Route("/approve/{id}", name="order_approve", methods={"POST"})
     */
    public function approve(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('update' . $order->getId(), $request->request->get('_token'))) {
            $this->updateApprovedOrder($order, TRUE);
        }

        return $this->redirectToRoute('my-office-for-renting');

    }

    /**
     * @Route("/reject/{id}", name="order_reject", methods={"POST"})
     */
    public function reject(Request $request, Order $order): Response
    {
        if ($this->isCsrfTokenValid('update' . $order->getId(), $request->request->get('_token'))) {
            $this->updateApprovedOrder($order, FALSE);
        }

        return $this->redirectToRoute('my-office-for-renting');
    }

    /**
     * Update approved status of an order.
     */
    public function updateApprovedOrder(Order $order, $approved)
    {
        $order->setApproved($approved);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($order);
        $entityManager->flush();
    }

}
