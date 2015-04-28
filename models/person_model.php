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
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_persons($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function get_all_persons($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_persons_count($pid = 0)
    {
        return $this->get_count(array('pid' => $pid));
    }

    public function add_person($pid = 0, $assetid = '',$name = '', $sex = '', $post = '', $depart = '', $phone = '', $mobile = '', $email = '')
    {
        $newPerson = array( 'pid'    => $pid,
                            'assetid'=> $assetid,
                            'name'   => $name,
                            'sex'    => $sex,
                            'post'   => $post,
                            'depart' => $depart,
                            'phone'  => $phone,
                            'mobile' => $mobile,
                            'email'  => $email);
        return $this->add_item($newPerson);
    }

    public function del_person($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_person($id = 0, $pid = 0, $assetid = '',$name = '', $sex = '', $post = '', $depart = '', $phone = '', $mobile = '', $email = '', $import = 0)
    {
        $newPerson = array( 'pid'    => $pid,
                            'assetid'=> $assetid,
                            'name'   => $name,
                            'sex'    => $sex,
                            'post'   => $post,
                            'depart' => $depart,
                            'phone'  => $phone,
                            'mobile' => $mobile,
                            'email'  => $email,
                            'import' => $import);
        return $this->add_item(array('id' => $id), $newPerson);
    }
}

?>
