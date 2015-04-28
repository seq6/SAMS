<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     hardtype表
*/

class Hardtype_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'hardtype';
    }

    public function get_hardtype()
    {
    	return $this->get_item(null, 0, 0, true);
    }
}