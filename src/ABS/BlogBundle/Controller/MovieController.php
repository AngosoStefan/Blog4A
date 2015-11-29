<?php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Movie;
use ABS\BlogBundle\Form\MovieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    public function moviesAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $movies = $em->getRepository("ABSBlogBundle:Movie")->findAllOrderedByName();
        return $this->render('ABSBlogBundle:Movie:index.html.twig',array('movies' => $movies) );    
    }

     public function moviesbyletterAction($c)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $movies = $em->getRepository("ABSBlogBundle:Movie")->findByAlphabet($c);
        if(!$movies){
            return $this->render('ABSBlogBundle:Movie:error.html.twig',array('movies' => $movies) );
        }
        else{
            return $this->render('ABSBlogBundle:Movie:index.html.twig',array('movies' => $movies) );
        }     
    }


    public function add_movieAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $movie = new Movie();
        $form = $this->createForm(new MovieType(), $movie);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);

            $movie = $form->getData();
            $em->persist($movie);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_movie",array('id' => $movie->getId(),)));


        }
       

        return $this->render('ABSBlogBundle:Movie:add.html.twig',array('form'=> $form->createView(),));
    }
    
    public function show_movieAction(Movie $movie)
    { 


        return $this->render('ABSBlogBundle:Movie:show.html.twig',array('movie' => $movie,));

        
    }


    public function edit_movieAction(Movie $movie){
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new MovieType(), $movie);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            if($form->isValid())
            {
                $m = $form->getData();
                $em->persist($m);
                $em->flush();

                return $this->redirect($this->generateUrl("abs_blog_show_movie",array('id' => $m->getId(),)));
            }   

        }

        return $this->render('ABSBlogBundle:Movie:edit.html.twig',array('form'=> $form->createView(), 'movie'=> $movie,));
    }


    public function delete_movieAction(Movie $movie){


        $em = $this->getDoctrine()->getEntityManager();

        $em->remove($movie);
        $em->flush();

        return $this->redirect($this->generateUrl("abs_blog_movies"));


     }


}

