<?php

namespace ABS\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ABS\BlogBundle\Entity\Article;
use ABS\BlogBundle\Entity\Comment;
use ABS\BlogBundle\Form\ArticleType;
use ABS\BlogBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
        $articles = $em->getRepository("ABSBlogBundle:Article")->findAllOrderedByDate();
        return $this->render('ABSBlogBundle:Article:index.html.twig',array('articles' => $articles) );    
    }


    public function addAction(){
        $em = $this->getDoctrine()->getEntityManager();

        $a = new Article();
        $form = $this->createForm(new ArticleType(), $a);

        $request = $this->getRequest();
        if($request->isMethod('POST')){
            $form->bind($request);
            //$a->upload();

            $a = $form->getData();
            $em->persist($a);
            $em->flush();

            return $this->redirect($this->generateUrl("abs_blog_show_article",array('id' => $a->getId(),)));
            /*var_dump($form);
            exit();*/

        }
       

        return $this->render('ABSBlogBundle:Article:add.html.twig',array('form'=> $form->createView(),));
    }
    
    public function showAction(Article $article)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $comments = $em->getRepository("ABSBlogBundle:Comment")->findByArticle($article->getId());

        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);
        
        return $this->render('ABSBlogBundle:Article:show.html.twig',array('article' => $article,'comments'=> $comments, 'form'=> $form->createView() ));

        
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

                return $this->redirect($this->generateUrl("abs_blog_show_article",array('id' => $a->getId(),)));
            }   

        }

        return $this->render('ABSBlogBundle:Article:edit.html.twig',array('form'=> $form->createView(), 'article'=> $article,));
    }


    public function deleteAction(Article $article){


        $em = $this->getDoctrine()->getEntityManager();

        $em->remove($article);
        $em->flush();

        return $this->redirect($this->generateUrl("abs_blog_articles"));


     }


}

