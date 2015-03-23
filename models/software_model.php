<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     software表
*/

class Software_model extends Base_model
{
    function __construct()
    {
        $this->table = 'software';
    }
}

?>