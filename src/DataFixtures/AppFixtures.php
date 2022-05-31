<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\MessageContact;
use App\Entity\Users;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
require_once 'vendor/autoload.php';

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $users = [];
        $faker = Faker\Factory::create();
        $faker->seed(9483);
        $admin = new Users;
        $admin
            ->setPseudo("Etchebest89")
            ->setNom("Etchebest")
            ->setPrenom("Philippe")
            ->setEmail("Philippe.Etchebest@gmail.com")
            ->setPassword("$2y$13\$NqghOo8vsJdJtp/X0kpJBOZ20yEK3iSvEUMtxUXBc/VSlM6R/seGm")
            ->setCreateTime($faker->dateTime('2014-02-25 08:37:17'))
            ->setRole('Admin');

        $manager->persist($admin);
        $manager->flush();
            
        $client = new Users;
        $client
            ->setPseudo("BobMarshall08")
            ->setNom("Marshall")
            ->setPrenom("Bob")
            ->setEmail("bob@wanadoo.com")
            ->setPassword("$2y$13\$cHR9//SpLoqhQu7VHHbnougEDApbODCLAvV0Jy7CTnMKfLiEcEQ5a")
            ->setCreateTime($faker->dateTime('2014-02-25 08:37:17'))
            ->setRole('User');

        $manager->persist($client);
        $manager->flush();

        for ($i = 0; $i < 20; $i++) {
            $user = new Users;
            $user
                ->setPseudo($faker->word())
                ->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setEmail($faker->safeEmail())
                ->setPassword($faker->password())
                ->setCreateTime($faker->dateTime('2014-02-25 08:37:17'))
                ->setRole($faker->randomElement(['Admin', 'User']));

            $manager->persist($user);
            $manager->flush();
            array_push($users, $user);
        }

        $articles = [];
        for ($i = 0; $i < 20; $i++) {
            $article = new Article;
            $article
                ->setTitre($faker->word())
                ->setContenu($faker->text(100))
                ->setImage($faker->randomElement(['imgs/aperitif-1.jpg', 'imgs/aperitif-2.jpg', 'imgs/bruschetta-b.jpg', 'imgs/bruschetta.jpg', 'imgs/burger.jpg', 'imgs/cake.jpg', 'imgs/cookies.jpg', 'imgs/cupcakes.jpg', 'imgs/gnocchis.jpg', 'imgs/pasta.jpg', 'imgs/pizza.jpg', 'imgs/rice.jpg', 'imgs/salad.jpg', 'imgs/sushis.jpg']))
                ->setCreateTime($faker->dateTime('2014-02-25 08:37:17'))
                ->setCategory($faker->randomElement(['entree', 'plat', 'dessert', 'aperitif']))
                ->setIdUser($users[$faker->numberBetween(0, count($users) - 1)]);

            $manager->persist($article);
            $manager->flush();
            array_push($articles, $article);
        }

        for ($i = 0; $i < 20; $i++) {
            $commentaire = new Commentaire;
            $commentaire
                ->setContenu($faker->text(100))
                ->setCreateTime($faker->dateTime('2014-02-25 08:37:17'))
                ->setIdUser($users[$faker->numberBetween(0, count($users) - 1)])
                ->setIdArticle($articles[$faker->numberBetween(0, count($articles) - 1)]);

            $manager->persist($commentaire);
            $manager->flush();
        }

        for ($i = 0; $i < 20; $i++) {
            $messageContact = new MessageContact;
            $messageContact
                ->setEmail($faker->safeEmail())
                ->setContenu($faker->text(100))
                ->setCreateTime($faker->dateTime('2014-02-25 08:37:17'));

            $manager->persist($messageContact);
            $manager->flush();
        }
    }
}
