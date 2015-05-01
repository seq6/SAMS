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

    public function get_project($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if ($res == false) {
            return false;
        }
        return $res[0];
    }

    public function get_projects($conds = null, $limit = 10, $offset = 0)
    {
        return $this->get_item($conds, $limit, $offset);
    }

    public function add_project($pName = '')
    {
        $newData = array('name' => $pName, 'status' => 0);
        return $this->add_item($newData);
    }

    public function del_project($pid = 0)
    {
        if ($pid <= 0 || !is_int($pid)) {
            return false;
        }
        else {
            $conds = array('id' => $pid);
            return $this->delete_item($conds);
        }
    }

    public function update_project($pid, $newData)
    {
        return $this->update_item(array('id' => $pid), $newData);
    }

    public function get_project_count($conds = null)
    {
        return $this->get_count($conds);
    }

    public function start_project($pid = 0)
    {
        $startTime = date('Y-m-d H:i:s');
        $newData = array('status' => 1, 'starttime' => $startTime);
        return $this->update_item(array('id' => $pid), $newData);
    }

    public function end_project($pid = 0)
    {
        $endTime = date('Y-m-d H:i:s');
        $newData = array('status' => 2, 'endtime' => $endTime);
        return $this->update_item(array('id' => $pid), $newData);
    }
}
