<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

use App\Entity\Campus;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @IsGranted("ROLE_USER")
 */
class HomeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // return $this->render('main/ReactHome.html.twig');
        return $this->render('baseReact.html.twig');
    }

    #[Route('/api/date', name: 'date')]
    public function getDate(): Response
    {
        date_default_timezone_set('Europe/paris');
        $date = date("d/m/Y");
        $response = new JsonResponse(['date' => stripslashes($date)]);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    #[Route('/api/campus', name: 'campus_api_get', methods: ['GET'])]
    public function getCampus(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Campus::class);
        $campus = $repository->findAll();

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(
            $campus,
            'json',
            [AbstractNormalizer::ATTRIBUTES => ['id', 'nom']]
        );

        $response = new Response($jsonResponse);
        return $response;
    }
}
