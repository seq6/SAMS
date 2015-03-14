<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     envirconfig表
*/

class envirconfig_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'envirconfig';
    }
}

?>
