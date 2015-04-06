<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     envirconfig表
*/

class Envirconfig_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'envirconfig';
    }

    public function get_envir_config()
    {
        return $this->get_item(null, 0 , 0, true);
    }
}
