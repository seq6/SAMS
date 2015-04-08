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

    public function get_projetc($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        return $res[0];
    }

    public function get_projetcs($conds = null, $limit = 10, $offset = 0)
    {
        return $this->get_item($conds, $limit, $offset);
    }

    public function add_projetc($pName = '')
    {
        $newData = array('name' => $pName, 'status' => 0);
        return $this->add_item($newData);
    }

    public function del_projetc($pid = 0)
    {
        if ($pid <= 0 || !is_int($pid)) {
            return false;
        }
        else {
            $conds = array('id' => $pid);
            return $this->delete_item($conds);
        }
    }

    public function update_projetc($pid, $newData)
    {
        return $this->update_item(array('id' => $pid), $newData);
    }

    public function get_project_count($conds = null)
    {
        return $this->get_count($conds);
    }
}

?>