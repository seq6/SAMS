<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     parts表
*/

class Parts_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'parts';
    }

    public function get_part($id = 0)
    {
        if ($id == 0) {
            return false;
        }
        else {
            $res = $this->get_item(array('id' => $id));
            return $res[0];
        }
    }

    public function add_part($pid = 0, $name = '', $address = '', $lead = '', $phone = '', $mobile = '', $email='', $remarks = '')
    {
        $newData = array(   'pid'     => $pid,
                            'name'    => $name,
                            'address' => $address,
                            'lead'    => $lead,
                            'phone'   => $phone,
                            'mobile'  => $mobile,
                            'email'   => $email,
                            'remarks' => $remarks);
        return $this->add_item($newData);
    }

    public function update_part($id = 0, $pid = 0, $name = '', $address = '', $lead = '', $phone = '', $mobile = '', $email='', $remarks = '')
    {
        $newData = array(   'pid'     => $pid,
                            'name'    => $name,
                            'address' => $address,
                            'lead'    => $lead,
                            'phone'   => $phone,
                            'mobile'  => $mobile,
                            'email'   => $email,
                            'remarks' => $remarks);
        return $this->update_item(array('id' => $id), $newData);
    }
}

?>
