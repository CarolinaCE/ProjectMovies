<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class MovieRepository extends EntityRepository
{

	/**
	 * Get all saved movies ordered by name
	 * @return array The movies.
	 */
    public function findMoviesOrderedByName()
    {	
    	// Change table name
    	$this->getEntityManager()
    		 ->getClassMetadata('AppBundle:Movie')
    		 ->setTableName('movies');

        return $this->getEntityManager()
                    ->createQuery('SELECT u FROM AppBundle\Entity\Movie u
                                    ORDER BY u.movieName')
                    ->getResult();
    }
}