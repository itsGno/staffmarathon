<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
  public function initialize(){
    $this->tag->setTitle("Staff CMU MARATHON");
  }
  public function beforeExecuteRoute(){ // ตรวจสอบก่อนเริ่มระบบ
      if(!$this->session->has("username") && $this->dispatcher->getControllerName() != "authen"){
        $this->dispatcher->forward([
          'controller' => 'authen',
          'action' => 'index',
        ]);
      }else{
        return;
      }
    }


}
