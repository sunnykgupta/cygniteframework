<?php  if ( ! defined('CF_SYSTEM')) exit('External script access not allowed');
/**
 *  Cygnite Framework
 *  Global Configuration Settings
 *
 *  An open source application development framework for PHP 5.3x or newer
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
 *@package                         :  Apps
 *@subpackages                :  Configurations
 *@filename                        :  appconfig
 *@description                    : You can set your all your global configurations here.
 *@author                           : Sanjoy Dey
 *@copyright                      :  Copyright (c) 2013 - 2014,
 *@link	                  :  http://www.appsntech.com
 *@since	                 :  Version 1.0
 *@filesource
 *@warning                      :  If you don't protect this directory from direct web access, anybody will be able to see your configuaration and settings.
 *
 *
 */

return array (
                       /*
                        *--------------------------------------------------------------------------
                        * Your Application Base URL
                        *--------------------------------------------------------------------------
                        * The base URL used to import your application assets in your webpage.
                        * Based on base url we will perform page redirect and other internal
                        * functionalities.
                        */
                        'base_path'                   => 'http://'.$_SERVER['HTTP_HOST'].'/cygniteframework/',

                      /*
                        *--------------------------------------------------------------------------
                        * Your Application Default Controller
                        *--------------------------------------------------------------------------
                        * Set your application default controller here. Default controller
                        * will be called when you try to access cygnite application.
                        */
                         'default_controller'          => 'home',

                        /*
                        *--------------------------------------------------------------------------
                        * Your Application Default Method
                        *--------------------------------------------------------------------------
                        * You can set your application default method here. By default we
                        * we will call index method of your controller.
                        *
                        * @note : You cannot change the default method in current version. We will
                        * have a provision to change the default method in next version of cygnite.
                        *
                        */
                         'default_method'          => 'index',

                         /*
                        *--------------------------------------------------------------------------
                        * Your Application Character Encoding
                        *--------------------------------------------------------------------------
                        * Here you can set your application default character encoding . This encoding
                        * will be used by the Str, Text, Form, and any other classes that need
                        *  to know what type of encoding to use for your generous application.
                        *
                        */
                         'encoding'                          => 'UTF-8',

                       /*
                        *--------------------------------------------------------------------------
                        * Your Application Language
                        *--------------------------------------------------------------------------
                        * You can set your application default language here. Language library will
                        * will take care rest.
                        */
                        'language' => 'en',

                          /*
                        *--------------------------------------------------------------------------
                        * Application Timezone
                        *--------------------------------------------------------------------------
                        * You can set your application timezone here.This timezone will
                        * be used when cygnite need date time or any internal features.
                        *
                        */
                        'timezone' => 'UTC',

                       /*
                        *--------------------------------------------------------------------------
                        *  Application Encryption key
                        *--------------------------------------------------------------------------
                        * Set your encryption key here. You must set your encryption key here in order to
                        * use cygnite secure encryption and session library. We used php mcrypt extension
                        * library for encryption library. So please check whether you have else please activate
                        * to work with secure encryption and session library.
                        */
                        'cf_encryption_key'           => 'cygnite-shaXatBNHQ4z59c4mrez',

                       /*
                        *--------------------------------------------------------------------------
                        * Benchmark Your Application
                        *--------------------------------------------------------------------------
                        * Enable profiling as True if you wish to benchmark your aplication. You can
                        * make it FALSE to deactivate profiling. Cygnite will take care rest.
                        */
                        'enable_profiling'            => TRUE,

                        /*
                        *--------------------------------------------------------------------------
                        * ************Your Application Cache Config*************
                        *--------------------------------------------------------------------------
                        * You can enable cache here (example: TRUE/FALSE). Cygnite have
                        * three type of cache driver FileCache, Memcache, APC to boost your
                        * application performace. Follow user guide for usages.
                        */
                        'enable_cache'                => TRUE,

                       /*
                        *---------------------------------------------------------------------------
                        * Cache Name
                        *---------------------------------------------------------------------------
                        * Set your cache name here to generate cache file name if you are
                        * using cygnite file caching technique.
                        */
                        'cache_name'                  => 'cf_cache',

                         /*
                        *---------------------------------------------------------------------------
                        * Cache Extension
                        *---------------------------------------------------------------------------
                        * Set your cache extension here. Cygnite will take care of rest. Cache will
                        * store with same extension which you will provide here.
                        *
                        */
                        'cache_extension'             => '.cache',

                       /*
                        *---------------------------------------------------------------------------
                        * Cache Type
                        *---------------------------------------------------------------------------
                        * Set your cache type here. Cygnite will take care of rest.
                        *
                        */
                        'cache_type'                  => 'filecache',

                      /*
                        *---------------------------------------------------------------------------
                        * Cache Storage Location
                        *---------------------------------------------------------------------------
                        * Set your cache file storage location here. By default we are using
                        * temp/cache.
                        *
                        */
                        'cache_directory'              => 'temp/cache', //Default value is none

                        /*
                        *---------------------------------------------------------------------------
                        * Set Application Environment
                        *---------------------------------------------------------------------------
                        * You can set your application environment in order to handle errors and exceptions.
                        * Development mode all errors are turned on. So that you can able to fix all issues easily.
                        * Errors will be turned of in production server mode.
                        *
                        */
                        'environment'               =>  'development', //Errors are turned on in development environtment

                        'level'                             => 'E_ALL & ~E_DEPRECATED',//E_ALL ^ E_DEPRECATED

                       /*
                        *---------------------------------------------------------------------------
                        * Cygnite Application Logs
                        *---------------------------------------------------------------------------
                        * Though cygnite log generator library available we need to integrate
                        * with core files in order to make it. It will be available in next version
                        * of cygnite.
                        */
                        'log_errors'                   => 'on',

                        //You can set value  1- Display error, 2 - Generate and write into log file
                        'log_trace_type'         => 2,  // Will be available on next version.
                      /*
                        *---------------------------------------------------------------------------
                        * Logs File Name
                        *---------------------------------------------------------------------------
                        * Set your log file name here. Your applications logs will generate
                        * by cygnite engine and store as filename you provide here.
                        *
                        */
                        'log_file_name'          => 'application_logs' ,
                        /*
                        *---------------------------------------------------------------------------
                        * Logs Storage Location
                        *---------------------------------------------------------------------------
                        * Set your log storage location here. By default we are using
                        * temp/logs.
                        *
                        */
                        'log_path'                    => 'temp/logs'

);