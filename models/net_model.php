<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     net表
*/

class Net_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'net';
    }
}

?>
