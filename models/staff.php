<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     staff表
*/

class staff_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'staff';
    }
}

?>