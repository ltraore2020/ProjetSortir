<?php

namespace App\Controller;

use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

class SortieController extends AbstractController
{
    #[Route('/sortie/create', name: 'sortie_create', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('sortie/CreateSortie.html.twig');
    }

    #[Route('/api/sortie', name: 'sortie_api_get', methods: ['GET'])]
    public function getSorties(): Response
    {
        dump("From get sortie api");
        $repository = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repository->findAll();

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(
            $sorties,
            'json',
            [AbstractNormalizer::ATTRIBUTES => ['id', 'nom']]
        );

        dump($jsonResponse);
        $response = new Response($jsonResponse);
        return $response;
    }
}
