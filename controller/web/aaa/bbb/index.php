<?php

namespace controller\web\aaa\bbb;

use controller\baseController;

class index extends baseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        echo 222;
    }
}