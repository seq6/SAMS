<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     position表
*/

class Position_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'position';
    }

    public function get_position()
    {
    	return $this->get_item(null, 0, 0, true);
    }
}
