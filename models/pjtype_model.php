<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     pjType表
*/

class PjType_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'pjType';
    }

    public function get_type()
    {
        return $this->get_item(null, 0, 0, true);
    }

    public function get_type_byid($id = '')
    {
        $types = $this->get_item(null, 0, 0, true);
        foreach ($types as $t) {
            if ($t['id'] == $id) {
                return $t;
            }
        }
        return false;
    }
}
