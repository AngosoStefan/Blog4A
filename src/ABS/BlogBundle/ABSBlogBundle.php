<?php

namespace ABS\BlogBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ABSBlogBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
