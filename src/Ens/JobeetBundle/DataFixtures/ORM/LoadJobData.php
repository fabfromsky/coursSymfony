<?php
namespace Ens\JobeetBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ens\JobeetBundle\Entity\Job;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{
  
  /**
   * create job offers
   *
   */
  public function load(ObjectManager $em) {
    for($i = 100; $i <= 130; $i++) {
        $job = new Job();
        $job->setCategory($em->merge($this->getReference('category-programming')));
        $job->setType('full-time');
        $job->setCompany('Company '.$i);
        $job->setPosition('Seigneur du Temps');
        $job->setLocation('Gallifrey, constellation de Kasterborous');
        $job->setDescription('omelette du fromage');
        $job->setHowToApply('Send your resume to theDoctor@gmail.gal');
        $job->setIsPublic(true);
        $job->SetIsActivated(true);
        $job->setToken('job_'.$i);
        $job->setEmail('job@example.com');

        $em->persist($job);
    }
    $em->flush();
  }
  
  public function getOrder() {
    return 2;
    
    // the order in which fixtures will be loaded
    
    
  }
}
