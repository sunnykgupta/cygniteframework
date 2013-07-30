<?php
namespace Cygnite\Libraries\Cache\Storage;

use Cygnite\Helpers\Config as Config;

if ( ! defined('CF_SYSTEM')) exit('External script access not allowed');
/**
 *  Cygnite Framework
 *
 *  An open source application development framework for PHP 5.2x or newer
 *
 *   License
 *
 *   This source file is subject to the MIT license that is bundled
 *   with this package in the file LICENSE.txt.
 *    http://www.cygniteframework.com/license.txt
 *   If you did not receive a copy of the license and are unable to
 *   obtain it through the world-wide-web, please send an email
 *   to sanjoy@hotmail.com so I can send you a copy immediately.
 *
 * @Package                         : Library - Cache
 *@Filename                         : CF_Apc_Driver.php
 * @Description                    : This driver library is used to store , retrive and destroy data from apc memory.
     *                                           Use of this library is to boost up application performance.
 *                                               This library required abstract storage class to implement APC Cache.
 * @Author                           : Sanjoy Dey
 * @Copyright                     :  Copyright (c) 2013 - 2014,
 * @Link	                  :  http://www.cygniteframework.com
 * @Since	                  :  Version 1.0
 * @Filesource
 * @Warning                      :  Any changes in this library can cause abnormal behaviour of the framework
 *
 *
 */

    /**
     * @require Abstract storage class to implement APC Cache
     */
    class Apc extends IMemoryStorage
    {

                private $life_time = NULL; // default life time

                private $default_time = 600; //default time is set 600

                var $is_enable = FALSE;   // is apc enabled

                var $option = FALSE; // flag set false

                /*
                * Constructor function to check availability of apc, throw exception if not available
                *
                */
                public function __construct()
                {
                      if(extension_loaded('apc')):
                            $this->is_enable = TRUE;
                            \Cygnite\Cygnite::loader()->logger->write(__CLASS__.' Initialized',__FILE__,'debug');
                      else:
                            throw new Exception("Apc extension not loaded properly !") ;
                      endif;
                }
                /*
                * Prevent cloning
                */
                final private function __clone() {}
                /*
                * This function is used to set default life time
                * @param $default_life_time NULL
                *@return  boolean
                */
                public function set_life_time($default_life_time = "")
                {
                     $this->life_time = ($default_life_time == "" || is_null($default_life_time)) ? $this->default_time : $default_life_time;
                     return TRUE;
                }
                  /*
                * This function is used to get life time of apc cache
                *@return  boolean
                */
                public function get_life_time()
                {
                        return (!is_null($this->life_time)) ? $this->life_time : $this->default_time;
                }

                private function store($key,$value) { }
                /*
                * Call the function to save data into apc memory
                * @param name key
                * @param args value to be stored
                */
                public function __call($name, $args)
                {
                   return call_user_func_array(array($this,'save'), $args);
                }
                /**
                * Store the value in theapc memory
                *
                * @param string $key
                * @param mix $value
                * @return bool
                */
                protected function save($key,$value)
                {
                    if(is_null($key) || $key == "")
                        throw new Exception ("Empty key passed ".__FUNCTION__);
                    if(is_null($value) || $value == "")
                        throw new Exception ("Empty value passed ".__FUNCTION__);

                    return (apc_store($key,$value , $this->get_life_time())) ? TRUE : FALSE;
                }
                /**
                * Get data from memory based on its key
                *
                * @param string $key
                * @return bool
                */
                public function get_data($key)
                {
                    $result = apc_fetch($key, $this->option);
                    return ($this->option) ? $result : NULL;
                }
                /**
                * Delete values from memory based on its key
                *
                * @param string $key
                * @return bool
                */
                public function destroy($key)
                {
                    if(is_null($key) || $key == "")
                        throw new Exception ("Empty key passed ".__FUNCTION__);

                        apc_fetch($key, $this->option);
                    return ($this->option) ? apc_delete($key) : TRUE;
                }
                /*
                * Destructor function
                */
                public function __destruct()  {}

    }