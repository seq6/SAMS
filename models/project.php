<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     project表
*/

class project_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'project';
    }
}

?>