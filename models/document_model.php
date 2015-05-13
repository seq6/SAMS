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

    /**
    **获取单个文档的记录信息
    **
    **param：int (文档id)
    **return：成功:array | 失败:false
    */
    public function get_dom($id = 0)
    {
        $res = $this->get_item(array('id' => $id));
        if (is_array($res) && !empty($res)) {
            return $res[0];
        }
        return false;
    }

    /**
    **获取若干文档的记录信息
    **
    **param：int (项目id), int (获取记录数量), int (记录偏移量)
    **return：成功:array | 失败:false
    */
    public function get_doms($pid = 0, $limit = 10, $offset = 0)
    {
        return $this->get_item(array('pid' => $pid), $limit, $offset);
    }

    /**
    **获取所有文档的记录信息
    **
    **param：int (项目id)
    **return：成功:array | 失败:false
    */
    public function get_all_doms($pid = 0)
    {
        return $this->get_item(array('pid' => $pid), 0, 0, true);
    }

    /**
    **获取某项目下文档的数量
    **
    **param：int (项目id)
    **return：int (数量)
    */
    public function get_doms_count($pid = 0)
    {
        return $this->get_count(array('pid' => $pid));
    }

    /**
    **添加文档
    **
    **param：(相关信息)
    **return：成功:int(文档id) | 失败:false
    */
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

    /**
    **删除文档
    **
    **param：int (文档id)
    **return：成功:int(文档id) | 失败:false
    */
    public function del_dom($id = 0)
    {
        return $this->delete_item(array('id' => $id));
    }

    /**
    **更新文档信息
    **
    **param：(相关信息)
    **return：成功:int(文档id) | 失败:false
    */
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