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
    name: "_id_fourchette",
    requirements: ['id' => "[1-9][0-9]{0,}", 'valinf' => '\d+', 'valsup' => '\d+'],
    defaults: ['valinf' => 0, 'valsup' => -1]
    )]
    public function fourchetteAction(int $id): Response
    {
        $liste = array(array("product_name" => "Nom Produit", "prix_unit" => 45, "quantity" => 10),
                       array("product_name" => "Nom Produit 2", "prix_unit" => 25, "quantity" => 45));
        $args = array("valeur_totale" => 48400, "liste" => $liste);
        return $this->render('produit/magasin/valeurStock.html.twig', $args);
    }

}
