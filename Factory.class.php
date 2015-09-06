<?php
/**
 * 工厂设计模式： 提供获取某个对象的新实例的一个接口， 同时使调用代码避免确定实际实例化基类的步骤
 */
//基础标准CD类
class CD {
	
	public $tracks = array();
	public $band   = '';
	public $title  = '';
	
	public function __construct() {}
	
	public function setTitle($title) {
		$this->title    = $title;
	}
	
	public function setBand($band) {
		$this->band     = $band;
	}
	
	public function addTrack($track) {
		$this->tracks[] = $track;
	}
	
}

//增强型CD类， 与标准CD的唯一不同是写至CD的第一个track是数据track("DATA TRACK")
class enhadcedCD {

	public $tracks = array();
	public $band   = '';
	public $title  = '';

	public function __construct() {
		$this->tracks   = "DATA TRACK";
	}
	
	public function setTitle($title) {
		$this->title    = $title;
	}
	
	public function setBand($band) {
		$this->band     = $band;
	}
	
	public function addTrack($track) {
		$this->tracks[] = $track;
	}
}

//CD工厂类，实现对以上两个类具体实例化操作
class CDFactory {
	
	public static function create($type) {
		$class = strtolower($type) . "CD";
		
		return new $class;
	}
}

//实例操作
$type = "enhadced";

$cd   = CDFactory::create($type);

$tracksFromExternalSource = array("What It Means", "Brr", "Goodbye");

$cd->setBand("Never Again");
$cd->setTitle("Waste of a Rib");
foreach ($tracksFromExternalSource as $track) {
	$cd->addTrack($track);
}
