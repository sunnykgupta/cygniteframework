<?php
namespace Apps\Controllers;

use Cygnite\Cygnite;
use Cygnite\Loader\CF_BaseController;
use Cygnite\Helpers\GHelper;

    class Welcomeuser extends CF_BaseController
    {
      /**
        * --------------------------------------------------------------------------
        * The Default Controller
        *--------------------------------------------------------------------------
        *  This controller respond to uri begining with welcomeuser and also
        *  respond to root url like "welcomeuser/index"
        *
        * Your GET request of "welcomeuser/form" will repond like below -
        *
        *      public function action_form()
        *     {
        *            echo "Cygnite : Hellow ! World ";
        *     }
        * Note: By default cygnite doesn't allow you to pass query string in url, which
        * consider as bad url format.
        *
        * You can also pass parameters into the function as below-
        * Your request to  "welcomeuser/form/2134" will pass to
        *
        *      public function action_form($id = ")
        *      {
        *             echo "Cygnite : Your user Id is $id";
        *      }
        * In case if you are not able to access parameters passed into method
        * directly as above, you can also get the uri segment
        *  echo Url::segment(2);
        *
        * That's it you are ready to start your awesome application with Cygnite Framework.
        *
        */
        public function __construct()
        {
              parent::__construct();
        }

        public function action_index()
        {

            $isAuthenticated = Cygnite::loader()->CFAuthx->identifyUser(new \Apps\Components\Libs\AuthxIdentity(
                                                array(
                                                      'username' => 'sanjay',//post values need to be passed for username or email address field
                                                      'password' =>  'sanjay2123',
                                                     // 'status' => 1 // optional field to check user authentication
                                                     )
                                                )
                                                );

               if($isAuthenticated === TRUE):
                      echo "User Authenticated Successfully";
               else:
                       echo "Not a valid User";
               endif;


        }
  }
