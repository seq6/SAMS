<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     project表
*/

class Project_model extends Base_model
{
    function __construct()
    {
        $this->table = 'project';
    }

    public function get($limit = 10, $offset = 0)
    {
        $res = array();
        $res['count'] = $this->get_count();
        $res['data'] = $this->get_item(null, $limit, $offset);
        return $res;
    }

    public function add($pName = '')
    {
        $newData = array('name' => $pName, 'status' => 0);
        return $this->add_item($newData);
    }

    public function del($pid = 0)
    {
        $conds = array('id' => $pid);
        return $this->delete_item($conds);
    }

    public function update($pid, $newData)
    {
        return $this->update_item(array('id' => $pid), $newData);
    }
}

?>