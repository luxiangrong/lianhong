<?php

class DictModel extends CommonModel{
	
	/*
	 * 查询所有子类
	 */
	 public function children($pid,$level) { 
	 	
		// 获得一个 父节点 $parent 的所有子节点 
		$result = $this->where('pid="'.$pid.'"')->select();
		
		// 显示每个子节点 
		$return = array();
		foreach ($result as $key => $row){
			$return[$row['id']][$row['id']] = str_repeat("&nbsp;&nbsp;",$level).$row['dictName']."<br/>";
			//$return[$row['id']] = str_repeat("&nbsp;&nbsp;",$level).$row['dictName']."<br/>";
			$return2 = $this->children($row['id'],$level+1);
			if($return2){
				$return[] = $return2;
			}
		}
		return $return;
	}	
	
	/*
	 * 将多维数组转换为一维数组
	 */
	public function array_multi_array($array){ 
	    static $result_array=array(); 
	    foreach($array as $key => $value) 
	    { 
	        if(is_array($value)) 
	        { 
	            $this->array_multi_array($value); 
	        } 
	        else{  
	            $result_array[$key]=$value; 
	        }
	    } 
	    return $result_array; 
	} 
}
?>