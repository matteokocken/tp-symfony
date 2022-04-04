<?php

namespace App\Controller\Sandbox;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/Security', name: 'sandbox_security')]
class SandboxSecurityController extends AbstractController
{
    #[Route('/addusers', name: '_addusers')]
    public function addUserAction(ManagerRegistry $doctrine, UserPasswordHasherInterface $passwordHasher): Response
    {
        $em = $doctrine->getManager();

        $user = new User();
        $user->setLogin('angelo')
            ->setName('Angelo')
            ->setRoles(['ROLE_GESTION']);

        $hashedPassword = $passwordHasher->hashPassword($user, 'qwerty');
        $user->setPassword($hashedPassword);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute("accueil");
    }
}
