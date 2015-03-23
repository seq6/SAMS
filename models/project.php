<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     project表
*/

class project extends base_Model
{
    function __construct()
    {
        $this->table = 'project';
    }

    public function get_project()
    {
        $res = array();
        return $res;
    }
}

?>