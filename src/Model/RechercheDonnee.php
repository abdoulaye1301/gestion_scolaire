<?php

namespace App\Model;

use Symfony\Component\Form\AbstractType;

class RechercheDonnee extends AbstractType
{
    /** @var int */
    public $page = 1;

    /** @var string */
    public $q = '';
}
