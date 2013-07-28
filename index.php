<?PHP
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
 * @Package                          : Cygnite Framework
 *@Filename                         : index.php
 *@Description                    : This index file is entry point of the framework to define framework base paths.
 *@Author                            : Cygnite Dev Team
 *@Copyright                     :  Copyright (c) 2013 - 2014,
 *@Link	                  		    :  http://www.cygniteframework.com
 *@Since	                           :  Version 1.0
 *@Filesource
 *@Warning                   :  Any changes in this library can cause abnormal behaviour of the framework
 *
 *
 */

  /*---------------------------------------------------------------
    * Define Directory Separator
    *---------------------------------------------------------------
    */
    define('DS',DIRECTORY_SEPARATOR);

     /* -------------------------------------------------------------------
    *  Define PHP file extension
    * -------------------------------------------------------------------
    */
    defined('EXT') OR define('EXT', '.php');

  /* -------------------------------------------------------------------
    *  Now that we know the path, set the main path constants.
   *   Path to the packages folder
    * -------------------------------------------------------------------
    */
     defined('CF_SYSTEM') OR define('CF_SYSTEM', 'packages');

  /* -------------------------------------------------------------------
    *  Define application folder name
    * -------------------------------------------------------------------
    */
     defined('APPPATH') OR define('APPPATH', 'apps');
    /* -------------------------------------------------------------------
    *  Define root directory name
    * -------------------------------------------------------------------
    */
     $dir =explode(DS,dirname(__FILE__));
     defined('ROOTDIR') OR define('ROOTDIR', rtrim(end($dir)));

     defined('CYGNITE_BASE') OR define('CYGNITE_BASE', dirname(__FILE__));

  /* -------------------------------------------------------------------
    *  Lets start to include default core files
    * -------------------------------------------------------------------
    */
    require_once CF_SYSTEM.DS.'boot'.EXT;