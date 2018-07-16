<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    private $container;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, ContainerInterface $container)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadPosts($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        $users = [
            [
                'Emiliano',
                'Abarca',
                $this->container->getParameter('app.admin.username'),
                $this->container->getParameter('app.admin.password'),
                'abarcaemiliano@hotmail.com',
                [
                    'ROLE_ADMIN'
                ]
            ],
            [
                'Test',
                'Test',
                $this->container->getParameter('app.test.username'),
                $this->container->getParameter('app.test.password'),
                'test@localhost.mediaonks-demo.com',
                [
                    'ROLE_USER'
                ]
            ],
        ];

        foreach ($users as [$firstName, $lastName, $username, $password, $email, $roles]) {
            $user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setUsername($username);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $password));
            $user->setEmail($email);
            $user->setRoles($roles);
            $user->setActive(true);

            $manager->persist($user);
            $this->addReference($username, $user);
        }

        $manager->flush();
    }

    private function loadPosts(ObjectManager $entityManager)
    {
        $post = new Post();

        $post->setTitle('Docker - Symfony4 - Sqlite3');
        $post->setSlug($post->getTitle());
        $post->setBody('At MediaMonks we work with Symfony Framework and follow PSR as much as possible. We would like you to create a small test so we have an general idea of your skillset.');
        $post->setUser($this->getReference($this->container->getParameter('app.admin.username')));

        $tag = new Tag();
        $tag->setName('#docker');
        $tag->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $entityManager->persist($tag);
        $post->addTag($tag);

        $tag = new Tag();
        $tag->setName('#symfony4');
        $tag->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $entityManager->persist($tag);
        $post->addTag($tag);

        $tag = new Tag();
        $tag->setName('#sqlite3');
        $tag->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $entityManager->persist($tag);
        $post->addTag($tag);

        $comment = new Comment();
        $comment->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $comment->setContent('This is a test comment for Mediamonks post.');
        $post->addComment($comment);

        $comment = new Comment();
        $comment->setUser($this->getReference($this->container->getParameter('app.test.username')));
        $comment->setContent('This is a test2 comment for Mediamonks post.');
        $post->addComment($comment);

        $entityManager->persist($post);

        $post = new Post();

        $post->setTitle('API - Mediamonks - JS');
        $post->setSlug($post->getTitle());
        $post->setBody('This is another post about techs we use at Mediamonks.');
        $post->setUser($this->getReference($this->container->getParameter('app.test.username')));

        $tag = new Tag();
        $tag->setName('#API');
        $tag->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $entityManager->persist($tag);
        $post->addTag($tag);

        $tag = new Tag();
        $tag->setName('#Mediamonks');
        $tag->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $entityManager->persist($tag);
        $post->addTag($tag);

        $tag = new Tag();
        $tag->setName('#JS');
        $tag->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $entityManager->persist($tag);
        $post->addTag($tag);

        $comment = new Comment();
        $comment->setUser($this->getReference($this->container->getParameter('app.admin.username')));
        $comment->setContent('This is another comment for Mediamonks post.');
        $post->addComment($comment);

        $entityManager->persist($post);

        $entityManager->flush();
    }
}
