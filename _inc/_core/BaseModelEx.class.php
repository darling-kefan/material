<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}

/**
 * 数据模型封装基类，该基类主要是对于特定数据库的操作封装。
 * @author  sqtang<tsq7473281@163.com>
 * @version v1.0 2013-08-23
 */
abstract class BaseModelEx extends Base
{
    /**
     * 数据表名称
     * @var string
     */
    public $table;
    /**
     * 主键字段名称
     * @var string
     */
    public $primary;
    
    /**
     * 子类必须定义该方法，方法内部初始化成员变量。
     */
    abstract public function init();
    
    /**
     * 根据条件查询记录数。
     * @param  string $condition
     * @return int
     */
    public function getCount($condition = 1)
    {
        $condition   = empty($condition) ? 1 : $condition;
        $sql  = "SELECT COUNT(*) FROM `{$this->table}` WHERE {$condition}";
        return self::$db_app->scalar($sql);
    }
    
    /**
     * 
     * 获得记录列表。
     * @param string $select          查询字段
     * @param string $condition       查询条件
     * @param int    $first           分页起始
     * @param int    $limit           查询条数
     * @param string $orderby         排序
     * @param bool   $usePrimaryAsKey 是否使用主键作为返回的数组键名(当然此时查询的$select中必须包含主键)
     */
    public function getList($select = "*", $condition = 1, $first = 0, $limit = 0, $orderby = null, $usePrimaryAsKey = false)
    {
        $list        = array();
        $limitString = ($limit == 0) ? '' : " LIMIT {$first}, {$limit}";
        $condition   = empty($condition) ? 1 : $condition;
        $sql         = "SELECT {$select} FROM `{$this->table}` WHERE {$condition} {$orderby} {$limitString}";
        //echo $sql;
        if($usePrimaryAsKey){
            $res = self::$db_app->query($sql);
            while ($row = self::$db_app->fetchAssoc($res)){
                $list[$row[$this->primary]] = $row;
            }
        }else{
            $list = self::$db_app->getAll($sql);
        }
        return $list;
    }
    
    /**
     * 根据条件获得一条记录。
     * @param  int    $primary
     * @param  string $condition 查询条件
     * @return array
     */
    public function getOne($select, $condition)
    {
        $condition = empty($condition) ? 1 : $condition;
        return self::$db_app->getOne("SELECT {$select} FROM `{$this->table}` WHERE {$condition}");
    }

    /**
     * 添加记录，并返回添加记录的ID，失败返回false。
     * @param  array $data
     * @param  bool  $replace 是否执行REPLACE操作
     * @return int|false
     */
    public function insert($data, $replace = false)
    {
        $result =  self::$db_app->insert($this->table, $data, $replace);
        if($result){
            return self::$db_app->insertId();
        }else{
            return false;
        }
    }
}
?>