<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Entity\Participant;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        date_default_timezone_set('Europe/paris');
        $date = date("d/m/Y");
        return $this->render('main/home.html.twig', [
            'controller_name' => 'HomeController',
            'date' => $date
        ]);
    }

    #[Route('/react/home')]
    public function testReact(): Response
    {
        return $this->render('baseReact.html.twig');
    }

    #[Route('/react/home2')]
    public function testReact2(): Response
    {
        return $this->render('main/ReactHome.html.twig');
    }

    #[Route('/react/api/participant')]
    public function getParticipant(): Response
    {
        $participant = new Participant();
        $participant->setNom('Marley');
        $participant->setPrenom('Bob');

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(array($participant), 'json');
        $response = new Response($jsonResponse);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
