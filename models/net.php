<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     net表
*/

class net_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'net';
    }
}

?>
