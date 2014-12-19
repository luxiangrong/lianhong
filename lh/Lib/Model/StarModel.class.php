<?php

class StarModel extends CommonModel{
	
	//展示图序列化
	function savePhotos($photos=array()){
		foreach($photos as $key=>$val){
			if(empty($val)){
				unset($photos[$key]);
				continue;
			}
			$photos[$key] = $val;
		}
		$photo = serialize($photos);
		return $photo;
	}
}
?>