<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     hardware表
*/

class hardware_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'hardware';
    }
}

?>
