<?php

class SearchAction extends BaseAction{

    function index() {
    	$searchMod = M('News');
    	$search = $_REQUEST['search'];
    	$key = $_REQUEST['key'];
    	if($search){
    		//搜索条件
	    	$searchW['newsTitle'] = array('like','%'.$search.'%');
	    	$searchW['keywords'] = array('like','%'.$search.'%');
	    	$searchW['newsContent'] = array('like','%'.$search.'%');
	    	$searchW['_logic'] = 'or';
	    	$where['_complex'] = $searchW;
	    	$param = '&search='.$search;
	    	$keyword = $search;
	    	$this->assign('search',$search);	    	
    	}
    	if($key){
    		//搜索条件
	    	$searchW['newsTitle'] = array('like','%'.$key.'%');
	    	$searchW['keywords'] = array('like','%'.$key.'%');
	    	$searchW['newsContent'] = array('like','%'.$key.'%');
	    	$searchW['_logic'] = 'or';
	    	$where['_complex'] = $searchW;
	    	$param = '&search='.$key;
	    	$keyword = $key;
	    	$this->assign('search',$key);
    	}
    	
    	
    	//搜索情况及分页
    	import('@.ORG.Util.ClientPage');    
    	$count = $searchMod->where($where)->count();
    	$page = new ClientPage($count,25,$param);
    	$show = $page->show();
    	$list = $searchMod->where($where)->order('updateTime desc')->limit($page->firstRow.','.$page->listRows)->select();
    	
    	foreach($list as $key=>$val){
    		$val['newsTitle'] = str_replace($keyword,'<font color="#004185">'.$keyword.'</font>',$val['newsTitle']);
    		$val['newsContent'] = str_replace($keyword,'<font color="#004185">'.$keyword.'</font>',msubstr(strip_tags($val['newsContent']),0,200));
    		$list[$key] = $val;
    	}
    	
    	$this->assign('count',$count);
    	$this->assign('page',$show);
    	$this->assign('list',$list);
    	$this->display();
    }
}
?>