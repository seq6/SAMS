<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     elses表
*/

class Elses_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'elses';
    }

    public function get_else($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_elses($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function get_all_elses($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_elses_count($pid = 0)
    {
        return $this->get_count(array('pid' => $pid));
    }

    public function add_else($pid = 0, $assetid = '', $name = '', $theDesc = '', $lib = '')
    {
        $newElse = array(  	'pid'    => $pid,
                            'assetid'=> $assetid,
                            'name'   => $name,
                            'theDesc'=> $theDesc,
                            'lib'	 => $lib);
        return $this->add_item($newElse);
    }

    public function del_else($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_else($id = 0, $pid = 0, $assetid = '', $name = '', $theDesc = '', $lib = '', $import = 0)
    {
        $newElse = array(  	'pid'    => $pid,
                            'assetid'=> $assetid,
                            'name'   => $name,
                            'theDesc'=> $theDesc,
                            'lib'	 => $lib,
                            'import' =. $import);
        return $this->add_item(array('id' => $id), $newDom);
    }
}