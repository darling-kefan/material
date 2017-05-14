<?php
if(!defined('MATERIAL')){
	exit('Include Permission Denied!');
}
/**
 * 设备组模型。
 */
class SettingModel extends BaseModel
{
    public $table;
    //初始化表名
    public function init()
    {
		$this->table   = APP_DBPREFIX.'sys_config';
    }
    
	/**
     * 检测网站是否开启
     */
    public function checkSiteOpen()
    {
        $sql = "SELECT `website_open`,`website_close_msg` FROM `" .$this->table . "`";
        $result = self::$db_app->getOne($sql);
        return $result;     
    }
    
    /**
     * 查询系统设置信息（用于模板display调用时）
     */
    public function getSettingInfo()
    {
        $sql = "SELECT `website_name`, `website_url`, `website_logo`, `website_addr`, `website_tel`, `website_zipcode`, `website_mail`, `website_icp`, `website_open`, `website_close_msg` 
        		FROM `$this->table`";
        $result = self::$db_app->getOne($sql);
        //去除转义
        $result['website_close_msg'] = $result['website_close_msg'];
        return $result;     
    }
    
	/**
	 * 更新用户
	 * @param array $dataArr
	 * @return int or false
	 */
	public function updateSetting($dataArr,$condition=1)
	{
		$status = self::$db_app->filtUpdate($this->table,$dataArr,$condition);
		return $status;
	}
}
