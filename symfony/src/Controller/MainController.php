<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Office;
use App\Form\OfficeFormType;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        $geojson = array( 'type' => 'FeatureCollection', 'features' => array());
        $data = $this->officePostRepository->findBy([
                'available' => true
        ]);
        foreach ($data as $row) {

            $marker = array(
                'type' => 'Feature',
                'geometry' => array(
                    'type' => 'Point',
                    'coordinates' => array(
                        $row->getLon(),
                        $row->getLat()
                    )
                ),
                'properties' => array(
                    'id' => $row->getId(),
                    'name' => $row->getName(),
                    'address' => $row->getLocation()
                )
            );
            array_push($geojson['features'], $marker);
        }
        return $this->render('office/entries.html.twig', [
            'entries' => $data,
            'geojson' => $geojson
        ]);
    }

	/**
	 * @Route("/post", name="post_office")
	 *
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function createEntryAction(Request $request, SluggerInterface $slugger)
	{
		if (null === $this->getUser()) {
			return $this->redirectToRoute('homepage');
		}
	    $office = new Office();

	    $office->setUser($this->getUser()->getID());

	    $form = $this->createForm(OfficeFormType::class, $office);
	    $form->handleRequest($request);

	    // Check is valid
	    if ($form->isSubmitted() && $form->isValid()) {

	    	$images = $form->get('upload')->getData();

	    	if ($images) {
	    	    $files = [];
	    	    foreach ($images as $image){
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$image->guessExtension();
                    try {
                        //$uploadDir = $this->get('kernel')->getRootDir() . '/../public/uploads/';
                        $uploadDir = $this->getParameter('upload_directory');
                        if (!file_exists($uploadDir) && !is_dir($uploadDir)) {
                            mkdir($uploadDir, 0775, true);
                        }
                        $image->move(
                            $uploadDir,
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }
                    $files[] = $newFilename;
                }
                $office->setImages($files);
	        }
	        

	        $this->entityManager->persist($office);
	        $this->entityManager->flush($office);

	        $this->addFlash('success', 'Congratulations! Your office is now available for renting');

	        return $this->redirectToRoute('entries');
	    }

	    return $this->render('office/entry_form.html.twig', [
	        'form' => $form->createView()
	    ]);
	}

}
