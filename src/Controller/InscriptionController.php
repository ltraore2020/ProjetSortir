<?php

namespace App\Controller;

use App\Entity\Inscription;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }

    #[Route('/api/inscription/{userId}', methods: ['GET'])]
    public function getInscription($userId): Response
    {
        $repository = $this->getDoctrine()->getRepository(Inscription::class);
        $inscriptions = $repository->findBy(["participant_no_participant" => $userId]);

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(
            $inscriptions,
            'json',
            [AbstractNormalizer::ATTRIBUTES => ['sortieNoSortie' => ['id']]]
        );

        $response = new Response($jsonResponse);
        return $response;
    }
}
