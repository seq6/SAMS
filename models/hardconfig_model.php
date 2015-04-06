<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     hardconfig表
*/

class Hardconfig_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'hardconfig';
    }

    public function get_hard_config()
    {
    	return $this->get_item(null, 0, 0, true);
    }
}
