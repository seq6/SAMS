<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     environment表
*/

class Environment_model extends Base_model
{
    function __construct()
    {
        $this->table = 'environment';
    }
}

?>
