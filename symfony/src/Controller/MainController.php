<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Office;
use App\Form\OfficeFormType;

class MainController extends AbstractController {
	/** @var EntityManagerInterface */
	private $entityManager;

	/** @var \Doctrine\Common\Persistence\ObjectRepository */
	private $userRepository;

	/** @var \Doctrine\Common\Persistence\ObjectRepository */
	private $officePostRepository;

	/**
	 * @param EntityManagerInterface $entityManager
	 */
	public function __construct(EntityManagerInterface $entityManager)
	{
	    $this->entityManager = $entityManager;
	    $this->userRepository = $entityManager->getRepository('App:User');
	    $this->officePostRepository = $entityManager->getRepository('App:Office');
	}
    /**
	 * @Route("/", name="homepage")
	 * @Route("/entries", name="entries")
	 */
	public function entriesAction()
	{
	    return $this->render('office/entries.html.twig', [
	        'entries' => $this->officePostRepository->findAll()
	    ]);
	}

	/**
	 * @Route("/post", name="post_office")
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function createEntryAction(Request $request)
	{
	    $office = new Office();

	    //$user = $this->userRepository->findOneById($this->getUser()->getID());
	    $office->setUser($this->getUser()->getID());

	    $form = $this->createForm(OfficeFormType::class, $office);
	    $form->handleRequest($request);

	    // Check is valid
	    if ($form->isSubmitted() && $form->isValid()) {
	        $this->entityManager->persist($office);
	        $this->entityManager->flush($office);

	        $this->addFlash('success', 'Congratulations! Your post is created');

	        return $this->redirectToRoute('entries');
	    }

	    return $this->render('office/entry_form.html.twig', [
	        'form' => $form->createView()
	    ]);
	}

}
