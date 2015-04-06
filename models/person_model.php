<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     person表
*/

class Person_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'person';
    }

    public function get_person($id = 0)
    {
        return $this->get_item(array('id' => $id));
    }

    public function get_persons($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function add_person($pid = 0, $name = '', $sex = '', $pos = '', $depart = '', $phone = '', $mobile = '', $email = '', $Igrade = 0)
    {
        $newPerson = array( 'pid'    => $pid,
                            'name'   => $name,
                            'sex'    => $sex,
                            'pos'    => $pos,
                            'depart' => $depart,
                            'phone'  => $phone,
                            'mobile' => $mobile,
                            'email'  => $email,
                            'Igrade' => $Igrade);
        return $this->add_item($newPerson);
    }

    public function del_person($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_person($id = 0, $pid = 0, $name = '', $sex = '', $pos = '', $depart = '', $phone = '', $mobile = '', $email = '', $Igrade = 0)
    {
        $newData = array( 'pid'    => $pid,
                          'name'   => $name,
                          'sex'    => $sex,
                          'pos'    => $pos,
                          'depart' => $depart,
                          'phone'  => $phone,
                          'mobile' => $mobile,
                          'email'  => $email,
                          'Igrade' => $Igrade);
        return $this->add_item(array('id' => $id), $newData);
    }
}

?>
