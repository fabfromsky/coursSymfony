<?php
namespace Ens\JobeetBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ens\JobeetBundle\Utils\Jobeet as Jobeet;

/**
 * Category
 */
class Category
{
  
  /**
   * @var integer
   */
  private $id;
  
  /**
   * @var string
   */
  private $name;
  
  /**
   * @var \Doctrine\Common\Collections\Collection
   */
  private $jobs;
  
  /**
   * @var \Doctrine\Common\Collections\Collection
   */
  private $category_affiliates;
  
  /**
   * @var \Doctrine\Common\Collections\Collection
   */
  private $active_jobs;
  
  /**
   * Constructor
   */
  public function __construct() {
    $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    $this->category_affiliates = new \Doctrine\Common\Collections\ArrayCollection();
  }
  
  /**
   * Get id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }
  
  /**
   * Set name
   *
   * @param string $name
   * @return Category
   */
  public function setName($name) {
    $this->name = $name;
    
    return $this;
  }
  
  /**
   * Get name
   *
   * @return string
   */
  public function getName() {
    return $this->name;
  }
  
  /**
   * Add jobs
   *
   * @param \Ens\JobeetBundle\Entity\Job $jobs
   * @return Category
   */
  public function addJob(\Ens\JobeetBundle\Entity\Job $jobs) {
    $this->jobs[] = $jobs;
    
    return $this;
  }
  
  /**
   * Remove jobs
   *
   * @param \Ens\JobeetBundle\Entity\Job $jobs
   */
  public function removeJob(\Ens\JobeetBundle\Entity\Job $jobs) {
    $this->jobs->removeElement($jobs);
  }
  
  /**
   * Get jobs
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getJobs() {
    return $this->jobs;
  }
  
  /**
   * Add category_affiliates
   *
   * @param \Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliates
   * @return Category
   */
  public function addCategoryAffiliate(\Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliates) {
    $this->category_affiliates[] = $categoryAffiliates;
    
    return $this;
  }
  
  /**
   * Remove category_affiliates
   *
   * @param \Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliates
   */
  public function removeCategoryAffiliate(\Ens\JobeetBundle\Entity\CategoryAffiliate $categoryAffiliates) {
    $this->category_affiliates->removeElement($categoryAffiliates);
  }
  
  /**
   * Get category_affiliates
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getCategoryAffiliates() {
    return $this->category_affiliates;
  }
  
  /**
   * __toString
   * @return Name if strings, else return E_RECOVERABLE_ERROR
   */
  public function __toString() {
    return $this->getName();
  }
  
  /**
   * setter active jobs
   * @param type $jobs 
   * @return type
   */
  public function setActiveJobs($jobs) {
    $this->active_jobs = $jobs;
  }
  
  /**
   * getter active jobs
   * @return type
   */
  public function getActiveJobs() {
    return $this->active_jobs;
  }
  
  /**
   * Description
   * @return type
   */
  public function getSlug() {
    return Jobeet::slugify($this->getName());
  }
  
  private $more_jobs;
  
  /**
   * setter more jobs
   * @param type $jobs 
   * @return type
   */
  public function setMoreJobs($jobs) {
    $this->more_jobs = $jobs >= 0 ? $jobs : 0;
  }
  
  /**
   * getter more jobs
   * @return type
   */
  public function getMoreJobs() {
    return $this->more_jobs;
  }
}
