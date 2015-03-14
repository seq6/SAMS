<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     party表
*/

class party_Model extends base_Model
{
    private $table;

    public function __construct()
    {
        $this->table = 'party';
    }
}

?>
