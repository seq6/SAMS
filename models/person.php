<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     person表
*/

class person_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'person';
    }
}

?>
