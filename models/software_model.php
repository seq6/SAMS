<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     software表
*/

class Software_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'software';
    }

    public function get_software($id = 0)
    {
        return $this->get_item(array('id' => $id));
    }

    public function get_softwares($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function add_software($pid = 0, $name = '', $version = '', $theDesc = '')
    {
        $newData = array(   'pid'     => $pid,
                            'name'    => $name,
                            'version' => $version,
                            'theDesc' => $theDesc);
        return $this->add_item($newData);
    }

    public function del_software($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_software($id = 0, $pid = 0, $name = '', $version = '', $theDesc = '')
    {
        $newData = array(   'pid'     => $pid,
                            'name'    => $name,
                            'version' => $version,
                            'theDesc' => $theDesc);
        return $this->update_item(array('id' => $id), $newData);
    }
}