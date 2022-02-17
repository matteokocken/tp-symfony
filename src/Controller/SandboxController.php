<?php

namespace App\Controller;

use http\Message\Body;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SandboxController extends AbstractController
{
    #[Route('/sandbox', name: 'sandbox')]
    public function indexAction(): Response
    {
        return new Response('<body>Hello World</body>');
    }

    #[Route('/sandbox/hello2', name: 'sandbox-hello2')]
    public function hello2Action(): Response
    {
        return $this->render('Sandbox/hello2.html.twig');
    }

    #[Route('/sandbox/hello3', name: 'sandbox-hello3')]
    public function hello3Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => array('A Plague tale : Innocence', 'Wow', 'Masse Effect'),
        );
        return $this->render('Sandbox/hello3.html.twig', $args);
    }
    #[Route('/sandbox/hello4', name: 'sandbox-hello4')]
    public function hello4Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => array('A Plague tale : Innocence', 'Wow', 'Masse Effect'),
        );
        return $this->render('Sandbox/hello4.html.twig', $args);
    }
}
