<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     software表
*/

class Software_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'software';
    }

    public function get_software($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_softwares($pid = 0, $limit = 10, $offset = 0, $softtype = 0)
    {
        if ($softtype == 0) {
            return $this->get_item(array('pid' => $pid), $limit, $offset);
        }
        else {
            return $this->get_item(array('pid' => $pid, 'kid' => $softtype), $limit, $offset);
        }
    }

    public function get_all_softwares($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_softwares_count($pid = 0, $softtype = 0)
    {
        if ($softtype == 0) {
            return $this->get_count(array('pid' => $pid));
        }
        else {
            return $this->get_count(array('pid' => $pid, 'kid' => $softtype));
        }
    }

    public function add_software($pid = 0, $assetid = '', $kid = 1, $version = '', $developer = '', $hard = '', $soft = '', $app = '', $model = 1, $datas = '', $userNum = '', $userRole = '', $Cgrade = 1, $Igrade = 1, $Agrade = 1)
    {
        $newSoft = array(   'pid'      => $pid,
                            'assetid'  => $assetid,
                            'kid'      => $kid,
                            'version'  => $version,
                            'developer'=> $developer,
                            'hard'     => $hard,
                            'soft'     => $soft,
                            'app'      => $app,
                            'model'    => $model,
                            'datas'    => $datas,
                            'userNum'  => $userNum,
                            'userRole' => $userRole,
                            'Cgrade'   => $Cgrade,
                            'Igrade'   => $Igrade,
                            'Agrade'   => $Agrade);
        return $this->add_item($newSoft);
    }

    public function del_software($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_software($id = 0, $pid = 0, $assetid = '', $kid = 1, $version = '', $developer = '', $hard = '', $soft = '', $app = '', $model = 1, $datas = '', $userNum = '', $userRole = '', $Cgrade = 1, $Igrade = 1, $Agrade = 1)
    {
        $newSoft = array(   'pid'      => $pid,
                            'assetid'  => $assetid,
                            'kid'      => $kid,
                            'version'  => $version,
                            'developer'=> $developer,
                            'hard'     => $hard,
                            'soft'     => $soft,
                            'app'      => $app,
                            'model'    => $model,
                            'datas'    => $datas,
                            'userNum'  => $userNum,
                            'userRole' => $userRole,
                            'Cgrade'   => $Cgrade,
                            'Igrade'   => $Igrade,
                            'Agrade'   => $Agrade);
        return $this->update_item(array('id' => $id), $newSoft);
    }
}