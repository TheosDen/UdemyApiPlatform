<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private const POSTS_COUNT = 100;
    private const COMENTS_MAX_COUNT = 10;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadBlogPosts($manager);
        $this->loadComments($manager);
    }

    public function loadBlogPosts(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');

        for ($i = 0; $i < self::POSTS_COUNT; $i++) {
            $blogPost = new BlogPost();
            $blogPost
                ->setTitle($this->faker->realText(30))
                ->setPublishedAt($this->faker->dateTime)
                ->setContent($this->faker->realText())
                ->setAuthor($user)
                ->setSlug(
                    preg_replace('/\W+/', '-', strtolower($blogPost->getTitle()))
                )
            ;

            $manager->persist($blogPost);

            $this->addReference("blog_post_$i", $blogPost);
        }

        $manager->flush();
    }

    public function loadComments(ObjectManager $manager)
    {
        $user = $this->getReference('user_admin');

        for ($i = 0; $i < self::POSTS_COUNT; $i++) {
            $commentsCount = random_int(0, self::COMENTS_MAX_COUNT);
            for ($j = 0; $j < $commentsCount; $j++) {
                $comment = new Comment();
                $comment
                    ->setAuthor($user)
                    ->setContent($this->faker->realText(100))
                    ->setPublishedAt($this->faker->dateTimeThisYear)
                    ->setBlogPost($this->getReference("blog_post_$i"))
                ;

                $manager->persist($comment);
            }
        }

        $manager->flush();
    }

    public function loadUsers(ObjectManager $manager)
    {
        $user = new User();

        $user
            ->setUsername('admin')
            ->setEmail('admin@test.gmail.com')
            ->setName('Den Dou')
            ->setPassword($this->encoder->encodePassword($user, '123456'))
            ;

        $this->addReference('user_admin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
