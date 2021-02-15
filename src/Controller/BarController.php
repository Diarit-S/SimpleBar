<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BarController extends AbstractController
{
    public function __construct()
    {
    }

    /**
     * @Route("/bar", name="bar")
     */
    public function index(): Response
    {
        return $this->render('bar/index.html.twig', [
            'controller_name' => 'BarController',
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions(){
        return $this->render('mentions/index.html.twig', [
            'title' => 'Mentions',
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function home(){
        return $this->render('home/index.html.twig', [
            'title' => 'Home',
        ]);
    }

    /**
     * @Route("/beers", name="beers")
     */
    public function beers(){
        return $this->render('beers/index.html.twig', [
            'title' => 'Beers',
        ]);
    }
}
