<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Campus;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    #[Route('/user', name: 'user_form', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('user/user.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user', name: 'user_create', methods: ['POST'])]
    public function createUser(Request $request): Response
    {
        $pseudo = $request->request->get('pseudo');
        $password = $request->request->get('password');

        $user = new Participant();
        $user->setPseudo($pseudo);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            $password
        ));
        $campus = new Campus();
        $campus = $this->getDoctrine()->getRepository(Campus::class)->find(1);
        $user->setCampusNoCampus($campus);
        $user->setRoles(array_unique(['USER']));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->redirectToRoute('app_login');
    }
}
