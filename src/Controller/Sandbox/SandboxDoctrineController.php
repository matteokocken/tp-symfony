<?php

namespace App\Controller\Sandbox;

use App\Entity\Critique;
use App\Entity\Film;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sandbox/doctrine', name: 'sandbox_doctrine')]
class SandboxDoctrineController extends AbstractController
{
    #[Route('', name: '_index')]
    public function indexAction(): Response
    {
        return $this->render("Sandbox/Layout/layout4.html.twig");
    }

    #[Route('/list', name: '_list')]
    public function listAction(ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();

        $filmRepo = $em->getRepository('App:Film');

        $films = $filmRepo->findAll();

        return $this->render("Sandbox/Doctrine/List.html.twig", array('films' =>$films));
    }

    #[Route('/view/{id}', name: '_view', requirements: ['id' => '\d+'])]
    public function viewAction(int $id, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();

        $filmRepo = $em->getRepository('App:Film');
        $film = $filmRepo->find($id);

        $args = array('film' => $film);

        return $this->render("Sandbox/Doctrine/View.html.twig", $args);
    }

    #[Route('/delete/{id}', name: '_delete', requirements: ['id' => '\d+'])]
    public function deleteAction(int $id, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();

        $filmRepo = $em->getRepository('App:Film');
        $film = $filmRepo->find($id);

        if(is_null($film)) {
            $this->addFlash('info', 'Id incorrect');
            throw new NotFoundHttpException('film ' . $id . ' inexistant');
        }

        $em->remove($film);
        $em->flush();

        return $this->redirectToRoute('sandbox_doctrine_list');
    }

    #[Route('/ajouterendur', name: '_ajouterendur')]
    public function ajouterendurAction(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $film = new Film();
        $film->setNom('Le grand bleu')
            ->setAnnee(1988)
            ->setPrix(9.99)
            ->setQuantite(88);
        dump($film);

        $em->persist($film);
        $em->flush();
        dump($film);

        return $this->redirectToRoute('sandbox_doctrine_view', ['id' => $film->getId()]);
    }
    #[Route('/modifierendur', name: '_modifierendur')]
    public function modifierendurAction(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $filmRepository = $em->getRepository('App:Film');

        $film = $filmRepository->find(2);

        $film->setNom("aaa");

        $em->flush();

        return $this->redirectToRoute('sandbox_doctrine_view', ['id' => $film->getId()]);
    }

    #[Route('/effacerendur', name: '_effacerendur')]
    public function effacerendurAction(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $filmRepo = $em->getRepository('App:Film');

        $film = $filmRepo->find(2);

        $em->remove($film);
        $em->flush();

        return $this->redirectToRoute('sandbox_doctrine_list');
    }
    #[Route('/critique/ajouterendur', name: '_critique_ajouterendur')]
    public function critiqueAjouterendurAction(ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();

        $film = new Film();
        $film->setNom('Le grand bleu')
            ->setAnnee(1988)
            ->setEnstock(true) // inutile : valeur par d´efaut
            ->setPrix(9.99)
            ->setQuantite(95);
        $em->persist($film);

        $critique1 = new Critique();
        $critique1->setNote(5)
             ->setAvis("sa a changer tout ma vi")
             ->setFilm($film);
        $em->persist($critique1);

        $critique2 = new Critique();
        $critique2->setNote(0)
             ->setAvis("Le grand vide plut^ot !")
             ->setFilm($film);
        $em->persist($critique2);

        $em->flush();

        dump($film);

        return $this->redirectToRoute('sandbox_doctrine_critique_view1', ['id' => $film->getId()]);
    }

    #[Route('/critique/view1/{id}',
    name: '_critique_view1',
    requirements: ['id' => '[1-9]\d*']
    )]
    public function critiqueView1Action(int $id, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $filmRepo = $em->getRepository('App:Film');
        $critiqueRepo = $em->getRepository('App:Critique');

        $film = $filmRepo->find($id);
        if(is_null($film))
            throw new NotFoundHttpException('Le film ' . $id . ' n\'existe pas');
        $critiques = $critiqueRepo->findBy(array('film' => $film));
        $args = array(
            'film' => $film,
            'critiques' => $critiques
        );

        return $this->render('Sandbox/Doctrine/critiqueView1.html.twig', $args);
    }

    #[Route('/critique/view2/{id}',
    name: '_critique_view2',
    requirements: ['id' => '[1-9]\d*']
    )]
    public function critiqueView2Action(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $filmRepository = $em->getRepository('App:Film');
        $critiqueRepository = $em->getRepository('App:Critique');
        $film = $filmRepository->find($id);
        if (is_null($film))
            throw new NotFoundHttpException('Le film ' . $id . ' n\'existe pas');
        $args = array(
            'film' => $film,
        );
        return $this->render('Sandbox/Doctrine/critiqueView2.html.twig', $args);
    }


}
