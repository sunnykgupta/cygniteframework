<?php
namespace Cygnite;
if ( ! defined('CF_SYSTEM')) exit('No External script access allowed');
/**
 *  Cygnite Framework
 *
 *  An open source application development framework for PHP 5.3 or newer
 *
 *   License
 *
 *   This source file is subject to the MIT license that is bundled
 *   with this package in the file LICENSE.txt.
 *   http://www.appsntech.com/license.txt
 *   If you did not receive a copy of the license and are unable to
 *   obtain it through the world-wide-web, please send an email
 *   to sanjoy@hotmail.com so I can send you a copy immediately.
 *
 * @Package                          :  Apps
 * @Sub Packages                 :
 * @Filename                        :  router_config
 * @Description                    : This file is used to set all routing configurations
 * @Author                           : Cygnite dev team
 * @Copyright                     :  Copyright (c) 2013 - 2014,
 * @Link	                   :  http://www.appsntech.com
 * @Since	                  :  Version 1.0
 * @Filesource
 * @warning                     :  Any changes in this library can cause abnormal behaviour of the framework
 *
 *
 */
    $router = NULL;
    $router = Cygnite::loader()->router;
    $GLOBALS['router'] = $router;

    // Before Router Middleware
    $router->before('GET', '/.*', function() {
          //  echo "Cygnite Framework is under development";exit;
    });

    // Dynamic route: /hello/name
    $router->get('/hello/(\w+)', function($name) {
            echo 'Hello ' . htmlentities($name);
            $defaultController = ucfirst(APPPATH).'\\Controllers\\'.ucfirst('home');
            include APPPATH.DS.'controllers'.DS.'home'.EXT;
            $defaultAction = 'action_index';
            call_user_func_array(array(new $defaultController,$defaultAction), $param_arrarray = array());
            exit;
    });

    $router->get('/categories/emplist/', function()  {
            echo  "Category List";exit;
    });

    // Custom 404 Handler
  /*  $router->set404(function() {
            header('HTTP/1.1 404 Not Found');
            echo ' Oopps !! 404 Page';
    }); */
    $router->run();