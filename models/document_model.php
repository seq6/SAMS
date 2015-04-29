<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     document表
*/

class Document_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'document';
    }

    public function get_dom($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_doms($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function get_all_doms($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_doms_count($pid = 0)
    {
        return $this->get_count(array('pid' => $pid));
    }

    public function add_dom($pid = 0, $assetid = '', $dType = '', $name = '', $theDesc = '',$import = 1)
    {
        $newDom = array(    'pid'    => $pid,
                            'assetid'=> $assetid,
                            'dType'  => $dType,
                            'name'   => $name,
                            'theDesc'=> $theDesc,
                            'import' => $import);
        return $this->add_item($newDom);
    }

    public function del_dom($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_dom($id = 0, $pid = 0, $assetid = '', $dType = '', $name = '', $theDesc = '', $import = 0)
    {
        $newDom = array(    'pid'    => $pid,
                            'assetid'=> $assetid,
                            'dType'  => $dType,
                            'name'   => $name,
                            'theDesc'=> $theDesc,
                            'import' => $import);
        return $this->update_item(array('id' => $id), $newDom);
    }
}