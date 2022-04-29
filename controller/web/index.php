<?php

namespace controller\web;

use controller\baseController;

class index extends baseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        echo 111;
    }
}