<?php

namespace App\DataFixtures;

use App\Entity\Parcours;
use App\Entity\Points;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ParcoursFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
/*




*/

        $user = new User();
        $user->setPassword("root");
        $user->setNom("root");
        $user->setPrenom("root");
        $user->setUsername("root");
        $manager->persist($user);

        $parcours = new Parcours();
        $parcours->setNomParcours("Parcours 1");
        $parcours->setDescription("Parcours 1");
        $parcours->setLongueurParcours(10.10);
        $parcours->setTypeParcours("Facile");
        $parcours->setZoom(16);
        $parcours->setLat(47.6333);
        $parcours->setLng(6.8667);

        $parcours2 = new Parcours();
        $parcours2->setNomParcours("Parcours 2");
        $parcours2->setDescription("Parcours 2");
        $parcours2->setLongueurParcours(10.10);
        $parcours2->setTypeParcours("Facile");
        $parcours2->setZoom(14);
        $parcours2->setLat(48.6333);
        $parcours2->setLng(6.8667);

        $manager->persist($parcours);
        $manager->persist($parcours2);

        $point = new Points();
        $point->setTitre("Point1");
        $point->setLat(47.6333);
        $point->setLng(6.8667);
        $point->setParcours($parcours);

        $parcours->addPoint($point);


        $point2 = new Points();
        $point2->setTitre("Point1");
        $point2->setLat(47.6333);
        $point2->setLng(6.8700);
        $point2->setParcours($parcours);

        $parcours->addPoint($point2);

        $point3 = new Points();
        $point3->setTitre("Point1");
        $point3->setLat(48.6333);
        $point3->setLng(6.8667);
        $point3->setParcours($parcours2);

        $parcours2->addPoint($point3);


        $point4 = new Points();
        $point4->setTitre("Point1");
        $point4->setLat(48.6333);
        $point4->setLng(6.8700);
        $point4->setParcours($parcours2);

        $parcours2->addPoint($point4);


        $parcours->addUser($user);

        $manager->persist($point);

        $manager->persist($point2);


        $manager->persist($point3);



        $manager->persist($point4);
        $manager->flush();

    }
}
