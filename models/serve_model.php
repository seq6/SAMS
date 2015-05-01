<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     serve表
*/

class Serve_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'serve';
    }

    public function get_sever($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_severs($pid = 0, $limit = 10, $offset = 0, $severtype = 0)
    {
        if ($severtype == 0) {
            return $this->get_item(array('pid' => $pid), $limit, $offset);
        }
        else {
            return $this->get_item(array('pid' => $pid, 'kid' => $severtype), $limit, $offset);
        }
    }

    public function get_all_severs($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_severs_count($pid = 0, $severtype = 0)
    {
        if ($severtype == 0) {
            return $this->get_count(array('pid' => $pid));
        }
        else {
            return $this->get_count(array('pid' => $pid, 'kid' => $severtype));
        }
    }

    public function add_sever($pid = 0, $assetid = '', $kid = 1, $name = '', $unit = '', $content = '', $way = 1, $device = '', $remarks = '', $import = '')
    {
        $newsever = array(  'pid'    => $pid,
                            'assetid'=> $assetid,
                            'kid'    => $kid,
                            'name'   => $name,
                            'unit'   => $unit,
                            'content'=> $content,
                            'way'    => $way,
                            'device' => $device,
                            'remarks'=> $remarks,
                            'import' => $import);
        return $this->add_item($newsever);
    }

    public function del_sever($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_sever($id = 0, $pid = 0, $assetid = '', $kid = 1, $name = '', $unit = '', $content = '', $way = 1, $device = '', $remarks = '', $import = '')
    {
        $newsever = array(  'pid'    => $pid,
                            'assetid'=> $assetid,
                            'kid'    => $kid,
                            'name'   => $name,
                            'unit'   => $unit,
                            'content'=> $content,
                            'way'    => $way,
                            'device' => $device,
                            'remarks'=> $remarks,
                            'import' => $import);
        return $this->update_item(array('id' => $id), $newsever);
    }
}