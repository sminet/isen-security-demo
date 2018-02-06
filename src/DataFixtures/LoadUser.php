<?php
namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('admin');
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('denis.fresnel');
        $user->setPassword('azerty');
        $user->setFirstname('Denis');
        $user->setName('Fresnel');
        $manager->persist($user);
        
        $user = new User();
        $user->setUsername('florian.auger');
        $user->setPassword('ytreza');
        $user->setFirstname('Florian');
        $user->setName('Auger');
        $manager->persist($user);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}