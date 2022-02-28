<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
}
