<?php



//获取大分类类型
function dict_type($type,$typeName){
	$types = C($type);
	$dict = '';
	foreach($types as $k=>$v){
		if($typeName == $v['type']){
			$dict = $v['name'];
		}
	}
	return $dict;
}

//清除缓存
function clear_cache(){
	//缓存目录
	$dirs = array(RUNTIME_PATH);
	//清理缓存
	foreach($dirs as $value){
		rmdirr($value);
		@mkdir($value,0777,true);
	}
}

//删除文件夹
function rmdirr($dirname) {

	if (!file_exists($dirname)) {
		return false;
	}

	if (is_file($dirname) || is_link($dirname)) {
		return unlink($dirname);
	}
	
	$dir = dir($dirname);

	while (false !== $entry = $dir->read()) {
		if ($entry == '.' || $entry == '..') {
			continue;
		}
		rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
	}
	$dir->close();
	return rmdir($dirname);
}

?>
