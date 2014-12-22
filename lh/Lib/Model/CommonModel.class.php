<?php
/**
 * 模型公共部分
 */
class CommonModel extends RelationModel{
	/**
	 * 插入数据库关键词过滤
	 */
    protected function _before_insert(&$data,$options) {
    	foreach($data as $k=>$v){
    		if(strpos('id',strtolower($k))) continue;
    		$v = check_bad_words($v);
    		$data[$k] = $v;
    	}
    }
    
    /**
	 * 更新数据库关键词过滤
	 */
    protected function _before_update(&$data,$options) {
    	foreach($data as $k=>$v){
    		if(strpos('id',strtolower($k))) continue;
    		$v = check_bad_words($v);
    		$data[$k] = $v;
    	}
    }
}
?>