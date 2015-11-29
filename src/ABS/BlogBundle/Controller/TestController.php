<?php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Test;
use ABS\BlogBundle\Form\TestType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TestController extends Controller
{
    public function figurinesAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $figurines = $em->getRepository("ABSBlogBundle:Figurine")->findAll();
        return $this->render('ABSBlogBundle:Figurine:index.html.twig',array('figurines' => $figurines) );    
    }


    public function add_testAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $f = new Test();
        $form = $this->createForm(new TestType(), $f);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            $f = $form->getData();
            $em->persist($f);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_test",array('name' => $f->getName(),)));
            /*var_dump($form);
            exit();*/

        }
       

        return $this->render('ABSBlogBundle:Test:add.html.twig',array('form'=> $form->createView(),));
    }
    
    public function show_figurineAction(Figurine $figurine)
    {
        
        return $this->render('ABSBlogBundle:Figurine:show.html.twig',array('figurine' => $figurine,) );

        
    }


    public function editAction(Article $article){
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new ArticleType(), $article);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            if($form->isValid())
            {
                $a = $form->getData();
                $em->persist($a);
                $em->flush();

                return $this->redirect($this->generateUrl("abs_blog_show",array('id' => $a->getId(),)));
            }   

        }

        return $this->render('ABSBlogBundle:Article:edit.html.twig',array('form'=> $form->createView(), 'id'=> $article->getId(),));
    }


    public function deleteAction(Article $article){


        $em = $this->getDoctrine()->getEntityManager();

        $em->remove($article);
        $em->flush();

        return $this->redirect($this->generateUrl("abs_blog_homepage"));


     }


}

