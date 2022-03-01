<?php

namespace App\Controller\Produit;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name: "produit")]
class ProduitController extends AbstractController
{
    #[Route('/', 
    name: '_index',
    )]
    public function indexAction(): Response
    {
        $args = array(
            "id" => 1,
        );
        return $this->redirectToRoute('produit_list', $args);
    }

    #[Route('/list/{id}', 
    name: '_list',
    requirements: ["id" => "\d+"],
    defaults: ["id" => "0"],
    )]
    public function listAction($id): Response
    {
        $args = 
            array(
            "id_page" => $id,
            "products" => array([
                "id" => 15,
                "denomination" => "Produit nom",
                "code" => "1234",
                "date_creation" => "12/01/2022",
                "actif" => "1",
                "descriptif" => "Description du produit",
                "id_manuel" => 1541,
            ],
            [
                "id" => 457,
                "denomination" => "Produit nom 2",
                "code" => "5745",
                "date_creation" => "20/12/2021",
                "actif" => "1",
                "descriptif" => "Description du produit",
                "id_manuel" => 1541,
            ],
            [
                "id" => 35,
                "denomination" => "Produit nom 3",
                "code" => "575",
                "date_creation" => "07/11/2022",
                "actif" => "0",
                "descriptif" => "Description du produit",
                "id_manuel" => 1541,
            ])
            );

        return $this->render('produit/list_product.html.twig', $args);
    }

    #[Route('/view/{id}', 
    name: "_view",
    requirements: ["id" => "[1-9][0-9]{0,}"],
    )]
    public function viewAction(int $id): Response
    {
        $args = [
            "id" => 35,
            "denomination" => "Produit nom 3",
            "code" => "575",
            "date_creation" => "07/11/2022",
            "actif" => "0",
            "descriptif" => "Description du produit",
            "id_manuel" => 1541,
        ];

        return $this->render('produit/view_product.html.twig', $args);
    }

    #[Route('/add', name: "_add")]
    public function addAction(): Response
    {
        $this->addFlash('info', 'Produit ajouté avec succès');
        $args = array("id" => 3);
        return $this->redirectToRoute('produit_view', $args);
    }

    #[Route('/edit/{id}', name: "_edit",
    requirements: ["id" => "[1-9][0-9]{0,}"]
    )]
    public function editAction(int $id): Response
    {
        $this->addFlash('info', 'Produit modifié avec succès');
        $args = array("id" => $id);
        return $this->redirectToRoute('produit_view', $args);
    }

    #[Route('/delete/{id}', name: "_delete",
    requirements: ["id" => "[1-9][0-9]{0,}"]
    )]
    public function deleteAction(int $id): Response
    {
        $this->addFlash('info', 'Produit supprimé avec succès');
        return $this->redirectToRoute('produit_list');
    }

    #[Route('/{id_product}/{id_country}/add', name: "_produit-pays")]
    public function produitPaysAction(int $id_product, int $id_country): Response
    {
        $this->addFlash('info', 'Produit-Pays ajouté avec succès');
        $args = array("id" => 3);
        return $this->redirectToRoute('produit_view', $args);
    }
    #[Route('/{id_product}/{id_shop}/add', name: "_produit-magasin")]
    public function produitMagasinAction(int $id_product, int $id_country): Response
    {
        $this->addFlash('info', 'Produit-Magasin ajouté avec succès');
        $args = array("id" => 3);
        return $this->redirectToRoute('produit_view', $args);
    }
}
