<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


#[Route('/sandbox/injection', name: "sandbox_injection")]
class SandboxInjectionController extends AbstractController
{
    #[Route('/un', name: '_un')]
    public function unAction(Request $request): Response
    {
        dump($request->query->get('toto'));
        dump($request->query->all());
        return new Response('<body>SandboxInjection::un</body>');
    }

    #[Route('/deux', name: '_deux')]
    public function deuxAction(Session $session): Response
    {
        dump($session->all());
        dump($_SESSION);
        return new Response('<body>SandboxInjection::un</body>');
    }
    #[Route('/create-flash', name: '_create_flash')]
    public function createFlashAction(Session $session): Response
    {
        $session->getFlashBag()->add('info', 'L\'enregistrement a été supprimé');
        $this->addFlash('info', 'et definitivement');
        return $this->redirectToRoute('sandbox_injection_display_flash');
    }
    #[Route('/display-flash', name: '_display_flash')]
    public function displayFlashAction(): Response
    {
        $this->addFlash('error', "il y a une error");
        return $this->render('Sandbox/SandboxInjection/displayFlash.html.twig');
    }

}
