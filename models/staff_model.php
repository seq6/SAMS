<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     staff表
*/

class Staff_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'staff';
    }

    public function get_staff($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_staffs($pid = 0, $limit = 1, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function get_all_staffs($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_staffs_count($pid = 0)
    {
        return $this->get_count(array('pid' => $pid));
    }

    public function add_staff($pid = 0, $partid = 0, $name = '', $sex = 0, $phone = '', $mobile = '', $email = '', $posid = 0)
    {
        $newData = array(   'pid'    => $pid,
                            'partid' => $partid,
                            'name'   => $name,
                            'sex'    => $sex,
                            'pid'    => $pid,
                            'phone'  => $phone,
                            'mobile' => $mobile,
                            'email'  => $email,
                            'posid'  => $posid);
        return $this->add_item($newData);
    }

    public function del_staff($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_staff($id = 0, $pid = 0, $partid = 0, $name = '', $sex = 0, $phone = '', $mobile = '', $email = '', $posid = 0)
    {
        $newData = array(   'pid'    => $pid,
                            'partid' => $partid,
                            'name'   => $name,
                            'sex'    => $sex,
                            'pid'    => $pid,
                            'phone'  => $phone,
                            'mobile' => $mobile,
                            'email'  => $email,
                            'posid'  => $posid);
        return $this->update_item(array('id' => $id), $newData);
    }
}
