<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
            $User = new User();
            $User->setEmail("toto@gmail.com");

            
            $User->setPlainPassword('toto');
            
            $User->setFirstName("toto");
            $User->setLastName("toto");
            $User->setPhoneNumber(1111111111);
            $User->setDateCreation(new \DateTime('now'));
            $manager->persist($User);
        

        $manager->flush();
    }
}
