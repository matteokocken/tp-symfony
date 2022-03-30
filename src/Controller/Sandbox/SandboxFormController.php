<?php

namespace App\Controller\Sandbox;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/form', name: 'SandboxForm')]
class SandboxFormController extends AbstractController
{
    #[Route('/film/edit/{id}', name: '_film_edit', requirements: ['id' => '[0-9]\d*'])]
    public function filmEditAction(int $id, EntityManagerInterface $em): Response
    {
        $filmRepo = $em->getRepository('App:Film');
        $film = $filmRepo->find($id);

        if(is_null($film))
            throw new NotFoundHttpException('Film inexistant');

        $form = $this->createForm(FilmType::class, $film);
        $form->add('send', SubmitType::class, ['label' => 'Edit Film']);

        $args = array('myform' => $form->createView());

        return $this->render('Sandbox/SandboxForm/film_edit.html.twig', $args);
    }

    #[Route('/film/edit2/{id}', name: '_film_edit2', requirements: ['id' => '[0-9]\d*'])]
    public function filmEdit2Action(int $id, EntityManagerInterface $em, Request $request): Response
    {
        $filmRepo = $em->getRepository('App:Film');
        $film = $filmRepo->find($id);

        if(is_null($film))
            throw new NotFoundHttpException('Film inexistant');

        $form = $this->createForm(FilmType::class, $film);
        $form->add('send', SubmitType::class, ['label' => 'Edit Film']);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('info', "Edition du film réussi");
            return $this->redirectToRoute('sandbox_doctrine_critique_view2', ['id' => $film->getId()]);
        }

        if($form->isSubmitted()) {
            $this->addFlash('info', "Edition incorrecte");
        }

        $args = array('myform' => $form->createView());
        return $this->render('Sandbox/SandboxForm/film_edit.html.twig', $args);
    }

    #[Route('/film/add/', name: '_film_add')]
    public function filmAddAction(EntityManagerInterface $em, Request $request)
    {

        $form = $this->createForm(Film::class);

        $args = array('myform' => $form->createView());

        return $this->render('Sandbox/SandboxForm/film_add.html.twig', $args);

    }

}
