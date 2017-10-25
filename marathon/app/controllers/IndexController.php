<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        // Add some local CSS resources
        $this->assets->addCss('css/main/main.css');
        $this->assets->addJs('js/map/map.js');
    }

}

