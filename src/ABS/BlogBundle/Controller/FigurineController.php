<?php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Figurine;
use ABS\BlogBundle\Form\FigurineType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FigurineController extends Controller
{
    public function figurinesAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $figurines = $em->getRepository("ABSBlogBundle:Figurine")->findAll();
        return $this->render('ABSBlogBundle:Figurine:index.html.twig',array('figurines' => $figurines) );    
    }


    public function add_figurineAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $f = new Figurine();
        $form = $this->createForm(new FigurineType(), $f);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            $f = $form->getData();
            $em->persist($f);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_figurine",array('id' => $f->getId(),)));
            /*var_dump($form);
            exit();*/

        }
       

        return $this->render('ABSBlogBundle:Figurine:add.html.twig',array('form'=> $form->createView(),));
    }
    
    public function show_figurineAction(Figurine $figurine)
    {
        return $this->render('ABSBlogBundle:Figurine:show.html.twig',array('figurine' => $figurine,) );
    }


    public function edit_figurineAction(Figurine $figurine){
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new FigurineType(), $figurine);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            if($form->isValid())
            {
                $f = $form->getData();
                $em->persist($f);
                $em->flush();

                return $this->redirect($this->generateUrl("abs_blog_show_figurine",array('id' => $f->getId(),)));
            }   

        }

        return $this->render('ABSBlogBundle:Figurine:edit.html.twig',array('form'=> $form->createView(), 'figurine'=> $figurine,));
    }


    public function delete_figurineAction(Figurine $figurine){


        $em = $this->getDoctrine()->getEntityManager();

        $em->remove($figurine);
        $em->flush();

        return $this->redirect($this->generateUrl("abs_blog_figurines"));


     }


}

