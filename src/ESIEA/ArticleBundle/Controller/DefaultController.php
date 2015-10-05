<?php

namespace ESIEA\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ESIEA\ArticleBundle;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
    	new ArticleBundle\ESIEAArticleBundle();
        return $this->render('ESIEAArticleBundle:Default:index.html.twig', array('name' => $name));
    }
}
