<?php

class EmergencyController extends \Phalcon\Mvc\Controller
{
 
    public function indexAction()
    {
   
    }
    public function testAction()
    {
        $test = 'test';
     $this->view->test = $test;

    }

}

