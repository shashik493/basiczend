<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\SessionManager;
use Zend\Session\Config\SessionConfig;
use Zend\Session\Container;

class Module {

    protected $_serviceManage;

    public function onBootstrap(MvcEvent $e) {
        $app = $e->getApplication();
        $this->_serviceManage = $app->getServiceManager()->get('config');

        $e->getApplication()
                ->getEventManager()
                ->getSharedManager()
                ->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', function($e) {
                    $controller = $e->getTarget();
                    $controllerClass = get_class($controller);
                    $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
                    $config = $e->getApplication()->getServiceManager()->get('config');
                    if (isset($config['module_layouts'][$moduleNamespace])) {
                        $controller->layout($config['module_layouts'][$moduleNamespace]);
                    }
                    //controller details
                    $routeMatch = $e->getRouteMatch();
                    $viewModel = $e->getViewModel();
                    $controllerName=$routeMatch->getParam('controller');
                      $controllerA = explode('\\', $controllerName); 
                 // echo "r=".array_pop($controller1);   exit;
                    $viewModel->setVariable('controllerM',array_pop($controllerA));
                    
                    $viewModel->setVariable('action', $routeMatch->getParam('action'));
                    
                }, 100);
               
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(                
               
                'Admin\Service\Common' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new \Admin\Service\Common($dbAdapter);
                    return $table;
                },                           
                'Admin\Service\Base' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new \Admin\Service\Base($dbAdapter);
                    return $table;
                },              
                'Admin\Service\Commonadmin' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new \Admin\Service\Commonadmin($dbAdapter);
                    return $table;
                },
                'Admin\Service\Users' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new \Admin\Service\Users($dbAdapter);
                    return $table;
                },  
                'Admin\Service\Contacts' => function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new \Admin\Service\Contacts($dbAdapter);
                    return $table;
                }  
            )
        );
    }

}
