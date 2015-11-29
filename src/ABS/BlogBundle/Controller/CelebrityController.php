<?php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Celebrity;
use ABS\BlogBundle\Form\CelebrityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CelebrityController extends Controller
{
    public function celebritiesAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $celebrities = $em->getRepository("ABSBlogBundle:Celebrity")->findAllOrderedByName();
        return $this->render('ABSBlogBundle:Celebrity:index.html.twig',array('celebrities' => $celebrities) );    
    }


    public function add_celebrityAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $celebrity = new Celebrity();
        $form = $this->createForm(new CelebrityType(), $celebrity);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);

            $celebrity = $form->getData();
            $em->persist($celebrity);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_celebrity",array('name' => $celebrity->getName(),)));


        }
       

        return $this->render('ABSBlogBundle:Celebrity:add.html.twig',array('form'=> $form->createView(),));
    }
    
    public function show_celebrityAction(Celebrity $celebrity)
    { 
        
        return $this->render('ABSBlogBundle:Celebrity:show.html.twig',array('celebrity' => $celebrity,) );

        
    }


    public function edit_celebrityAction(Celebrity $celebrity){
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createForm(new CelebrityType(), $celebrity);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            if($form->isValid())
            {
                $c = $form->getData();
                $em->persist($c);
                $em->flush();

                return $this->redirect($this->generateUrl("abs_blog_show_celebrity",array('name' => $c->getName(),)));
            }   

        }

        return $this->render('ABSBlogBundle:Celebrity:edit.html.twig',array('form'=> $form->createView(), 'celebrity'=> $celebrity,));
    }


    public function delete_celebrityAction(Celebrity $celebrity){


        $em = $this->getDoctrine()->getEntityManager();

        $em->remove($celebrity);
        $em->flush();

        return $this->redirect($this->generateUrl("abs_blog_celebrities"));


     }


}

