<?php
    class Users extends CF_BaseModel
    {
        private $table = 'users';

        function __construct()
        {
              parent::__construct('cygnite');
        }

        public function get_table()
        {
            return $this->table;
        }

        public function get_columns()
        {
              return 'id,username,email,phone_number,';
        }


    }