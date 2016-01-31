<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Http\Client;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        //$e->getApplication()->getServiceManager()->get('translator');
        /*$e->getApplication()->getServiceManager()->get('viewhelpermanager')->setFactory('myviewalias', function($sm) use ($e) {
            $viewHelper = new MyViewHelper($e->getRouteMatch());
            return $viewHelper;
        });*/
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    
        
      
        
        /*$app = $e->getApplication();
        $this->_serviceManage =$app->getServiceManager()->get('config');
                
		$e->getApplication()
            ->getEventManager()
            ->getSharedManager()
            ->attach('Zend\Mvc\Controller\AbstractController', 'dispatch', 
                    function($e) {
                        $controller = $e->getTarget();
                        $controllerClass = get_class($controller);
                        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
                        $config = $e->getApplication()->getServiceManager()->get('config');
                        if (isset($config['module_layouts'][$moduleNamespace])) {
                            $controller->layout($config['module_layouts'][$moduleNamespace]);
                        }
                    }, 90);*/
        
        
        /* $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_RENDER, function($event){
             $event->getResponse()->getHeaders()->addHeaderLine('Access-Control-Allow-Origin','*')->addHeaderLine('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')->addHeaderLine('Token','123');
		  
             $client = new Client();
             $headers = $client->getRequest()->getHeaders();
             //$headers->addHeaderLine('Token', 'www.example.com');
             $client->setCookies($cookies->getMatchingCookies($client->getUri()));
             
             $client->setHeaders(array(
                    \Zend\Http\Header\Host::fromString('Host: www.example.com'),
                    'Accept-Encoding' => 'gzip,deflate',
                    'Token'=>123,
                    'X-Powered-By: Zend Framework',
                    ));
           
             //echo "<pre>";print_r($headers);exit;
             $header=getallheaders();
            echo "<pre>"; print_r($header);exit;
        });*/
        
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
   
       
   
    
    
    
    public function getServiceConfig()
    {	
        /*return array(
             'factories' => array(
                'Application\Service\Cms' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table     = new \Application\Service\Cms($dbAdapter);
                    return $table;
                }
            ),
            'shared'=>array(
                'Application\Service\Cms'=>true,
            )
        );*/
    }
}
