<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
