<?php
namespace Cygnite\Base;

use Cygnite\Helpers\GHelper as GHelper;
use Cygnite\Helpers\Config as Config;

class Dispatcher
{
  /**
   * The name of the entry page
   * @var string
   */
    static private $index_page = 'index.php';

    private $router;
  /**
   * Define the router variable. default value set as FALSE
   * @var bool
   */
    static private  $router_enabled = FALSE;

    private $default = array();

    private $routes=NULL;

    public function __construct($route)
    {
        $this->router = $route;
        $this->default['controller'] = lcfirst(Config::getconfig('global_config','default_controller'));
        $this->default['action'] = lcfirst(Config::getconfig('global_config','default_method'));
        \Cygnite\Cygnite::loader()->logger->write(__CLASS__.' Initialized',__FILE__,'debug');
        $this->handle();

    }

    private function  matches( $routes , $quitAfterRun = false)
     {
           $uri = $this->router->current_uri();
           // Counter to keep track of the number of routes we've handled
            $numHandled = 0;
         foreach ($routes as $route=>$val) {

                    // we have a match!
                    if (preg_match_all('#^' . $route . '$#', $uri, $matches, PREG_SET_ORDER)) {

                            // Extract the matched URL parameters (and only the parameters)
                            $params = array_map(function($match) {
                                    $var = explode('/', trim($match, '/'));
                                    return isset($var[0]) ? $var[0] : null;
                            }, array_slice($matches[0], 1));

                            // call the handling function with the URL parameters
                            //call_user_func_array($route['fn'], $params);
                            $router_arr['controlpath'] = $val;
                            $router_arr['params'] = $params;
                            // yay!
                            $numHandled++;

                            // If we need to quit, then quit
                            if ($quitAfterRun) break;
                             return $router_arr;

                    }

            }
     }

    public function handle()
    {
        if($this->router->current_uri() =='/' ||  $this->router->current_uri() == '/'.self::$index_page):
                    if($this->default['controller'] !=''):
                            include APPPATH.DS.'controllers'.DS.$this->default['controller'].EXT;
                           $defaultController = ucfirst(APPPATH).'\\Controllers\\'.ucfirst($this->default['controller']);
                            $defaultAction = 'action_'.$this->default['action'];
                    endif;
                        $callee = debug_backtrace();
                     if( FALSE!== class_exists($defaultController)):
                            // Static route: / (Default Home Page)
                            $this->router->get('/',call_user_func_array(array(new $defaultController,$defaultAction),$param_arr = array()));
                    else:
                          GHelper::trace();
                          GHelper::showErrors(E_USER_ERROR, '404 Page',
                          "Controller $exp[1] not found ! ",$callee[0]['file'],$callee[0]['line'],TRUE);
                   endif;
        else:
                   $routeConfig = Config::getconfig('routing_config');
                   $newurl = str_replace('/index.php','', rtrim($this->router->current_uri()));

                   $exp= array_filter(explode('/',$newurl));
                   $matched_url = $this->matches($routeConfig);

                            if(!is_null($matched_url)) :
                                    $requesturi = preg_split('/[\.\ ]/', $matched_url['controlpath']);
                                     $controller = ucfirst(APPPATH).'\\Controllers\\'.ucfirst($requesturi[0]);
                                     $action = 'action_'.strtolower($requesturi[1]);
                                     include APPPATH.DS.'controllers'.DS.$requesturi[0].EXT;
                                     call_user_func_array(array(new $controller,$action), (array)$matched_url['params']);
                             else:
                                               $controller = ucfirst(APPPATH).'\\Controllers\\'.ucfirst($exp[1]);
                                               $includepath = strtolower(APPPATH).DS.'controllers'.DS.strtolower($exp[1]).EXT;
                                              $callee = debug_backtrace();
                                              if(is_readable($includepath)):
                                                    include APPPATH.DS.'controllers'.DS.strtolower($exp[1]).EXT;
                                              else:
                                                      GHelper::trace();
                                                      GHelper::showErrors(E_USER_ERROR, 'Unhandled Exception (404 Page)',
                                                      "Controller $exp[1] not found ! ",$callee[0]['file'],$callee[0]['line'],TRUE);
                                              endif;

                                              $action = 'action_'.strtolower((is_null($exp[2])) ? $this->default['action'] : $exp[2]);
                                              $instance =new $controller();
                                             if(!method_exists($instance, $action)):
                                                      GHelper::trace();
                                                      GHelper::showErrors(E_USER_ERROR, 'Unhandled Exception',
                                                      "Requested action $exp[2] not found ! ",$callee[0]['file'],$callee[0]['line'],TRUE);
                                            endif;

                                           $params = array_slice($exp,2);
                                           call_user_func_array(array($instance,$action),(array)$params);
                         endif;
        endif;
    }
    
   public  function __destruct()
    {
        $this->router->run();
    }

}//End of the class