<?php
namespace Ens\JobeetBundle\DataFixtures\ORM;
 
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ens\JobeetBundle\Entity\Category;
 
class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
  /**
   * settings category
   * (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\FixtureInterface::load()
   */
  public function load(ObjectManager $em)
  {
    $design = new Category();
    $design->setName('Design');
 
    $programming = new Category();
    $programming->setName('Programming');
 
    $manager = new Category();
    $manager->setName('Manager');
 
    $administrator = new Category();
    $administrator->setName('Administrator');

    $timelord = new Category();
    $timelord->setName('Time Lord');
 
    $em->persist($design);
    $em->persist($programming);
    $em->persist($manager);
    $em->persist($administrator);
    $em->persist($timelord);
 
    $em->flush();
 
    $this->addReference('category-design', $design);
    $this->addReference('category-programming', $programming);
    $this->addReference('category-manager', $manager);
    $this->addReference('category-administrator', $administrator);
    $this->addReference('category-timelord', $timelord);
  }
 
  /**
   * Oders the fixtures load
   * (non-PHPdoc)
   * @see \Doctrine\Common\DataFixtures\OrderedFixtureInterface::getOrder()
   */
  public function getOrder()
  {
    return 1; 
  }
}