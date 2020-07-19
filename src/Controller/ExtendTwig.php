<?php


namespace App\Controller;

use Twig\Environment;

class ExtendTwig  extends  Environment
{
    function __construct(...$args) {
        var_dump($args); die;
        return parent::__construct($args);
    }

}