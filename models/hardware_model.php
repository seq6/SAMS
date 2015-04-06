<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     hardware表
*/

class Hardware_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'hardware';
    }

    public function get_hardware($id = 0)
    {
    	return $this->get_item(array('id' => $id));
    }

    public function get_hardwares($pid = 0, $limit = 10, $offset = 0)
    {
    	return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function add_hardware()
    {
    	# code...
    }

    public function del_hardware($id = 0)
    {
		return $this->delete_item(array('id' => $id));
    }

    public function update_hardware()
    {
    	# code...
    }
}
