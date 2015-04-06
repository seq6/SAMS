<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     environment表
*/

class Environment_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'environment';
    }

    public function get_envir($id = 0)
    {
        return $this->get_item(array('id' => $id));
    }

    public function get_envirs($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function add_envir($pid = 0, $name = '', $info = array(), $theDesc = '')
    {
        $newEnvir = array(  'pid'   => $pid,
                            'name'  => $name,
                            'info'  => json_encode($info),
                            'theDesc' => $theDesc);
        return $this->add_item($newEnvir);
    }

    public function del_envir($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_envir($id = 0, $pid = 0, $name = '', $info = array(), $theDesc = '')
    {
        $newEnvir = array(  'pid'   => $pid,
                            'name'  => $name,
                            'info'  => json_encode($info),
                            'theDesc' => $theDesc);
        return $this->update_item(array('id' => $id), $newEnvir);
    }
}
