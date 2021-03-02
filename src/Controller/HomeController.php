<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Participant;

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
    // #[Route('/home', name: 'home')]
    // public function index(): Response
    // {
    //     date_default_timezone_set('Europe/paris');
    //     $date = date("d/m/Y");
    //     return $this->render('main/home.html.twig', [
    //         'controller_name' => 'HomeController',
    //         'date' => $date
    //     ]);
    // }

    #[Route('/react/home', name: 'home')]
    public function index(): Response
    {
        dump("From react home");
        return $this->render('main/ReactHome.html.twig');
    }


    #[Route('/api/react/participant')]
    public function getParticipant(): Response
    {
        $pseudo = $this->security->getUser()->getUsername();
        $repository = $this->getDoctrine()->getRepository(Participant::class);
        $user = new Participant();
        $user = $repository->findOneBy(['pseudo' => $pseudo]);

        // $participant->setCampusNoCampus(null);
        $participant = new Participant();
        $participant->setPseudo($user->getPseudo());

        // dump($user);

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(array($participant), 'json');
        $response = new Response($jsonResponse);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
