<?php
namespace Sys;

class Autoloader
{

    static private $coreClasses = array(
                                    'Second'=>'\\Sys\\Core\\Second',
                                    'Third'=>'\\Sys\\Libs\\Third',
                                    'Assets'=>'\\Sys\\Helpers\\Assets',
                                    'Loader'=>'\\Sys\\Load\\Loader',


    );

    static private $instance = array();


    private function __construct() { }

    protected function init()
    {
        spl_autoload_register(array($this, 'load'));
    }

    static private function changeCase($string,$islower=FALSE)
    {
        return ($islower===FALSE) ? strtolower($string): ucfirst($string);
    }

    static function load($classname)
    {
       // if (isset(static::$aliases[$class]))
          // return class_alias(static::$aliases[$class], $class);

        $coreclasses = array_flip(self::$coreClasses);
      //  echo self::changeCase($coreclasses['\\'.$classname],TRUE);
        if(array_key_exists($coreclasses['\\'.self::changeCase($classname,TRUE)], self::$coreClasses)){
            echo "<br>-------------------".self::changeCase(str_replace(array('\\','>','.'),DS,self::$coreClasses[self::changeCase($coreclasses['\\'.$classname],TRUE)]))."---------------------<br>";
         echo   $path = ltrim(self::changeCase(str_replace(array('\\','>','.'),DS,self::$coreClasses[self::changeCase($coreclasses['\\'.$classname],TRUE)])).EXT,'/');

           echo  $includepath = getcwd().DS.SYSTEMPATH.$path;
             if(is_readable($includepath))
                 return include $includepath;
             else
                 throw new Exception("Requested class $classname not found!!");
        }


    }

    public function __get($key)
    {
       $object = NULL;

       echo "<br>".self::$coreClasses[ucfirst($key)]."<br>";
       echo $key;
       if(!isset(self::$instance[ucfirst($key)]))
          self::$instance[ucfirst($key)] = new self::$coreClasses[ucfirst($key)];

       return self::$instance[ucfirst($key)];
    }

    public function __call($name, $args)
    {
          if($name == 'registerClasses' || $name == 'registerModels')
              call_user_func_array(array($this,'setClasses'),$args);
          else
              trigger_error("Invalid method $name",E_USER_WARNING);
    }

    function setClasses($args)
    {
         switch ($args) :
            case is_array($args):
                    foreach($args as $key =>$value):
                       self::$coreClasses[self::changeCase($key,TRUE)] = $value;
                    endforeach;

                break;
            default:
                    self::$coreClasses[self::changeCase($args[0],TRUE)] = $args[1];
                break;
         endswitch;
    }

    static function registerNamespace()
    {

    }

    static function registeredPaths()
    {

    }
}
