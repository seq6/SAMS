<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     pjRange表
*/

class PjRange_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'pjRange';
    }

    public function get_range()
    {
        return $this->get_item(null, 0, 0, true);
    }
}