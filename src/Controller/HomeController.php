<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\Participant;
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

    // #[Route('/react/home', name: 'home')]
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        dump("From react home");
        return $this->render('main/ReactHome.html.twig');
    }

    #[Route('/api/date', name: 'date')]
    public function getDate(): Response
    {
        date_default_timezone_set('Europe/paris');
        $date = date("d/m/Y");
        // $response = new Response();
        // $response->setContent(
        //     json_encode(['date' => $date])
        // );
        $response = new JsonResponse(['date' => stripslashes($date)]);
        dump($date);
        dump($response);
        // $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
