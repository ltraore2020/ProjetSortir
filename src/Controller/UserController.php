<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Entity\Campus;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{

    private $passwordEncoder;
    private $security;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        Security $security
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->security = $security;
    }

    #[Route('/user/form', name: 'user_form', methods: ['GET'])]
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

    #[Route('/user', name: 'user_get', methods: ['GET'])]
    public function getUser(): Response
    {
        return $this->render('main/Profil.html.twig');
    }

    #[Route('/user/profil', name: 'user_profil', methods: ['GET'])]
    public function profilUser(): Response
    {
        return $this->render('main/ProfilUser.html.twig');
    }



    #[Route('/api/user', name: 'user_api_get', methods: ['GET'])]
    public function getParticipant(Request $request): Response
    {

        $pseudo = $this->security->getUser()->getUsername();

        $repository = $this->getDoctrine()->getRepository(Participant::class);
        $user = new Participant();
        $user = $repository->findOneBy(['pseudo' => $pseudo]);

        $participant = new Participant();
        $participant->setPseudo($user->getPseudo());

        // dump($request->headers->get('content-type'));
        dump($request->headers);

        $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
        $jsonResponse = $serializer->serialize(array($participant), 'json');
        $response = new Response($jsonResponse);
        // $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }

    #[Route('/api/user', name: 'user_api_patch', methods: ['PATCH'])]
    public function patchUser(Request $request): Response
    {
        $content = $request->getContent();
        dump($content);
        // return $this->json(['pseudo' => 'pseudo']);
        $response = new Response($this->json(['pseudo' => 'pseudo']));
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
        // return $this->redirectToRoute('home');
    }
}
