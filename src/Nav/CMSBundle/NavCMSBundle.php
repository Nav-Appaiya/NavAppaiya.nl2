<?php

namespace Nav\CMSBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class NavCMSBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
