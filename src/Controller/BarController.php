<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Country;
use App\Entity\Category;

use App\Repository\CategoryRepository;


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
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);
        $beers = $repoBeer->findLastThreeBeers();

        return $this->render('beers/index.html.twig', [
            'title' => 'Beers',
            'beers' => $beers
        ]);
    }

     /**
     * @Route("/beer/{id}", name="beer")
     */
    public function showBeer(int $id): Response {
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);
        $beer = $repoBeer->find($id);

        // $repoCountry = $this->getDoctrine()->getRepository(Country::class);
        // $beerCountry = $repoCountry->find($beer.country)
        $repoCategory = $this->getDoctrine()->getRepository(Category::class);

        $beerSpecialCategory = $repoCategory->findBeerCategorySpecial($id);
        
        dump($beer);
        dump($beerSpecialCategory);


        return $this->render('beers/beer.html.twig', [
            'title' => 'beer',
            'beer' => $beer,
            'specialCategories' => $beerSpecialCategory
        ]);
    }


    /**
    * @Route("/menu", name="menu")
    */
    public function mainMenu(string $category_id, string $routeName): Response{
        
        $repoCategory = $this->getDoctrine()->getRepository(Category::class);
        $repoCountries = $this->getDoctrine()->getRepository(Country::class);
        
        $normalCategories = $repoCategory->findCategoryByTerm('normal');
        $countries = $repoCountries->findAll();

        return $this->render('partials/menu.html.twig', [
            'routeName' => $routeName,
            'categoryId' => $category_id,
            'categories' => $normalCategories,
            'countries' => $countries
        ]);
    }

    /**
    * @Route("/category/{id}", name="category")
    */
    public function categoryBeers(int $id): Response{

        $repoCategory = $this->getDoctrine()->getRepository(Category::class);
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);

        $foundCategory = $repoCategory->find($id);
        
        dump($foundCategory);

        return $this->render('category/index.html.twig', [
            'category' => $foundCategory,
            'beers' => $repoBeer->findBeersByCategory($id),
        ]);
    }

    /**
    * @Route("/country/{id}", name="country")
    */
    public function countryBeers(int $id): Response{

        $repoCountry = $this->getDoctrine()->getRepository(Country::class);
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);

        $foundCountry = $repoCountry->find($id);
        
        dump($foundCountry);

        return $this->render('country/index.html.twig', [
            'country' => $foundCountry,
            'beers' => $repoBeer->findBeersByCountry($id),
        ]);
    }
}
