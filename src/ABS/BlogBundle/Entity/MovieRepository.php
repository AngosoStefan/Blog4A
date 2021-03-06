<?php

namespace ABS\BlogBundle\Entity;

/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT m FROM ABSBlogBundle:Movie m ORDER BY m.name ASC'
            )
            ->getResult();
    }

    public function findByAlphabet($c)
    {
        $query = $this->getEntityManager()
                        ->createQuery("
	            SELECT s FROM ABSBlogBundle:Movie s WHERE s.name LIKE :key ORDER BY s.name ASC"
                        );
        $query->setParameter('key', $c.'%');
        return $query->getResult();
    }
}
