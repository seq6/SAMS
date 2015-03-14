<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     position表
*/

class position_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'position';
    }
}

?>