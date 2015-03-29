<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     person表
*/

class Person_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'person';
    }
}

?>
