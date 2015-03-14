<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     pjType表
*/

class pjType_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'pjType';
    }
}

?>