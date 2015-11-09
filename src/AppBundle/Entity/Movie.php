<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 */
class Movie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="movie_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $movieId;

    /**
     * @var string
     *
     * @ORM\Column(name="movie_name", type="text")
     */
    private $movieName;

    /**
     * @var string
     *
     * @ORM\Column(name="release_year", type="string", length=4)
     */
    private $releaseYear;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer")
     */
    private $rating;

    /**
     * Get movieId
     *
     * @return integer
     */
    public function getMovieId()
    {
        return $this->movieId;
    }

    /**
     * Set movieName
     *
     * @param string $movieName
     *
     * @return Movie
     */
    public function setMovieName($movieName)
    {
        $this->movieName = $movieName;

        return $this;
    }

    /**
     * Get movieName
     *
     * @return string
     */
    public function getMovieName()
    {
        return $this->movieName;
    }

    /**
     * Set releaseYear
     *
     * @param string $releaseYear
     *
     * @return Movie
     */
    public function setReleaseYear($releaseYear)
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    /**
     * Get releaseYear
     *
     * @return string
     */
    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Movie
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }
}

