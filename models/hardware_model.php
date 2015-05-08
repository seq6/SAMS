<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     hardware表
*/

class Hardware_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'hardware';
    }

    public function get_hardware($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_hardwares($pid = 0, $limit = 10, $offset = 0, $hardtype = 0)
    {
        if ($hardtype == 0) {
            return $this->get_item(array('pid' => $pid), $limit, $offset);
        }
        else {
            return $this->get_item(array('pid' => $pid, 'kid' => $hardtype), $limit, $offset);
        }
    }

    public function get_all_hardwares($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_hardwares_count($pid = 0, $hardtype = 0)
    {
        if ($hardtype == 0) {
            return $this->get_count(array('pid' => $pid));
        }
        else {
            return $this->get_count(array('pid' => $pid, 'kid' => $hardtype));
        }
    }

    public function add_hardware($pid = 0, $assetid = '', $kid = 1, $name = '', $model = '', $place = '', $net = '', $ip = '', $mask = '', $gateway = '', $os = '', $osSoft = '', $portType = '', $portNum = '', $main = '', $datas = '', $ha = 0, $Cgrade = 1, $Igrade = 1, $Agrade = 1)
    {
        $newHard = array(   'pid'     => $pid,
                            'assetid' => $assetid,
                            'kid'     => $kid,
                            'name'    => $name,
                            'model'   => $model,
                            'place'   => $place,
                            'net'     => $net,
                            'ip'      => $ip,
                            'mask'    => $mask,
                            'gateway' => $gateway,
                            'os'      => $os,
                            'osSoft'  => $osSoft,
                            'portType'=> $portType,
                            'portNum' => $portNum,
                            'main'    => $main,
                            'datas'   => $datas,
                            'ha'      => $ha,
                            'Cgrade'  => $Cgrade,
                            'Igrade'  => $Igrade,
                            'Agrade'  => $Agrade);
        return $this->add_item($newHard);
    }

    public function del_hardware($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    public function update_hardware($id = 0, $pid = 0, $assetid = '', $kid = 1, $name = '', $model = '', $place = '', $net = '', $ip = '', $mask = '', $gateway = '', $os = '', $osSoft = '', $portType = '', $portNum = '', $main = '', $datas = '', $ha = 0, $Cgrade = 1, $Igrade = 1, $Agrade = 1)
    {
        $newHard = array(   'pid'     => $pid,
                            'assetid' => $assetid,
                            'kid'     => $kid,
                            'name'    => $name,
                            'model'   => $model,
                            'place'   => $place,
                            'net'     => $net,
                            'ip'      => $ip,
                            'mask'    => $mask,
                            'gateway' => $gateway,
                            'os'      => $os,
                            'osSoft'  => $osSoft,
                            'portType'=> $portType,
                            'portNum' => $portNum,
                            'main'    => $main,
                            'datas'   => $datas,
                            'ha'      => $ha,
                            'Cgrade'  => $Cgrade,
                            'Igrade'  => $Igrade,
                            'Agrade'  => $Agrade);
        return $this->update_item(array('id' => $id), $newHard);
    }
}
