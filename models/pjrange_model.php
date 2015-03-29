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
}

?>