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
use Symfony\Component\HttpFoundation\JsonResponse;

class MainController extends AbstractController
{
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
        $cities = ['California' => count($this->officePostRepository->findAllMatching('California')),
            'Philadelphia' => count($this->officePostRepository->findAllMatching('Philadelphia')),
            'Chicago' => count($this->officePostRepository->findAllMatching('Chicago')),
            'LA' => count($this->officePostRepository->findAllMatching('Los Angeles')),
            'NYC' => count($this->officePostRepository->findAllMatching('New York'))
        ];

        $data = $this->officePostRepository->findBy([
                'available' => true
        ]);

        return $this->render('office/entries.html.twig', [
            'entries' => $data,
            'geojson' => $this->getGeoJSON($data),
            'latest' => $this->getLatestOffices(),
            'cities' => $cities
        ]);
    }
    public function getGeoJSON($data){
        $geojson = array( 'type' => 'FeatureCollection', 'features' => array());
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
        return $geojson;
    }
    public function getLatestOffices(){
        $array = $this->officePostRepository->getLatest();
        $data =  array();
        foreach ($array as $row) {
            $_office = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'image' => $row->getImages()[0],
                'address' => $row->getLocation(),
                'user' => $row->getUser(),
                'image_count' => count($row->getImages()),
                'posted_on' => date('d M Y',$row->getPostedOn()),
                'price' => $row->getPrice()
            );

            $data[] = $_office;
        }
        return $data;
    }

    /**
     *
     * @Route("/search", name="search_", methods={"GET"})
     *
     */
    public function redirectFromSearch(){
        return $this->redirectToRoute('homepage');
    }


    /**
     *
     * @Route("/search/{query}", name="search"))
     * @param string $query
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(string $query){

        $offices = $this->officePostRepository->findAllMatching($query);
        $data =  array();
        foreach ($offices as $row) {
            $_office = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'address' => $row->getLocation(),
                'price' => $row->getPrice()
            );

            $data[] = $_office;
        }
        //$result = array('count' => count($data));
        return $this->render('office/search.html.twig', [
            'entries' => $offices,
            'latest' => $this->getLatestOffices(),
            'geojson' => $this->getGeoJSON($offices),
            'count' => count($offices),
            'query' => $query
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
	    $office->setPostedOn(time());

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

    /**
     * @Route("/search-auto", name="search_auto")
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchAutocomplete(Request $request)
    {
        $term = $request->request->get('query');

        $array = $this->officePostRepository->findAllMatching($term);
        $data =  array();
        foreach ($array as $row) {
            $_office = array(
                'id' => $row->getId(),
                'name' => $row->getName(),
                'address' => $row->getLocation(),
                'price' => $row->getPrice()
            );

            $data[] = $_office;
        }
        return new JsonResponse($data);
    }
}
