<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    private $usersData = [
        ['login' => 'qwe', 'pwd' => '123', 'role' => 'ROLE_USER'],
        ['login' => 'asd', 'pwd' => '111', 'role' => 'ROLE_USER'],
        ['login' => 'zxc', 'pwd' => '555555', 'role' => 'ROLE_ADMIN']
    ];

    private $types = [
        ['name' => 'news', 'type' => 'Новости'],
        ['name' => 'events', 'type' => 'Мероприятия'],
        ['name' => 'ads', 'type' => 'Объявления'],
        ['name' => 'program', 'type' => 'Программа'],
        ['name' => 'sport', 'type' => 'Спорт'],
    ];


    private $titles = [
        'Новости в Санкт-Петербурге',
        'Новости в мире',
        'Олимпиада',
        'Субботний концерт',
        'Расписание на неделю',
        'Продам автомобиль',
        'Куплю картину',
        'Фильм К звездам',
        'Встреча у костра'
    ];


    private $dates = ['now', 'tomorrow', 'yesterday'];

    private function generateUsers(ObjectManager &$manager)
    {
        $users = [];
        foreach ($this->usersData as $data) {
            $user = new User();
            $user->setLogin($data['login']);
            $user->setHash($this->passwordHasher->hashPassword($user, $data['pwd']));
            $user->setRoles([$data['role']]);
            $manager->persist($user);
            $users[] = $user;
        }
        return $users;
    }

    

    private function generateArticles(ObjectManager &$manager)
    {
        $typesCount = count($this->types) - 1;
        $users = $this->generateUsers($manager);
        $usersCount = count($users) - 1;
        $titlesCount = count($this->titles) - 1;
         for ($i = 0; $i < 30; $i++) {
             $article = new Article();
             $article->setTitle($this->titles[rand(0, $titlesCount)]);
             $article->setPublished(new \DateTime($this->dates[rand(0, 2)]));
             $article->setType($this->types[rand(0, $typesCount)]['type']);
             $article->setDescription('описание');
             $article->setUser($users[rand(0, $usersCount)]);
             $manager->persist($article);
         }
    }

    public function load(ObjectManager $manager)
    {
        $this->generateArticles($manager);
        $manager->flush();
    }
}

