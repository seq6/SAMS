<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     servetype表
*/

class Servetype_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'servetype';
    }

    public function get_servetype()
    {
    	return $this->get_item(null, 0, 0, true);
    }
}