<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     environment表
*/

class environment_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'environment';
    }
}

?>
