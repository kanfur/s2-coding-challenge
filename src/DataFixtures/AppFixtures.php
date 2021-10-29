<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\IpBlock;
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
    private static int $POSTMINTIME = 1630000000;
    private static int $POSTMAXTIME = 1630095000;


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

        $manager->persist(new Post(
            'This is what a short article should look like!',
            'A short article should contain everything that is necessary to understand the topic.
Like in this short article.

It would be great if more people would just write short texts.',
            $user,
            (new DateTime())->setTimestamp(1630095001)
        ));

        for ($i = 1; $i <= 10; $i++) {
            $manager->persist(new Post(
                $faker->realText(50),
                $faker->realText(2000),
                $user,
                (new DateTime())->setTimestamp(rand(self::$POSTMINTIME, self::$POSTMAXTIME))
            ));
        }

        $ip = new IpBlock('127.10.10.10');

        $manager->persist($ip);

        $manager->flush();
    }
}
