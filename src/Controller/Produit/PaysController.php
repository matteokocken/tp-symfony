<?php

namespace App\Controller\Produit;

use App\Entity\Pays;
use App\Form\PaysType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pays', name: 'pays')]
class PaysController extends AbstractController
{
    #[Route('/add', name: '_add')]
    public function addAction(EntityManagerInterface $em, Request $request): Response
    {

        $pays = new Pays();

        $form = $this->createForm(PaysType::class, $pays);
        $form->add('send', SubmitType::class, ['label' => 'Ajouter un pays']);
        $form->handleRequest($request);


        // Verif du form + add to BDD
        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($pays);
            $em->flush();
            $this->addFlash('info', 'Pays ajouté avec succès');
            return $this->redirectToRoute('pays_add');
        }
        if($form->isSubmitted())
        {
            $this->addFlash('info', 'Erreur lors de la création du pays');
        }
        dump($form);
        $args = array('myform' => $form->createView());
        return $this->render('pays/index.html.twig', $args);
    }
}
