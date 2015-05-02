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
        if ($file == '' || $file['error'] != UPLOAD_ERR_OK) {
            return false;
        }

        $tmp = explode('.', $file['name']);
        $fileType = array_pop($tmp);
        $fileMD5 = md5_file($file['tmp_name']);
        $newData = array(   'pid'      => $pid,
                            'name'     => $name,
                            'members'  => $members,
                            'place'    => $place,
                            'starttime'=> $starttime,
                            'endtime'  => $endtime,
                            'fileType' => $fileType,
                            'fileMD5'  => $fileMD5);
        $fid = $this->add_item($newData);

        if ($fid == false) {
            return false;
        }

        return $this->store_file($file, $name, $fid, $fileType);
    }

    public function update_pjfile($id = 0, $name = '', $members = '', $place = '', $starttime = '', $endtime = '', $file = '')
    {
        $pid = $_SESSION['project']['pid'];
        $newData = array(   'pid'      => $pid,
                            'name'     => $name,
                            'members'  => $members,
                            'place'    => $place,
                            'starttime'=> $starttime,
                            'endtime'  => $endtime);

        if ($file != '' && $file['error'] == UPLOAD_ERR_OK) {
            $this->delete_file($id);
            $tmp = explode('.', $file['name']);
            $fileType = array_pop($tmp);
            $fileMD5 = md5_file($file['tmp_name']);
            if (!$this->store_file($file, $name, $fid, $fileType)) {
                return false;
            }

            $newData['fileType'] = $fileType;
            $newData['fileMD5'] = $fileDM5;
        }
        else {
            $this->rename_file($id, $name);
        }

        return $this->update_item(array('id' => $id), $newData);
    }

    public function del_pjfile($id = 0)
    {
        $this->delete_file($id);
        return $this->delete_item(array('id' => $id));
    }

    private function delete_file($id = 0)
    {
        try {
            $file = $this->get_pjfile($id);
            $filePath = $this->dataPath.'data/'.$file['pid'].'/'.$file['id'].'_'.$file['name'].'.'.$file['fileType'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function rename_file($fid = 0, $newName = '')
    {
        $file = $this->get_pjfile($fid);
        $oldPath = $this->dataPath.'data/'.$file['pid'].'/'.$file['id'].'_'.$file['name'].'.'.$file['fileType'];
        $newPath = $this->dataPath.'data/'.$file['pid'].'/'.$file['id'].'_'.$newName.'.'.$file['fileType'];
        if ($oldPath != $newPath) {
            rename($oldPath, $newPath);
        }
    }

    private function store_file($file = '', $name = '', $fid = 0, $ftype = '')
    {
        try {
            $pid = $_SESSION['project']['pid'];
            $filePath = $this->dataPath.'data/'.$pid.'/'.$fid.'_'.$name.'.'.$ftype;
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