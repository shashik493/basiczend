<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base
 *
 * @author OPENSOURCE developer
 * @email shashik493@gmail.com
 */

namespace Admin\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;

class Base implements ServiceLocatorAwareInterface{
    //put your code here
    public $serviceLocator;
    
    protected $commonObj;
    protected $userId;
    protected $token;
    
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }
     public function getServiceLocator() {
    return $this->serviceLocator;
  }
  
    
    
    
    public function setDefaultParam(){
        $this->commonObj = $this->getServiceLocator()->get('Admin\Service\Commonadmin');
        $this->token = $this->commonObj->getSessionToken();
        $this->userId = $this->commonObj->getUserId();
    }
    
    public function setDefaultParamFrUser(){
        $this->commonObj = $this->getServiceLocator()->get('Admin\Service\Common');
        $this->token = $this->commonObj->getSessionToken();
        $this->userId = $this->commonObj->getUserId();
    }
    
  
}
