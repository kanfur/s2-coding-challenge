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
            (new DateTime())->setTimestamp(1630095002)
        ));

        $manager->persist(new Post(
            'This is a very long Text',
            '
This is all you need really
This piece is written with Golang in mind, though the principles can be largely generalized to any language.
If you’re using logrus or something like Uber’s zap logging library and connecting it via hooks to a log aggregation service like Sentry or Rollbar, it’s time to re-evaluate your application architecture and responsibility boundaries.
It’s generally good software engineering practice to stick to the Single Responsibility Principle as well as Decoupling of each part of your application as practically possible. Your application should be agnostic to how errors and logs are handled.
In progressive levels of bad practice
your code contains explicit references and imports to vendor specific logging libraries
you implement a logging interface and swap out vendors via dependency injection
you log straight to syslog or through journald
you log to stdout and stderr
Why log to stdout and stderr? During development you can simply read log outputs from the terminal. During production it’s easy to redirect this to a file using the redirection operator like below
./server > server.log 2> server_errors.log
or if you’re using bash and zsh you can redirect both stdout and stderr to a single file
./server &> server.log
You can then either pull this file directly at set intervals from an external server, or use something like rsyslog or journald to forward logs to a central aggregration server with something like Graylog, Papertrail, Splunk, Sumo Logic or Logstash if you’re using the ELK stack.
Alternatively if you’re using Docker you can simply swap out logging drivers. Some of the available drivers include
json-file (docker default)
syslog
journald
gelf (graylog, logstash)
splunk
awslogs
gcplogs
Another benefit of extracting your logging concerns from your application is automatic log rotation. You don’t need to run a custom cron job or use application specific log rotation library like Lumberjack. You can specify log rotation through Docker through /etc/docker/daemon.json or at runtime with something like
docker run --log-opt max-file=5 --log-opt max-size=20m IMAGE
You can also add automatic tags and labels to your logs. You no longer have to fetch and tag your logs with your production environment or git commit hash from the application (it would be awkward to do so anyway).
As an aside — if you haven’t already, Dave Cheney writes a good piece on error logging. Using a logging library like github.com/pkg/errors, you simply create a new error where it happens and bubble it up to the caller to log. Because it contains automatic stack tracing, combined with the git commit hash, you can easily pinpoint the exact line an error occurred at without even having to specify an error message.
There’s something beautiful about simplicity. After having experimented with different logging libraries and vendor SAAS options, I’m back to using Go’s standard logging library (which defaults output to stderr). The below is really all you need for logging in your application.
log.Printf("%+v", err)',
            $user,
            (new DateTime())->setTimestamp(1630095001)
        ));


        for ($i = 1; $i <= 10; $i++) {
            $manager->persist(new Post(
                $faker->realText(50),
                $faker->realText(3000),
                $user,
                (new DateTime())->setTimestamp(rand(self::$POSTMINTIME, self::$POSTMAXTIME))
            ));
        }

        $ip = new IpBlock('127.10.10.10');

        $manager->persist($ip);

        $manager->flush();
    }
}
