<?php

namespace ABS\BlogBundle\Entity;

/**
 * SerieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SerieRepository extends \Doctrine\ORM\EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT s FROM ABSBlogBundle:Serie s ORDER BY s.name ASC'
            )
            ->getResult();
    }

    public function findByAlphabet($c)
    {
        $query = $this->getEntityManager()
                        ->createQuery("
	            SELECT s FROM ABSBlogBundle:Serie s WHERE s.name LIKE :key ORDER BY s.name ASC"
                        );
        $query->setParameter('key', $c.'%');
        return $query->getResult();
    }
}
