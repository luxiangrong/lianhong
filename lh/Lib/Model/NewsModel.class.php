<?php

class NewsModel extends CommonModel{
	//上一篇、下一篇
	function nextChapter($id){
		 if(!$id){
		 	$this->getError("该文章找不到");
		 }
		 //当前id记录信息
		 $where['id'] = $id;
		 $info = $this->where($where)->find();
		 
		 $lastWhere['newsType'] = $info['newsType'];
		 //第一条记录
		 $firstInfo = $this->where($lastWhere)->order('id asc')->find();
		 //最后一条记录
		 $lastInfo = $this->where($lastWhere)->order('id desc')->find();
		 
		 if($id == $firstInfo['id']){
		 	$data['upMsg'] = "没有上一篇了";
		 }
		 if($id == $lastInfo['id']){
		 	$data['downMsg'] = "没有下一篇了";
		 }
		 
		 //上一篇
		 $upWhere['id'] = array('lt',$id);
		 $upWhere['newsType'] = $info['newsType'];
		 $data['up'] = $this->where($upWhere)->order('id desc')->limit(1)->find();
		
		 //下一篇
		 $downWhere['id'] = array('gt',$id);
		 $downWhere['newsType'] = $info['newsType'];
		 $data['down'] = $this->where($downWhere)->order('id asc')->limit(1)->find();
		 
		 return $data;
	}
}
?>