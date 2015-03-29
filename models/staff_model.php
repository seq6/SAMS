<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     staff表
*/

class Staff_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'staff';
    }
}

?>