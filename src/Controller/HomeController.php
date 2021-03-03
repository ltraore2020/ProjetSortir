<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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

    // #[Route('/react/home', name: 'home')]
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        dump("From react home");
        return $this->render('main/ReactHome.html.twig');
    }
}
