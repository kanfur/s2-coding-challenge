<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class AppFixtures extends Fixture
{
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

        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $manager->persist(new Post(
                $faker->realText(50),
                $faker->realText(2000),
                $user,
                new DateTime()
            ));
        }

        $manager->flush();
    }
}
