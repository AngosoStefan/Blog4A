<?php
// src/ABS/BlogBundle/Controller/PageController.php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('ABSBlogBundle:Page:index.html.twig');
    }

    public function moviesAction()
    {
    	return $this->render('ABSBlogBundle:Page:movies.html.twig');
    }

    public function seriesAction()
    {
    	return $this->render('ABSBlogBundle:Page:series.html.twig');
    }

    public function figuresAction()
    {
    	return $this->render('ABSBlogBundle:Page:figures.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('ABSBlogBundle:Page:about.html.twig');
    }

}