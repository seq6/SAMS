<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     softtype表
*/

class Softtype_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'softtype';
    }

    public function get_softtype()
    {
    	return $this->get_item(null, 0, 0, true);
    }
}