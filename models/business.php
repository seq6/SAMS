<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     business表
*/

class business_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'business';
    }
}

?>
