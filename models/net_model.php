<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     net表
*/

class Net_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'net';
    }

    public function get_net($id = 0)
    {
        return $this->get_item(array('id' => $id));
    }

    public function get_nets($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function add_net($pid = 0, $name = '', $theDesc = '', $tp = '')
    {
        $newNet = array('pid'     => $pid,
                        'name'    => $name,
                        'theDesc' => $theDesc,
                        'tp'      => $tp);
        return $this->add_item($newNet);
    }

    public function del_net($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_net($id = 0, $pid = 0, $name = '', $theDesc = '', $tp = '')
    {
        $newNet = array('pid'     => $pid,
                        'name'    => $name,
                        'theDesc' => $theDesc,
                        'tp'      => $tp);
        return $this->add_item(array('id' => $id), $newNet);
    }
}
