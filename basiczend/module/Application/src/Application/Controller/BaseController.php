<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class BaseController extends AbstractActionController {

    protected $userLoginDateTime;

    /*public function onDispatch(\Zend\Mvc\MvcEvent $e) {

        //tempuserdata get
        $tempUsersession = new Container('SESSION_LASTLOGIN_TIME');
        $this->userLoginDateTime = $tempUsersession->offsetGet('LOGINDATETIME');
        $this->layout()->setVariable('loggedInUserDate', $this->userLoginDateTime);

        $session = new Container('SESSION_USER');
        $userData = $session->offsetget('userData');
        $this->layout()->setVariable('userData', $userData);

        parent::onDispatch($e);
    }*/

     public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        $session = new Container('SESSION_USER');
        //$session->offsetSet('email',"");
        $loggedIn = true;
        if ($session->offsetExists('isLoggedIn')) {
            $isLoggedIn = $session->offsetGet('isLoggedIn');
            if ($isLoggedIn == false) {
                $loggedIn = false;
            } else {
                $sessionTime = $session->offsetGet('sessiontimeUser');
                $currentTime = strtotime(date("d-m-Y H:i:s"));
                if ($sessionTime >= $currentTime) {

                   // $session->offsetSet('loginTime', time());
                    //tempuserdata get
                    $tempUsersession = new Container('SESSION_LASTLOGIN_TIME');
                    $this->userLoginDateTime = $tempUsersession->offsetGet('LOGINDATETIME');
                    $this->layout()->setVariable('loggedInUserDate', $this->userLoginDateTime);

                    $session = new Container('SESSION_USER');
                    $userData = $session->offsetget('userData');
                    $this->layout()->setVariable('userData', $userData);
                } else {
                    $session1 = new Container('SESSION_USER');
                    $session1->offsetSet('isLoggedIn', false);
                    $session1->offsetSet('userId', false);
                    $session1->offsetSet('time', time());
                    $session1->offsetSet('userData', array());
                    $session1->offsetSet('sessiontimeUser', false);
                    $loggedIn = false;
                }
            }
        } else {
            $loggedIn = false;
        }
        if ($loggedIn == false) {
            return $this->redirect()->toRoute('application');
        }
        parent::onDispatch($e);
    }

    
    
}
