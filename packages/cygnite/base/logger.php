<?php
namespace Cygnite\Base;

use Cygnite\Helpers\Config as Config;
use Cygnite\Helpers\GHelper as GHelper;
/**
 *  Cygnite Framework
 *
 *  An open source application development framework for PHP 5.2x or newer
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
 * @Package                         :  Packages
 * @Sub Packages               :  Base
 * @Filename                       :  CF_Logger
 * @Description                   : This class is used to handle error logs of the cygnite framework
 * @Author                           : Sanjoy Dey
 * @Copyright                     :  Copyright (c) 2013 - 2014,
 * @Link	                  :  http://www.cygniteframework.com
 * @Since	                  :  Version 1.0
 * @Filesource
 * @Warning                     :  Any changes in this library can cause abnormal behaviour of the framework
 * @example usage        : AppLogger::write_error_log('Logger Initialized By Sanjay',__FILE__);
 *
 */

class Logger
{
    /**
     * @var string
     */
    protected static $log_date_format =  'Y-m-d H:i:s';
    /**
     * @var null
     */
    protected static $file_name = NULL;
    /**
     * @var null
     */
    protected static $fp = NULL;
    /**
     * @var
     */
    protected static $log_path;
    /**
     * @var
     */
    protected static $filesize;
    /**
     * @var string
     */
    protected static $log_ext = ".log";
    /**
     * @var array
     */
    protected static $config = array();
    /**
     * @var string
     */
    public static $log_errors = '';

    /**
     *
     */
    public function __construct()   { }

    /**
     *
     */
    private static function get_log_config()
      {
                $logpath = "";
                if(empty(self::$config))
                     $logpath =  Config::getconfig('global_config','logpath');

                if($logpath !="" || $logpath !==NULL)
                         self::$log_path  = APPPATH.DS.str_replace('.',DS,$logpath).DS;
                else
                        self::$log_path  = APPPATH.DS.'temp'.DS.'logs'.DS;

                self::$file_name  = (Config::getconfig('global_config','log_file_name') !="") ? Config::getconfig('global_config','log_file_name')  : 'cf_error_logs';
      }

    /**
     *
     */
    public static function read()
      {
           // var_dump( self::$config);
      }

    /**
     * @param $filepath
     */
    private static function open($filepath)
      {
              self::$fp = fopen($filepath, 'a') OR exit("Can't open log file ".self::$file_name.self::$log_ext."!");
      }

    /**
     * @param string $msg
     * @param        $filename
     * @param string $level
     * @param int    $filesize
     * @return bool
     * @throws \Exception
     */
    public  function write($msg= "",$filename,$level = "log_debug", $filesize = 1)
      {
                $log= $traceType = "";
                 self::get_log_config();

                 $filepath = self::$log_path.self::$file_name.'-'.date('Y-m-d').self::$log_ext;
                self::$filesize = $filesize *(1024*1024); // Megs to bytes
                $log = Config::getconfig('global_config','log_errors');
                $traceType = Config::getconfig('global_config','log_trace_type');

                if($log =='on' && $traceType !==1):
                    return;
                endif;
                if($log =='on'):
                        if($traceType === 1):
                                return self::_write($msg, $filepath,$filename,$level, $filesize = 1);
                         else:
                               throw new \Exception("Log config not set properly in config file. Set log_errors = on and log_trace_type = 2 ");
                        endif;
                endif;

          }

    /**
     * @param        $msg
     * @param        $filepath
     * @param        $filename
     * @param string $level
     * @param int    $filesize
     * @return bool
     */
    static private function _write($msg,$filepath,$filename,$level = "debug", $filesize = 1)
          {
               if (!is_resource(self::$fp))
                        self::open($filepath);

                /* if (file_exists($filepath)):
                        if (filesize($filepath) > self::$filesize):
                                self::$fp = fopen($filepath, 'w') or die("can't open file file!");
                                fclose(self::$fp);
                                unlink($filepath);
                       endif;
                   endif; */

                switch ($level):
                            case 'debug':
                                        $level = "LOG DEBUG :";
                                break;
                           case 'info':
                                        $level = "LOG INFO : ";
                                break;
                          case 'warning':
                                        $level = "LOG WARNING : ";
                                break;
                  endswitch;
                 $msg = $level."  [".date('Y-m-d H:i:s')."] -> [File:  $filename ] ->  $msg".PHP_EOL;// write current time, file name and log msg to the log file

                flock(self::$fp, LOCK_EX);
                fwrite(self::$fp, $msg);
                flock(self::$fp, LOCK_UN);
                fclose(self::$fp);

                @chmod($filepath,FILE_WRITE_MODE);
                return TRUE;
          }
}