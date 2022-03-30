<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/twig', name: 'sandbox_twig')]
class SandboxTwigController extends AbstractController
{
    #[Route('/', name: '_index')]
    public function indexAction(): Response
    {
        return $this->render('Sandbox/sandbox_twig/film_edit.html.twig');
    }

    #[Route('/vue1', name: '_vue1')]
    public function vue1Action(): Response
    {
        return $this->render('Sandbox/sandbox_twig/vue1.html.twig');
    }

    #[Route('/vue2', name: '_vue2')]
    public function vue2Action(): Response
    {
        return $this->render('Sandbox/sandbox_twig/vue2.html.twig');
    }

    #[Route('/vue3', name: '_vue3')]
    public function vue3Action(): Response
    {
        return $this->render('Sandbox/sandbox_twig/vue3.html.twig');
    }

    public function menuAction(): Response
    {
        $args = array(
            'items' => array('connexion/deconnexion', 'liste des vues', 'politique des cookies'),
        );
        return $this->render('Sandbox/sandbox_twig/menu.html.twig', $args);
    }

    #[Route('/vue6', name: '_vue6')]
    public function vue6Action(): Response
    {
        $tab = array (
            'mentions' => array(
                  'Info' => array(
                        'nom' => 'Informatique',
                        'parcours' => array(
                              'Informatique',
                              'Image',
                           ),
                        'responsable' => 'SJ',
                     ),
                  'PC' => array(
                        'nom' => 'Physique-Chimie',
                        'parcours' => array(
                              'Physique',
                              'Chimie minérale',
                           ),
                        'responsable' => 'GA',
                     ),
                  'Bio' => array(
                        'nom' => 'Biologie',
                        'parcours' => array(
                              'Géologie',
                              'Biologie végétale',
                              'Biologie animale',
                           ),
                        'responsable' => 'MN',
                     ),
               ),
            'ues' => array(
                  array(
                        'nom' => 'Algo 1',
                        'volume' => 54,
                     ),
                  array(
                        'nom' => 'Maths discrètes',
                        'volume' => 40,
                     ),
                  array(
                        'nom' => 'Anglais S1',
                        'volume' => 20,
                     ),
                  array(
                        'nom' => 'Anglais S2',
                        'volume' => 20,
                     ),
                  array(
                        'nom' => 'Projet',
                        'volume' => 70,
                     ),
               ),
         );
         $args = array(
             "prenom" => "Matteo",
             "mail" => "matteo@email.fr",
             "tableau" => $tab,
         );
         return $this->render('Sandbox/sandbox_twig/vue6.html.twig', $args);
    }
}