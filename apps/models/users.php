<?php
namespace Apps\Models;

use Cygnite\Cygnite as Cf;
use Cygnite\Sparker\CF_BaseModel as CF_BaseModel;

    class Users extends CF_BaseModel
    {
        private $table = 'users';

        function __construct()
        {
              parent::__construct('hris');
        }

        public function get_table()
        {
            return $this->table;
        }

         public function get()
        {
             return $this->prepare_query("SELECT * FROM hs_hr_employee")->fetchAll( \PDO::FETCH_ASSOC);
        }

        public function get_columns()
        {
              return 'id,username,email,phone_number,';
        }


    }