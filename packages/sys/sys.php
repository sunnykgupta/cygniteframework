<?php
namespace Sys;
//use Sys\Core\Second as Se;

function show($val)
{
    echo "<pre>";
    print_r($val);
    echo "</pre>";
}

class Yii extends \Sys\Autoloader
{
    static private $instance;
    
    public function __construct() 
    {
        parent::init();
    }
    
    static public function app()
    {        
        if(is_null(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }        
    
}
Yii::app()->registerClasses(array(
                                 'Fourth'=>'\\Sys\\Libs\\Fourth',
                                 )
        );  
//$t = new \Sys\Libs\Third;
//echo $t->set();

echo Yii::app()->second->set();echo "<br>";
echo Yii::app()->third->set();echo "<br>";
echo Yii::app()->loader->set();echo "<br>";
echo Yii::app()->Fourth->set();echo "<br>";

/*$obj = new \Sys\Load\Loader;
$obj->set(); */