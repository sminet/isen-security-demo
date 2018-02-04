<?php
namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadArticle extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle('Lorem ipsum dolor sit amet');
        $article->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus id sagittis lorem, id rhoncus nisi. Quisque non enim at risus egestas scelerisque a quis nunc. Integer tristique velit vitae urna euismod, sit amet varius libero venenatis. Integer tempus rutrum leo a consectetur. Nulla nec ante sit amet diam bibendum placerat eget et diam. Mauris eget malesuada justo, nec consectetur nulla. Morbi eget nunc a mi mollis lacinia. In nec commodo nunc.');
        $article->setDate(new \DateTime('2018-01-12'));
        $manager->persist($article);
        
        $article = new Article();
        $article->setTitle('Curabitur ac justo non lectus pharetra cursus');
        $article->setContent('Curabitur ac justo non lectus pharetra cursus. Ut ac diam egestas, egestas justo quis, ornare velit. Nulla sed justo ut ex efficitur fermentum. In risus magna, suscipit quis dolor a, fermentum malesuada nulla. Quisque rutrum tempus augue et pulvinar. Integer a velit dui. Aenean facilisis elementum massa sit amet finibus. Vivamus sit amet gravida tellus. Aenean sit amet urna libero. Sed gravida, lorem at pretium egestas, justo justo sodales erat, nec consequat lacus nunc eget turpis. Duis tempor mi sed aliquam maximus. Phasellus eget feugiat magna.');
        $article->setDate(new \DateTime('2018-01-18'));
        $manager->persist($article);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}