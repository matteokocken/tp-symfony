<?php

namespace App\Controller\Sandbox;

use http\Message\Body;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/prefix', name: 'sandbox_prefix')]
class SandboxPrefixController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function indexAction(): Response
    {
        return new Response('<body>Hello World</body>');
    }

    #[Route('/hello2', name: '_hello2')]
    public function hello2Action(): Response
    {
        return $this->render('Sandbox/SandboxPrefix/hello2.html.twig');
    }

    #[Route('/hello3', name: '_hello3')]
    public function hello3Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => array('A Plague tale : Innocence', 'Wow', 'Masse Effect'),
        );
        return $this->render('Sandbox/SandboxPrefix/hello3.html.twig', $args);
    }
    #[Route('/hello4', name: '_hello4')]
    public function hello4Action(): Response
    {
        $args = array(
            'prenom' => 'Gilles',
            'jeux' => array('A Plague tale : Innocence', 'Wow', 'Masse Effect'),
        );
        return $this->render('Sandbox/SandboxPrefix/hello4.html.twig', $args);
    }
}
