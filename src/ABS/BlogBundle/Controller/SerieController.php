<?php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Serie;
use ABS\BlogBundle\Form\SerieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SerieController extends Controller
{
    public function seriesAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $series = $em->getRepository("ABSBlogBundle:Serie")->findAllOrderedByName();
        return $this->render('ABSBlogBundle:Serie:index.html.twig',array('series' => $series) );     
    }

    public function seriesbyletterAction($c)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $series = $em->getRepository("ABSBlogBundle:Serie")->findByAlphabet($c);
        if(!$series){
            return $this->render('ABSBlogBundle:Serie:error.html.twig',array('series' => $series) );
        }
        else{
            return $this->render('ABSBlogBundle:Serie:index.html.twig',array('series' => $series) );
        }   
    }



    public function add_serieAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $serie = new Serie();
        $form = $this->createForm(new SerieType(), $serie);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);

            $serie = $form->getData();
            $em->persist($serie);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_serie",array('id' => $serie->getId(),)));


        }
       

        return $this->render('ABSBlogBundle:Serie:add.html.twig',array('form'=> $form->createView(),));
    }
    
    public function show_serieAction(Serie $serie)
    { 
        
        return $this->render('ABSBlogBundle:Serie:show.html.twig',array('serie' => $serie,) );

        
    }


    public function edit_serieAction(Serie $serie){
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new SerieType(), $serie);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            if($form->isValid())
            {
                $s = $form->getData();
                $em->persist($s);
                $em->flush();

                return $this->redirect($this->generateUrl("abs_blog_show_serie",array('id' => $s->getId(),)));
            }   

        }

        return $this->render('ABSBlogBundle:Serie:edit.html.twig',array('form'=> $form->createView(), 'serie'=> $serie,));
    }


    public function delete_serieAction(Serie $serie){


        $em = $this->getDoctrine()->getEntityManager();

        $em->remove($serie);
        $em->flush();

        return $this->redirect($this->generateUrl("abs_blog_series"));


     }


}

