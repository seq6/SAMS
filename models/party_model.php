<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     party表
*/

class Party_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'party';
    }
}

?>
