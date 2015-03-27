<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     project表
*/

class Project_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'project';
    }

    public function get($conds = null, $limit = 10, $offset = 0)
    {
        return $this->get_item($conds, $limit, $offset);
    }

    public function add($pName = '')
    {
        $newData = array('name' => $pName, 'status' => 0);
        return $this->add_item($newData);
    }

    public function del($pid = 0)
    {
        if ($pid <= 0 || !is_int($pid)) {
            return FALSE;
        }
        else {
            $conds = array('id' => $pid);
            return $this->delete_item($conds);
        }
    }

    public function update($pid, $newData)
    {
        return $this->update_item(array('id' => $pid), $newData);
    }

    public function get_project_count($conds = null)
    {
        return $this->get_count($conds);
    }
}

?>