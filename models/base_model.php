<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     封装对数据库的增删改查操作
*/
class base_Model extends CI_Model
{
    public $table;

    function __construct()
    {
        $table = null;
    }

    /**
    * @添加一条记录
    * @params array $newData 需要插入的数据
    * @return bool 成功返回插入数据的id, 失败返回false
    **/
    public function add_item($newData = null)
    {
        if ($this->table === null) {
            return false;
        }
        elseif ($this->db->set($newData)->insert($this->table)) {
            return $this->db->insert_id();
        }
        else {
            return false;
        }
    }

    /**
    * @删除记录
    * @params array $conds 删除条件; int $limit 删除函数
    * @return bool true 删除成功, false 删除失败
    **/
    public function delete_item($conds = array(), $limit = 0)
    {
        if ($this->table === null) {
            return false;
        }
        return $this->db->delete($this->table, $conds, $limit);
    }

    /**
    * @更新记录
    * @params array $conds 更新条件; array $newData 新数据
    * @return bool true 更新成功, false 更新成功失败
    **/
    public function update_item($conds = array(), $newData = array())
    {
        if ($this->table === null) {
            return false;
        }
        return $this->db->where($conds)->update($this->table, $newData);
    }

    /**
    * @查询记录
    * @params array $conds 查询条件; int $limit 查询条数; int $offset 偏移量; bool $needAll 是否返回全部符合条件记录; array|string $orderBy 排序
    * @return array 未找到返回空数组
    **/
    public function get_item($conds = null, $limit = 0, $offset = 0, $needAll = false, $orderBy = null, $sort = null)
    {
        if ($this->table === null) {
            return false;
        }
        else {
            $this->db->from($this->table);

            if ($sort !== null) {
                if (is_array($sort)) {
                    foreach ($sort as $s) {
                        $this->db->order_by($sort, '', false);
                    }
                }
                else {
                    $this->db->order_by($sort);
                }
            }

            if ($needAll === false) {
                $this->db->where($conds);
                $this->db->limit($limit, $offset);
            }
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
    * @统计符合条件的记录
    * @params array $conds 统计条件
    * @return int 返回记录条数; 失败返回false
    **/
    public function get_count($conds = null)
    {
        if ($this->table === null) {
            return false;
        }
        return $this->db->from($this->table)->where($conds)->count_all_results();
    }

    /**
    * @使用sql语句
    * @params tring sql语句
    * @return 
    **/
    static function sql_query ($sql = null, $params = null)
    {
        $query = $this->db->query($sql, $params);
        return $query->result_array();
    }
}

?>
