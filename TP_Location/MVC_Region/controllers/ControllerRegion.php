<?php
require_once('MVC_Region/views/View.php');

class ControllerRegion{
    private $_regionManager;
    private $_view;

    public function __construct($url){
        if(isset($url) && strlen($url) > 1)
            throw new Exception('Page introuvable');
        else
            $this->region();
    }

    private function region(){
        $this->_regionManager = new RegionManager;
        $region = $this->_regionManager->getRegion();

        $this->_view = new View('Region');
        $this->_view->generate(array('region' => $region));
    }
}
