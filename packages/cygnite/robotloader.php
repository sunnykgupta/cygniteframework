<?php namespace Cygnite;

if ( ! defined('CF_SYSTEM')) exit('External script access not allowed');
/**
 *  Cygnite Framework
 *
 *  An open source application development framework for PHP 5.3x or newer
 *
 *   License
 *
 *   This source file is subject to the MIT license that is bundled
 *   with this package in the file LICENSE.txt.
 *   http://www.cygniteframework.com/license.txt
 *   If you did not receive a copy of the license and are unable to
 *   obtain it through the world-wide-web, please send an email
 *   to sanjoy@hotmail.com so I can send you a copy immediately.
 *
 *@package                     :  Packages
 *@subpackages                 :  Base
 *@filename                    :  CF_RobotLoader
 *@description                 :  This is auto loader for CF
 *@author                      :  Sanjoy Dey
 *@copyright                   :  Copyright (c) 2013 - 2014,
 *@link	                       :  http://www.cygniteframework.com
 *@since	                   :  Version 1.0
 *@filesource
 *@warning                     :  Any changes in this library can cause abnormal behaviour of the framework
 *
 *
 */

    class RobotLoader
    {
       /**
         * Cygnite Framework Core Classes Prefix
         */
         static private $coreprefix = 'CF_';

        /**
         * @var array
         */
        static private $instance = array();

         /*
          * ----------------------------------------------------------
          * Register all core classes to Cygnite Robot Engine
          * ----------------------------------------------------------
          * Never Manually change any core classes in this section
          * If you would like to add new class into our Robot Engine
          * then you can just register it on autoload libraries which will
          * be added dynamically to Engine else send me patches will
          * update core class.
          *
          */
        /**
         * @var array
         */
        static public $_classnames = array(
                                        'Dispatcher' =>  '\\Cygnite\\Base\\Dispatcher',
                                        'Router' =>  '\\Cygnite\\Base\\Router',
                                        'IRouter' =>  '\\Cygnite\\Base\\IRouter',
                                        'Logger' =>  '\\Cygnite\\Base\\Logger',
                                        'Encrypt'  =>  '\\Cygnite\\Libraries\\Encrypt',
                                        'Errorhandler'  =>  '\\Cygnite\\Libraries\\Errorhandler', //name changed
                                        'Security'  =>  '\\Cygnite\\Libraries\\Security',
                                        'Upload'  =>  '\\Cygnite\\Libraries\\Upload', //name changed
                                        'Httprequest'  =>  '\\Cygnite\\Libraries\\Httprequest', //name changed
                                        'CForm'  =>  '\\Cygnite\\Libraries\\CForm', //name changed *
                                        'Mailer'  =>  '\\Cygnite\\Libraries\\Mailer',
                                        'Zip'  =>  '\\Cygnite\\Libraries\\Zip',
                                        'ISecureData'  =>  '\\Cygnite\\Libraries\\Globals\\ISecureData', //name changed *
                                        'Globals'  =>  '\\Cygnite\\Libraries\\Globals\\Globals',
                                        'Cookie'  =>  '\\Cygnite\\Libraries\\Globals\\Cookie',
                                        'Files'  =>  '\\Cygnite\\Libraries\\Globals\\Files',
                                        'Get'  =>  '\\Cygnite\\Libraries\\Globals\\Get',
                                        'Post'  =>  '\\Cygnite\\Libraries\\Globals\\Post',
                                        'Request'  =>  '\\Cygnite\\Libraries\\Globals\\Request',
                                        'Server'  =>  '\\Cygnite\\Libraries\\Globals\\Server',
                                        'Session'  =>  '\\Cygnite\\Libraries\\Globals\\Session',
                                        'IMemoryStorage'  =>  '\\Cygnite\\Libraries\\Cache\\Handler\\IMemoryStorage',
                                        'Filecache'  =>  '\\Cygnite\\Libraries\\Cache\\Storage\\Filecache',
                                        'Apc'  =>  '\\Cygnite\\Libraries\\Cache\\Storage\\Apc',
                                        'CFMemcache'  =>  '\\Cygnite\\Libraries\\Cache\\Storage\\CFMemcache',
                                        'Pdf'  =>  '\\Cygnite\\Libraries\\Pdf',
                                        'Parser'  =>  '\\Cygnite\\Libraries\\Parser',
                                        'IRegistry'  =>  '\\Cygnite\\Loader\\IRegistry',
                                        'Appregistry'  =>  '\\Cygnite\\Loader\\Appregistry', //name changed
                                        'CF_BaseController'  =>  '\\Cygnite\\Loader\\CF_BaseController', //name changed
                                        'Apploader'  =>  '\\Cygnite\\Loader\\Apploader', //name changed
                                        'CF_BaseModel'  =>  '\\Cygnite\\Sparker\\CF_BaseModel', //name changed
                                        'CFView'  =>  '\\Cygnite\\Sparker\\CFView', //name changed
                                        'IActiverecords'  =>  '\\Cygnite\\Database\\IActiverecords',
                                        'CF_ActiveRecords'  =>  '\\Cygnite\\Database\\CF_ActiveRecords',//Cygnite\Database\CF_ActiveRecords
                                        'DBConnector'  =>  '\\Cygnite\\Database\\DBConnector',
                                        'Sqlutilities'  =>  '\\Cygnite\\Database\\Sqlutilities',
                                        'GHelper'=>'\\Cygnite\\Helpers\\GHelper',
                                        'Config'=>'\\Cygnite\\Helpers\\Config',
                                        'Url'=>'\\Cygnite\\Helpers\\Url',
                                        'Profiler'=>'\\Cygnite\\Helpers\\Profiler',
                                        'Assets'=>'\\Cygnite\\Helpers\\Assets',

        );

        /**
        * You cannot create the object of robot loader class directly
        * You can access the class only via Cygnite class
        * <code>
        * Cygnite::loader()
        * </code>
        */
        private function __construct() { }

        /**
        * Initialize the auto loader
        * set the include path, register the extensions for auto load
        */
        protected function init()
        {
               set_include_path(get_include_path().DS.APPPATH);
               set_include_path(get_include_path().DS.CF_SYSTEM);
               spl_autoload_unregister(array($this,'autoload'));
               spl_autoload_extensions(".php");
               spl_autoload_register(array($this, 'autoload'));
        }

        /**
         * @param      $string
         * @param    bool $is_lower
         * @internal bool $islower
         * @return   string
         */
        static private function changeCase($string,$is_lower=FALSE)
        {
              return ($is_lower===FALSE) ? strtolower($string): ucfirst($string);
        }

        /**
         * ----------------------------------------------------------
         * Auto load all classes
         * ----------------------------------------------------------
         * All classes will be dynamically auto loaded here
         *
         * @param $classname string
         * @throws \Exception
         * @return void
         */
       private function autoload($classname)
        {

        $path  = $rootdir ='';
        $_classnames =array();

        $_classnames = array_flip(self::$_classnames);
        if(array_key_exists($_classnames['\\'.self::changeCase($classname,TRUE)], self::$_classnames)):

                 if(preg_match("/Apps/i", self::$_classnames[self::changeCase($_classnames['\\'.$classname],TRUE)])):
                         $rootdir = $ds=  '';
                 else:
                         $rootdir = CF_SYSTEM; $ds = DS;
                 endif;
             $path = ltrim(self::changeCase(str_replace(array('\\','>','.'),DS,
                                                                                           self::$_classnames[self::changeCase($_classnames['\\'.$classname],TRUE)])).EXT,'/');
            $includepath = getcwd().$ds.$rootdir.$path;

                     if(is_readable($includepath)):
                             return include_once $includepath;
                     else:
                         trigger_error("Requested class $classname not found!!");
                     endif;
          else:
                $callee = debug_backtrace();
                trigger_error("Error occured while loading class $classname", E_USER_WARNING);
          endif;


    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        $class = $root_dir = $library_path = "";
        if(!array_key_exists(ucfirst($key),self::$_classnames))
            trigger_error("Requested $class Library not exists !!");

        $class = self::$_classnames[ucfirst($key)];

            if(preg_match("/Apps/i", $class)):
                 $root_dir = $ds=  '';
             else:
                 $root_dir = CF_SYSTEM;
                 $ds = DS;
             endif;

        $library_path = getcwd().DS.$root_dir.strtolower(str_replace(array('\\','.','>'),DS,$class)).EXT;

             if(is_readable($library_path) && class_exists($class)):
                  if(!isset(self::$instance[$class]))
                     self::$instance[$class] = new $class;
                  return self::$instance[$class]; //You cannot pass parameters to constructor of the class
            else:
                 trigger_error("Requested class not available on $library_path");
            endif;
    }

    /*
    * Call magic method to register classes and models dynamically into cygnite engine
    * @param $name method name
    * @args    $args   array passed into the method
    */
    public function __call($name, $args)
    {
          if($name == 'registerClasses' || $name == 'registerModels')
                 call_user_func_array(array($this,'setClasses'),$args);
          else
                trigger_error("Invalid method $name",E_USER_WARNING);
    }

   /**
    * ----------------------------------------------------------
    * Set classes dynamically
    * ----------------------------------------------------------
    * Set classes dynamically to Robot engine
    *
    *@param $args unknown
    *@return void
    *
    */
    function setClasses($args)
    {
         switch ($args) :
            case is_array($args):
                    foreach($args as $key =>$value):
                       self::$_classnames[self::changeCase($key,TRUE)] = $value;
                    endforeach;
                break;
            default:
                    self::$_classnames[self::changeCase(@$args[0],TRUE)] = @$args[1];
                break;
         endswitch;
    }


        /**
         * ------------------------------------------------------------------------------------------
         * Import application files
         * -----------------------------------------------------------------------------------------
         *
         * This method is used to import application and system helpers and plugins.
         *
         * @param $path
         * @throws Exception
         * @return bool
         */
          public static function  import($path)
          {
             $directory_path = "";
             if(is_null($path) || $path == "")
                 trigger_error("Empty path passed on ".__METHOD__);
              $directory_path = getcwd().DS.str_replace(array('>','.'),DS,$path).EXT;

            if(is_readable($directory_path) && file_exists($directory_path)):
                       return include_once $directory_path;
            else:
                     echo  '<pre>';print_r(debug_print_backtrace()); echo'</pre>';
                    trigger_error ("Requested file doesn't exist in following path $directory_path ".__METHOD__,E_USER_WARNING);
            endif;
         }

        /**
         * ----------------------------------------------------------
         * Request a object of the class
         * ----------------------------------------------------------
         * This method is used to request classes from
         * Cygnite Engine and  return library object
         *
         * @param $key string
         * @param $val NULL
         * @throws \Exception
         * @return object
         */
        public function request($key,$val=NULL)
        {
            $class = $library_path = "";
            if(!array_key_exists(ucfirst($key),self::$_classnames))
                trigger_error("Requested $class library doesn't  exists !!");

            $class = self::$_classnames[ucfirst($key)];
            $library_path = getcwd().DS.CF_SYSTEM.strtolower(str_replace(array('\\','.','>'),DS,$class)).EXT;

                if(is_readable($library_path) && class_exists($class)):
                      if(!isset(self::$instance[$class]))
                         self::$instance[$class] = new $class($val);
                      return self::$instance[$class]; // You cannot pass parameters to constructor of the class
                else:
                    echo  '<pre>';print_r(debug_print_backtrace()); echo'</pre>';
                     trigger_error("Requested class not available on $library_path");
                endif;
        }


      /**
        * ------------------------------------------------------------------------------------------
        * Get all loaded classes
        * -----------------------------------------------------------------------------------------
        * This method is used to return all registered class names from cygnite robot
        *@return array
        */
        public function registeredClasses()
        {
            return self::$_classnames;
        }

        /**
         * ------------------------------------------------------------------------------------------
         * Load models and return model object
         * -----------------------------------------------------------------------------------------
         * This method is used to load all models dynamically and return model object
         *
         * @param $key string
         * @param $val string
         * @throws Exception
         * @return object
         */
         public function model($key,$val=NULL)
        {
             $class = $library_path = "";
             $class = ucfirst(trim($key));

             if(!array_key_exists($class,self::$_classnames))
                 trigger_error("Requested $class Library not exists !!");

             $library_path = strtolower(APPPATH).DS.'models'.DS;
             if(is_readable($library_path) && class_exists($class))
                 return new $class();
             else
                 trigger_error("Path not readable $library_path");
        }
    }