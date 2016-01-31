<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
$protocol=$_SERVER['REQUEST_SCHEME'] . '://';
return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=;host=localhost',
        'username'       => "",
        'password'       => "",
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => new Zend\Db\Adapter\AdapterServiceFactory('db')
        ),
    ),
   'APPLICATION_PATH'=> $protocol.$_SERVER['HTTP_HOST']."/",
    'APPLICATION_API_PATH'=> 'http://mlfapi.codeepsilonservices.com.cp-15.webhostbox.net/public',//'http://zend.local/',
);