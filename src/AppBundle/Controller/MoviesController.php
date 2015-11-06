<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends Controller
{
    /**
     * @Route("/movies", name="Movies List")
     */
    public function indexAction(Request $request)
    {
        try {

            // Retrieve the list of movies that have been saved
            $movies[] = [
                'movie_id' => 1,
                'movie_name' => 'Sweeney Todd: The Demon Barber of Fleet Street'
            ];

            $movies[] = [
                'movie_id' => 2,
                'movie_name' => 'The Conjuring'
            ];

            // Render the template that lists the existing movies and has actions that
            // could be performed for those
            return $this->render(
                'default/movies.html.twig',
                ['movies' => $movies]
            );

        } catch (Exception $e) {

        }
    }

    /**
     * @Route("/movies/delete/{movie_id}", name="Delete Movie")
     */
    public function deleteAction($movie_id)
    {
        return new Response('<html><body>About to delete '.$movie_id.'</body></html>');
    }

    /**
     * @Route("/movies/delete/{movie_id}", name="Update Movie")
     */
    public function updateAction($movie_id)
    {
        return new Response('<html><body>About to update '.$movie_id.'</body></html>');
    }

    /**
     * @Route("/movies/add/{movie_name}", name="Add Movie")
     */
    public function addAction($movie_name)
    {
        return new Response('<html><body>About to add '.$movie_name.'</body></html>');
    }

}
