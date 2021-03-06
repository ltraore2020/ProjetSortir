<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $repository = $this->getDoctrine()->getRepository(Sortie::class);
        $sorties = $repository->findAll();

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(
            $sorties,
            'json',
            [AbstractNormalizer::ATTRIBUTES =>
            [
                'id', 'nom', 'dateDebut', 'dateCloture', 'nbInscriptionMax',
                'organisateur' => ['pseudo'], 'etatsNoEtat' => ['libelle'],
                'inscrits'
            ]]
        );

        $response = new Response($jsonResponse);
        return $response;
    }

    #[Route('/api/searchSortie', name: 'sortie_api_search', methods: ['POST'])]
    public function searchSorties(Request $request): Response
    {
        $champ = $request->getContent();
        $params = json_decode($champ);
        /** @var SortieRepository */
        $repository = $this->getDoctrine()->getRepository(Sortie::class);
        $value = $params->contient;
        $sorties = $repository->findByName($value);

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(
            $sorties,
            'json',
            [AbstractNormalizer::ATTRIBUTES => ['id', 'nom']]
        );

        $response = new Response($jsonResponse);
        return $response;
    }

    #[Route('/viewSortie', name: 'sortie_get', methods: ['GET'])]
    public function viewSorties(Request $request): Response
    {
        $champ = $request->getContent();
        $params = json_decode($champ);
        /** @var SortieRepository */
        $repository = $this->getDoctrine()->getRepository(Sortie::class);
        $value = $params->contient;
        $sorties = $repository->findByName($value);

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(
            $sorties,
            'json',
            [AbstractNormalizer::ATTRIBUTES => ['id', 'nom']]
        );

        $response = new Response($jsonResponse);
        return $response;
    }
}
