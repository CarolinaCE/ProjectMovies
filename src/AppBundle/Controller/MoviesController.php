<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Movie;
use Assetic\Exception\Exception;

class MoviesController extends Controller
{

    /**
     * @Route("/movies", name="movies_list")
     */
    public function indexAction(Request $request)
    {
        try {

            // Process data if POST
            if ($request->isMethod('POST')) {

                // Check what operation was performed
                switch ($request->request->get('action')) {
                    case 'insert':
                        $response = $this->addMovie($request);
                        break;
                    
                    case 'update':
                        $response = $this->updateMovie($request);
                        break;

                    case 'delete':
                        $response = $this->deleteMovie($request);
                        break;

                    default:
                        throw new Exception('Not a supported action for Ajax Requests');
                        break;
                }

                return new JsonResponse($response);
            }
                                
            // Use the MovieRepository to query and get all the movies that were saved
            $em = $this->getDoctrine()->getEntityManager();
            $movies = $em->getRepository('AppBundle:Movie')->findMoviesOrderedByName();
            
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
     * Adds a new movie to the database
     * @param Request $request
     */
    protected function addMovie(Request $request)
    {
        try {
            // Create a new object holding the posted data
            $movie = new Movie();

            $movie->setMovieName($request->request->get('movieName'));
            $movie->setReleaseYear($request->request->get('releaseYear'));
            $movie->setRating($request->request->get('rating'));

            // Auto generate next id and insert data
            $em = $this->getDoctrine()->getManager();
            $this->changeTableName($em);

            $em->persist($movie);
            $metadata = $em->getClassMetaData(get_class($movie));
            $metadata->setIdGenerator(new \Doctrine\ORM\Id\AssignedGenerator());
            $em->flush();

            $response['success']  = true;
            $response['cause']    = 'Movie '. $request->request->get('movieName') . ' added successfully!';
           // $response['movie_id'] = $movie_id;

        } catch (Exception $e) {
            $response['success'] = false;
            $response['cause'] = 'Invalid request';
        }

        return $response;
    }

    /**
     *  Given a movie id sent in a request, deletes the corresponding movie
     * 
     * @param  Request $request
     * @return array
     *   Array with the response to the action
     */
    protected function deleteMovie(Request $request)
    {
        try {
            // Get entity manager
            $em = $this->getDoctrine()->getManager();

        } catch (Exception $e) {
            $response['success'] = false;
            $response['cause'] = 'Deletion failed';
        }

        return new JsonResponse($response);   
    }

    /**
     *  Performs an update on a movie table entry given an id
     *
     * @param  Request $request
     * @return array
     *   Array with the response to the action
     */
    protected function updateMovie(Request $request)
    {
        try {

        } catch (Exception $e) {
            $response['success'] = false;
            $response['cause'] = 'Could not update entry';
        }

        return new JsonResponse($response);  
    }

    /**
     * Allows changing the name to insert data to given the EntityManager
     *
     * @param  EntityManager $em
     * @return void
     */
    protected function changeTableName($em)
    {
        $cm = $em->getClassMetadata('AppBundle:Movie');
        $cm->setTableName('movies');
    }

}
