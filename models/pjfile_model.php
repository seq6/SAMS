<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     pjFile表
*/

class pjFile_model extends Base_model
{
    private $dataPath;

    function __construct()
    {
        parent::__construct();

        $this->table = 'pjFile';

        $this->dataPath = '/usr/share/nginx/html/';
    }

    public function get_pjfile($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    public function get_pjfiles($pid = 0, $limit = 1, $offset = 0)
    {
    	return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    public function get_all_pjfiles($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    public function get_pjfile_count($pid = 0)
    {
        return $this->get_count(array('pid' => $pid));
    }

    public function add_pjfile($pid = 0, $name = '', $members = '', $place = '', $starttime = '', $endtime = '', $file = '')
    {
        if (!$this->store_file($file, $name)) {
            return false;
        }

        $fileType = $file['type'];
        $fileMD5 = md5_file($file['tmp_name']);
        $newData = array(   'pid'      => $pid,
                            'name'     => $name,
                            'members'  => $members,
                            'place'    => $place,
                            'starttime'=> $starttime,
                            'endtime'  => $endtime,
                            'fileType' => $fileType,
                            'fileMD5'  => $fileMD5);
        return $this->add_item($newData);
    }

    public function update_pjfile($id = 0, $name = '', $members = '', $place = '', $starttime = '', $endtime = '', $file = '')
    {
        if ($file != '' && $file['error'] == UPLOAD_ERR_OK) {
            $this->delete_file($id);
            if (!$this->store_file($file, $name)) {
                return false;
            }
        }

        $fileType = $file['type'];
        $fileMD5 = md5_file($file['tmp_name']);
        $newData = array(   'pid'      => $pid,
                            'name'     => $name,
                            'members'  => $members,
                            'place'    => $place,
                            'starttime'=> $starttime,
                            'endtime'  => $endtime,
                            'fileType' => $fileType,
                            'fileMD5'  => $fileMD5);

        return $this->update_item(array('id' => $id), $newData);
    }

    public function del_pjfile($id = 0)
    {
        $this->delete_file($id);
        return $this->delete_item(array('id' => $id));
    }

    private function delete_file($id = 0)
    {
        $file = $this->get_pjfile($id);
        $filePath = $this->dataPath.'data/'.$file['pid'].'/'.$file['name'].'_'.$file['fileMD5'].'.'.$file['fileType'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private function store_file($file = '', $name = '')
    {
        var_dump($file);
        
        if ($file == '' || $file['error'] != UPLOAD_ERR_OK) {
            return false;
        }
        else {
            try {
                    $pid = $_SESSION['project']['pid'];
                    $fileType = $file['type'];
                    $fileMD5 = md5_file($file['tmp_name']);
                    $filePath = $this->dataPath.'data/'.$pid.'/'.$name.'_'.$fileMD5.'.'.$fileType;
                    if (!is_dir('data/'.$pid)) {
                        mkdir('data/'.$pid);
                    }
                    if (file_exists($filePath)) {
                        return false;
                    }
                    rename($file['tmp_name'], $filePath);
                    return true;

            } catch (Exception $e) {
                return false;
            }
        }
    }
}