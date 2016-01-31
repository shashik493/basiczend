<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class BaseController extends AbstractActionController {

     

    public function onDispatch(\Zend\Mvc\MvcEvent $e) {

        $session = new Container('SESSION_ADMIN');
       
        $loggedIn = true;
        if ($session->offsetExists('isLogged')) {
            $isLoggedIn = $session->offsetGet('isLogged');
            if ($isLoggedIn == false) {
                $loggedIn = false;
            } else {
                $sessionTime = $session->offsetGet('sessiontime');
                $currentTime = strtotime(date("d-m-Y H:i:s"));
                if ($sessionTime >= $currentTime) {

                    $session->offsetSet('loginTime', time());
                    //tempuserdata get
                    $tempUsersession = new Container('SESSIONADMIN');
                    $this->userLoginDateTime = $tempUsersession->offsetGet('LOGINDATETIMEADMIN');
                    $this->layout()->setVariable('loggedInUserDate', $this->userLoginDateTime);

                    $userData = $session->offsetget('userData');
                    $this->layout()->setVariable('userData', $userData);
                } else {
                    $session1 = new Container('SESSION_ADMIN');
                    $session1->offsetSet('isLoggedInAdmin', false);
                    $session1->offsetSet('userIdAdmin', false);
                    $session1->offsetSet('timeAdmin', time());
                    $session1->offsetSet('userData', array());
                    $session1->offsetSet('sessiontimeAdmin', false);
                    $loggedIn = false;
                }
            }
        } else {
            $loggedIn = false;
        }
        if ($loggedIn == false) {
            return $this->redirect()->toRoute('login');
        }
        parent::onDispatch($e);
    }

}
