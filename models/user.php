<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     user表
*/

class user_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'user';
    }
}

?>