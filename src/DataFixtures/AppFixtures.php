<?php

namespace App\DataFixtures;

use App\Entity\Products\ProductComponents\CupSize;
use App\Entity\Products\ProductComponents\Milk;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //USER FIXTURE
        $user = new User();
        $user->setEmail('worker@job.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword($user, '123456'));
        $manager->persist($user);

        //FIXTURE FOR COFFEE LOGIC
        $milk = new Milk();
        $milk->setName('Standard milk');
        $manager->persist($milk);
        $milk = new Milk();
        $milk->setName('Soy milk');
        $manager->persist($milk);
        $milk = new Milk();
        $milk->setName('Rice Milk');
        $manager->persist($milk);
        $milk = new Milk();
        $milk->setName('Other');
        $manager->persist($milk);
        //MORE
        $cupSize = new CupSize();
        $cupSize->setSize('S');
        $manager->persist($cupSize);
        $cupSize = new CupSize();
        $cupSize->setSize('M');
        $manager->persist($cupSize);
        $cupSize = new CupSize();
        $cupSize->setSize('L');
        $manager->persist($cupSize);
        $cupSize = new CupSize();
        $cupSize->setSize('XL');
        $manager->persist($cupSize);

        $manager->flush();
    }
}
