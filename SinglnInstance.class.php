<?php
/**
 * 单例模式： 通过提供对自身共享实例的访问， 单元素设计模式用于限制特定对象只能被创建一次
 * 单例设计模式最常用于构建数据库连接对象。 
 *
 * 代码示例 - 背景介绍
 * 利用单元素设计模式连接数据库并完成CD库存表记录更新
 */
//利用单元素设计模式编写的库存记录更新表
class InventoryConnection {
	
	protected static $_instance = NULL;		//注意这个 static 的定义
	
	protected $_handle = NULL;
	
	public static function getInstance() {	//注意这个 static 的定义
		if ( ! self::$_instance instanceof self) {
			self::$_instance = new self;
		}
		
		return self::$_instance;
	}
	
	protected function __construct() {
		$this->_handle = $this->_retResType();
		//mysql_select_db("test", $this->_handle);
	}

	private function _retResType(){
		$res = true;
		return $res;
	}

	public function update($band, $title){
		echo "update!";
	}
}

//基本CD类
class CD {
	
	protected $_title = "";
	protected $_band  = "";
	
	public function __construct($title, $band) {
		$this->_title = $title;
		$this->_band  = $band;
	}
	
	public function buy() {
		$inventory = InventoryConnection::getInstance();
		$inventory->update($this->_band, $this->_title, -1);
	}	
}

//测试实例
$boughtCDs   = array();
$boughtCDs[] = array("band" => "Never Again", "title" => "Waster of a Rib");
$boughtCDs[] = array("band" => "Therapee", "title" => "Long Road");

//因为会多次利用$cd执行buy操作, 所以在其buy方法具体实现的InventoryConnection对象
//最好是单元素对象。
//针对每个被购买的CD都打开一个与数据库的新连接并不是一个好做法。
foreach ($boughtCDs as $boughtCD) {
	$cd = new CD($boughtCD['title'], $boughtCD['band']);
	$cd->buy();
}
