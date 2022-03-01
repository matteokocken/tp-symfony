<?php

namespace App\Controller\Produit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/magasin', name: 'magasin')]

class MagasinController extends AbstractController
{
    #[Route('/valeur-stock/{id}', 
    name: '_valeur-stock',
    requirements: ['id' => "[1-9][0-9]{0,}"]
    )]
    public function indexAction(int $id): Response
    {
        $args = array("valeur_totale" => 48400);
        return $this->render('produit/magasin/valeurStock.html.twig', $args);
    }

    #[Route('/stock/{id}/{valinf}/{valsup}',
    name: "_id_fourchette")]
    public function fourchetteAction(int $id): Response
    {
        $args = array("valeur_totale" => 48400);
        return $this->render('produit/magasin/valeurStock.html.twig', $args);
    }

}
