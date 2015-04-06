<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     business表
*/

class Business_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'business';
    }

    public function get_busin($id = 0)
    {
        return $this->get_item(array('id' => $id));
    }

    public function get_busins($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function add_busin($pid = 0, $name = '', $theDesc = '')
    {
        $newBusin = array(  'pid' => $pid,
                            'name' => $name,
                            'theDesc' => $theDesc);
        return $this->add_item($newBusin);
    }

    public function delete_busin($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_busin($id = 0, $pid = 0, $name = '', $theDesc = '')
    {
        $newBusin = array(  'pid' => $pid,
                            'name' => $name,
                            'theDesc' => $theDesc);
        return $this->update_item(array('id' => $id), $newBusin);
    }
}
