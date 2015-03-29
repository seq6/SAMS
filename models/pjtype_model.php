<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     pjType表
*/

class PjType_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'pjType';
    }
}

?>
