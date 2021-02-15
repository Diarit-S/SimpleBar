<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\Category;


use App\Entity\Country;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        
        $categoriesNormals = ['blonde', 'brune', 'blanche'];
        
        $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'] ;

        foreach ($categoriesNormals as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category);
        }

        foreach ($categoriesSpecials as $name) {
            $category = new Category();
            $category->setName($name);
            $category->setTerm('special');
            $manager->persist($category);
        }

        $countries = ['Belgium', 'France', 'England', 'Germany'];

        foreach ($countries as $name) {
            $country = new Country();
            $country->setName($name);
            $manager->persist($country);
        }

        $manager->flush();

        $beernames = [
            'Tomahawk',
            'Sniper',
            'Desert Eagle',
            'Magnum',
            'Goudale',
            'Heinekein',
            'M4A1',
            'M13',
            'ODEN',
            'FAL',
            'SCAR',
            'GRAU',
            'AX50',
            'DRAGUNOV',
            'HDR',
            'MP5',
            'UMP45',
            'AUG',
            'P90',
            'UZI'
        ];

        $repoCountry = $manager->getRepository(Country::class);
        $repoCategory = $manager->getRepository(Category::class);


        foreach($beernames as $name) {
            $beer =  new Beer();
            if (rand(1, 2) === 1) {
                $countryname = $countries[rand(0, count($countries) - 1)];
                $country = $repoCountry->findOneBy([
                    'name' => $countryname
                ]);
                $beer->setCountry($country);
            }

            $beer->setName($name);
            $beer->setDescription($this->lorem(random_int(5, 20)));

            $date = new \DateTime('2000-01-01');
            $day = random_int(10, 1000);
            $date->add(new \DateInterval("P" . $day . "D"));

            $beer->setPublishedAt($date);
            $beer->setDegree(rand(4, 9));

            $beer->setPrice(rand(4, 20));

            $normalCategoryName = $categoriesNormals[rand(0, count($categoriesNormals) - 1)];

            $randomSpecialCategoriesNumber = random_int(0, count($categoriesSpecials) - 1);

            $specialCategoryNames = [];

            for ($i=0; $i <= $randomSpecialCategoriesNumber; $i++) { 
                $randomIndex = random_int(0, count($categoriesSpecials) - 1);
                if (!in_array($categoriesSpecials[$randomIndex], $specialCategoryNames)) {
                    array_push($specialCategoryNames, $categoriesSpecials[$randomIndex]);
                }
            }

            $normalcategory = $repoCategory->findOneBy([
                'name' => $normalCategoryName
            ]);
            $specialCategories = $repoCategory->findBy(['name' => $specialCategoryNames]);

            $allCategories = [$normalcategory];

            foreach ($specialCategories as $cat) {
                array_push($allCategories, $cat);
            }

            $beer->setCountry($country);

            foreach($allCategories as $category) {
                $beer->addCategory($category);
            }

            $manager->persist($beer);



        }

        $manager->flush();
    }

    // private const ARTICLES = [
    //     [
    //         'name' => 'Blonde',
    //         'description' => 'La bonne bière blonde',
    //         'country' => '/images/Articles/Elon-Musk/Musk-Cover.jpg',
    //         'degree' => '2 min',
    //         'price' => '2 min'
    //     ]
    // ]


    // $beers = [
    //     [
    //         'name' => 'Blonde',
    //         'description' => 'La bonne bière blonde',
    //         'degree' => 7.5,
    //         'price' => 7.0
    //     ],
    //     [
    //         'name' => 'Brune',
    //         'description' => 'La bonne bière brune',
    //         'degree' => 7.8,
    //         'price' => 6.0
    //     ] 
    // ]

    // foreach ($beers as $beer) {
    //     $newBeer = new Beer();
    //     $newBeer->setName($beer["name"]);
    //     $newBeer->setDescription($beer["description"]);
    //     $newBeer->setCategory($beer["name"]);
    //     $newBeer->setName($beer["name"]);
    //     $manager->persist($newBeer);
    // }

    private function lorem($nb)
    {

        $wordList = [
            'alias', 'consequatur', 'aut', 'perferendis', 'sit', 'voluptatem',
            'accusantium', 'doloremque', 'aperiam', 'eaque', 'ipsa', 'quae', 'ab',
            'illo', 'inventore', 'veritatis', 'et', 'quasi', 'architecto',
            'beatae', 'vitae', 'dicta', 'sunt', 'explicabo', 'aspernatur', 'aut',
            'odit', 'aut', 'fugit', 'sed', 'quia', 'consequuntur', 'magni',
            'dolores', 'eos', 'qui', 'ratione', 'voluptatem', 'sequi', 'nesciunt',
            'neque', 'dolorem', 'ipsum', 'quia', 'dolor', 'sit', 'amet',
            'consectetur', 'adipisci', 'velit', 'sed', 'quia', 'non', 'numquam',
            'eius', 'modi', 'tempora', 'incidunt', 'ut', 'labore', 'et', 'dolore',
            'magnam', 'aliquam', 'quaerat', 'voluptatem', 'ut', 'enim', 'ad',
            'minima', 'veniam', 'quis', 'nostrum', 'exercitationem', 'ullam',
            'corporis', 'nemo', 'enim', 'ipsam', 'voluptatem', 'quia', 'voluptas',
            'sit', 'suscipit', 'laboriosam', 'nisi', 'ut', 'aliquid', 'ex', 'ea',
            'commodi', 'consequatur', 'quis', 'autem', 'vel', 'eum', 'iure',
            'reprehenderit', 'qui', 'in', 'ea', 'voluptate', 'velit', 'esse',
            'quam', 'nihil', 'molestiae', 'et', 'iusto', 'odio', 'dignissimos',
            'ducimus', 'qui', 'blanditiis', 'praesentium', 'laudantium', 'totam',
            'rem', 'voluptatum', 'deleniti', 'atque', 'corrupti', 'quos',
            'dolores', 'et', 'quas', 'molestias', 'excepturi', 'sint',
            'occaecati', 'cupiditate', 'non', 'provident', 'sed', 'ut',
            'perspiciatis', 'unde', 'omnis', 'iste', 'natus', 'error',
            'similique', 'sunt', 'in', 'culpa', 'qui', 'officia', 'deserunt',
            'mollitia', 'animi', 'id', 'est', 'laborum', 'et', 'dolorum', 'fuga',
            'et', 'harum', 'quidem', 'rerum', 'facilis', 'est', 'et', 'expedita',
            'distinctio', 'nam', 'libero', 'tempore', 'cum', 'soluta', 'nobis',
            'est', 'eligendi', 'optio', 'cumque', 'nihil', 'impedit', 'quo',
            'porro', 'quisquam', 'est', 'qui', 'minus', 'id', 'quod', 'maxime',
            'placeat', 'facere', 'possimus', 'omnis', 'voluptas', 'assumenda',
            'est', 'omnis', 'dolor', 'repellendus', 'temporibus', 'autem',
            'quibusdam', 'et', 'aut', 'consequatur', 'vel', 'illum', 'qui',
            'dolorem', 'eum', 'fugiat', 'quo', 'voluptas', 'nulla', 'pariatur',
            'at', 'vero', 'eos', 'et', 'accusamus', 'officiis', 'debitis', 'aut',
            'rerum', 'necessitatibus', 'saepe', 'eveniet', 'ut', 'et',
            'voluptates', 'repudiandae', 'sint', 'et', 'molestiae', 'non',
            'recusandae', 'itaque', 'earum', 'rerum', 'hic', 'tenetur', 'a',
            'sapiente', 'delectus', 'ut', 'aut', 'reiciendis', 'voluptatibus',
            'maiores', 'doloribus', 'asperiores', 'repellat'
        ];

        $sentences = [];
        shuffle($wordList);

        for ($i = 0; $i < $nb; $i++) {
            $sentences[] = $wordList[$i];
        }

        return implode(' ', $sentences);
    }
    
}
