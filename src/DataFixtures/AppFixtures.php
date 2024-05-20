<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Livres;

use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {  $faker = Factory::create('fr_FR');
      for($j=1;$j<3;$j++){
        #replire la table catégorie 

        $cat=new Categorie();
        $libelle=$faker->name();
        //php bin /console make:form
        $cat->setLibelle($libelle)
        ->setSlaq(strtolower(preg_replace('/[^a-zA-Z0-9]/','-',$libelle)))
        ->setDescription($faker->sentence);
        $manager->persist($cat);
          for ($i=1; $i <random_int(10,15); $i++) { 
        $livre= new Livres();
        $titre=$faker->name();
        $livre->setAuteur($faker->userName());
        $livre->setDateEdition($faker->dateTime());
        $livre->setTitre($faker->name());
        $livre->setResume($faker->sentence(20));
        $livre->setSlug(strtolower(preg_replace('/[^a-zA-Z0-9]/','-',$titre)));//^ne contien pas du 
        $livre->setPrix($faker->numberBetween(10,300));
        $livre->setQte($faker->numberBetween(0,1000));
        $livre->setEditeur($faker->company());
        $livre->setISBN($faker->isbn13());
        $livre->setImage($faker->imageUrl());
        $livre->setCategorie($cat);


        $manager->persist($livre);
       }
       $manager->flush();
    }}
}
