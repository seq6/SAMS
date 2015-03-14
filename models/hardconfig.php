<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     hardconfig表
*/

class hardconfig_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'hardconfig';
    }
}

?>
