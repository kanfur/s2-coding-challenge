<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface */
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User(
            username: 'admin',
            firstname: "Checkout",
            lastname: 'Shopping',
            email: 'checkout@shopping.test',
            roles: ['ROLE_ADMIN']
        );

        $password = $this->encoder->encodePassword($user, 'admin');

        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
