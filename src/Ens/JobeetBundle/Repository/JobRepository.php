<?php
namespace Ens\JobeetBundle\Repository;
use Doctrine\ORM\EntityRepository;
 
class JobRepository extends EntityRepository
{
/**
 * requests db to get active jobs
 * @param string $category_id
 * @param string $max
 * @param string $offset
 * @return \Doctrine\ORM\array
 */
  public function getActiveJobs($category_id = null, $max = null, $offset = null)
  {
    $qb = $this->createQueryBuilder('j')
    ->where('j.expires_at > :date')
    ->setParameter('date', date('Y-m-d H:i:s', time()))
    ->andWhere('j.is_activated = :activated')
    ->setParameter('activated', 1)
    ->orderBy('j.expires_at', 'DESC');
 
    if($max)
    {
      $qb->setMaxResults($max);
    }
 
    if($offset)
    {
      $qb->setFirstResult($offset);
    }
 
    if($category_id)
    {
      $qb->andWhere('j.category = :category_id')
        ->setParameter('category_id', $category_id);
    }
 
    $query = $qb->getQuery();
 
    return $query->getResult();
  }
 
  /**
   * 
   * @param string $category_id
   * @return \Doctrine\ORM\mixed
   */
  public function countActiveJobs($category_id = null)
  {
    $qb = $this->createQueryBuilder('j')
    ->select('count(j.id)')
    ->where('j.expires_at > :date')
    ->setParameter('date', date('Y-m-d H:i:s', time()))
    ->andWhere('j.is_activated = :activated')
    ->setParameter('activated', 1);
 
    if($category_id)
    {
      $qb->andWhere('j.category = :category_id')
        ->setParameter('category_id', $category_id);
    }
 
    $query = $qb->getQuery();
 
    return $query->getSingleScalarResult();
  }
 
  /**
   * 
   * @param unknown $id
   * @return Ambigous <NULL, \Doctrine\ORM\mixed>
   */
  public function getActiveJob($id)
  {
    $query = $this->createQueryBuilder('j')
      ->where('j.id = :id')
      ->setParameter('id', $id)
      ->andWhere('j.expires_at > :date')
      ->setParameter('date', date('Y-m-d H:i:s', time()))
      ->andWhere('j.is_activated = :activated')
      ->setParameter('activated', 1)
      ->setMaxResults(1)
      ->getQuery();
 
    try {
      $job = $query->getSingleResult();
    } catch (\Doctrine\Orm\NoResultException $e) {
      $job = null;
    }
 
    return $job;
  }
}