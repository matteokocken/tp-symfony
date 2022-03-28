<?php

namespace App\Controller\Produit;

use App\Entity\Manuel;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use MongoDB\Driver\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function listAction(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $produits = $em->getRepository('App:Produit')->findAll();

        $args = array('products' => $produits, 'id_page' => $id);

        return $this->render('produit/list_product.html.twig', $args);
    }

    #[Route('/view/{id}', 
    name: "_view",
    requirements: ["id" => "[1-9][0-9]{0,}"],
    )]
    public function viewAction(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $produit = $em->getRepository('App:Produit')->find($id);

        $args = array('produit' => $produit);

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
    public function deleteAction(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $produitRepo = $em->getRepository('App:Produit');
        $produit = $produitRepo->find($id);

        if(is_null($produit)) {
            $this->addFlash('info', 'Erreur lors de la suppression du produit');
            throw new NotFoundHttpException("film->id = " . $id . ' incorrect');
        }

        $em->remove($produit);
        $em->flush();

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

    #[Route('/generate', name: "_generate")]
    public function generateAction(ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();

        $produit1 = new Produit();
        $produit1->setDenomination("Chaise")
            ->setCode('12325454545454')
            ->setDateCreation(new \DateTime("now"))
            ->setActif(1)
            ->setDescriptif("Chaise de bureau")
        ;
        $produit2 = new Produit();
        $produit2->setDenomination("Table")
            ->setCode('4564856454564654')
            ->setDateCreation(new \DateTime("now"))
            ->setActif(1)
            ->setDescriptif("Table de salon")
        ;
        $produit3 = new Produit();
        $produit3->setDenomination("Bureau")
            ->setCode('8898522411155')
            ->setDateCreation(new \DateTime("now"))
            ->setActif(0)
            ->setDescriptif("Bureau de travail")
        ;
        $produit4 = new Produit();
        $produit4->setDenomination("Télévision")
            ->setCode('854895641285')
            ->setDateCreation(new \DateTime("now"))
            ->setActif(1)
            ->setDescriptif("Télévision 4K")
        ;

        $manuel1 = new Manuel();
        $manuel1->setUrl("/manuel/television_4k")
            ->setSommaire("Tutoriel pour installer la télévision");

        $manuel2 = new Manuel();
        $manuel2->setUrl("/manuel/chaise")
            ->setSommaire("Tutoriel pour monter la chaise ");

        $em->persist($produit1);
        $em->persist($produit2);
        $em->persist($produit3);
        $em->persist($produit4);
        $em->persist($manuel1);
        $em->persist($manuel2);
        $em->flush();

        return $this->redirectToRoute('produit_list');
    }

}
