<?php
// src/ABS/BlogBundle/Controller/CommentController.php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Comment;
use ABS\BlogBundle\Entity\Article;
use ABS\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
   public function add_commentAction(Article $article){

        $em = $this->getDoctrine()->getEntityManager();

        $comment = new Comment();
       
        $form = $this->createForm(new CommentType(), $comment);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            $comment->setArticle($em->getRepository("ABSBlogBundle:Article")->find($article->getId()));
            $comment = $form->getData();
            $user= $this->container->get('security.context')->getToken()->getUser();
            $userId = $user->getId();
            $userPath = $user->getPath();
            $comment->setUser($user);
            if($userPath==NULL)
            {
                $comment->setAvatar(NULL);
            }
            else{
                $comment->setAvatar($userId.'.'.$userPath);
            }
            

            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_article",array('id' => $article->getId(),)));


        }
       

        return $this->render('ABSBlogBundle:Comment:form.html.twig',array('form'=> $form->createView(), 'comment' => $comment));
    }

     public function show_commentAction(Comment $comment)
    { 


        return $this->render('ABSBlogBundle:Comment:show.html.twig',array('comment'=> $comment, ));

        
    }



}