<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     software表
*/

class software_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'software';
    }
}

?>