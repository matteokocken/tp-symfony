<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[Route('/sandbox/route', name: 'sandbox_route')]
class SandboxRouteController extends AbstractController
{
    #[Route('/with-default/{age}', 
    name: "_with_default", 
    defaults: ["age" => 25],
    requirements: ["age" => "\d"]
    )]
    public function withId(int $age): Response
    {
        return new Response('
        <body>
            SandboxRoute::withVariable : id '
            . $age . 
        '</body>
        ');
    }

    #[Route('/test1/{year}/{month}/{filename}.{ext}',
    name: "_test1",
    )]
    public function test1 ($year, $month, $filename, $ext): Response
    {
        $args = array(
            'title' => 'Test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/SandboxRoute/test1234.html.twig', $args);
    }

    #[Route('/test2/{year}/{month}/{filename}.{ext}',
    name: "_test2",
    requirements: ["year" => "[1-9][0-9]{3}", "month" => "0?[1-9]|(1[0-2])", "filename" => "[A-Za-z]+", "ext" => "jpg|jpeg|png|ppm"]
    )]
    public function test2 ($year, $month, $filename, $ext): Response
    {
        $args = array(
            'title' => 'Test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/SandboxRoute/test1234.html.twig', $args);
    }

    #[Route('/test3/{year}/{month}/{filename}.{ext}',
    name: "_test3",
    requirements: ["year" => "[1-9][0-9]{3}", "month" => "0?[1-9]|(1[0-2])", "filename" => "[A-Za-z-]+", "ext" => "jpg|jpeg|png|ppm"],
    defaults: ["ext" => "gif"]
    )]
    public function test3 ($year, $month, $filename, $ext): Response
    {
        $args = array(
            'title' => 'Test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/SandboxRoute/test1234.html.twig', $args);
    }

    
    #[Route('/test4/{year}/{month}/{filename}.{ext}',
    name: "_test4",
    requirements: ["year" => "[1-9][0-9]{3}", "month" => "0?[1-9]|(1[0-2])", "filename" => "[A-Za-z-]+", "ext" => "jpg|jpeg|png|ppm"],
    defaults: ["ext" => "gif", "month" => 1]
    )]
    public function test4 ($year, $month, $filename, $ext): Response
    {
        $args = array(
            'title' => 'Test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );
        return $this->render('Sandbox/SandboxRoute/test1234.html.twig', $args);
    }
    
    #[Route('/test4/{year}',
    name: "_test4bis",
    requirements: ["year" => "[1-9][0-9]{3}"],
    )]
    public function test4bis ($year): Response
    {
        $args = array(
            'title' => 'Test2',
            'year' => $year,
        );
        return $this->render('Sandbox/SandboxRoute/test1234.html.twig', $args);
    }

    #[Route('/permis/{age}', 
    name: "_permis", 
    requirements: ["age" => "\d+"],
    )]
    public function permisAction(int $age): Response
    {
        if($age < 18)
            throw new NotFoundHttpException("Vous n'êtes pas majeur");
        return new Response('<body>SandboxRoute::permis : age = ' . $age . '(&gt;=18)</body>');
    }
    #[Route('/redirect1', name: "_redirect1")]
    public function redirect1Action(): Response
    {
        return $this->redirectToRoute('sandbox_prefix_hello4');
    }

    #[Route('/redirect2', name: "_redirect2")]
    public function redirect2Action(): Response
    {
        $args = array(
            'year' => "2020",
            'month' => "09",
            'filename' => "file",
            'ext' => "png",
        );
        return $this->redirectToRoute('sandbox_route_test3', $args);
    }
    #[Route('/redirect3', name: "_redirect3")]
    public function redirect3Action(): Response
    {
        dump('bonjour');
        return $this->redirectToRoute('sandbox_prefix_hello4');
    }

}
