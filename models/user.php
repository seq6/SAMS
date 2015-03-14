<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     user表
*/

class user extends base_Model
{
    function __construct()
    {
        $this->table = 'user';
    }
}

?>