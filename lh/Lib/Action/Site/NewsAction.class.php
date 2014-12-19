<?php

class NewsAction extends BaseAction{
	
	public function _initialize() {	
		parent:: _initialize();	
		$catid = $_REQUEST['catid'];
		$id = $_REQUEST['id'];		
		$dictMod = M('Dict');
		if($catid){
			$where['id'] = $catid;
			$dictInfo = $dictMod->where($where)->find();
		}elseif($id){
			$where['n.id'] = $id;
			$dictInfo = $dictMod->join(' d left join __NEWS__ n on d.id=n.newsType')->where($where)->field('d.*')->find();
		}
		$this->assign('catid',$catid);
		$this->assign('dictInfo',$dictInfo);
	}
	
	/*列表页*/
    public function lists() {
    	$catid = $_REQUEST['catid'] ? $_REQUEST['catid'] : 1;
    	$newsMod = M('News');
    	
    	//列表
    	$where['newsType'] = $catid;
    	$count = $newsMod->where($where)->count();
    	import('@.ORG.Util.ClientPage'); 
    	if($catid == 2 || $catid == 3){   	
    		$Page = new ClientPage($count,10);
    	}
    	if($catid == 1){
    		$Page = new ClientPage($count,5);
    	}
    	$show = $Page->show();
    	$newsList = $newsMod->where($where)->order('createTime desc,updateTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('newsList',$newsList);
    	$this->assign('page',$show);
    	
    	//模板加载
    	if($catid == 1){
    		$this->display();
    	}elseif($catid == 2 || $catid == 3){
    		$this->display('Media:lists');
    	}
    }
    
    /*内容页*/
    public function view(){
    	$id = $_REQUEST['id'];
    	if($id){    
    		$newsMod = D('News');		
    		$where['id'] = $id;
    		$info = $newsMod->where($where)->find();
    		
    		//上一篇、下一篇
    		$data = $newsMod->nextChapter($id);
    		
    		if(!$info)redirect(U('Error/index'));
    	}else{
    		redirect(U('Error/index'));
    	}
    	
    	$this->assign('seoTitle',$info['newsTitle']);
    	$this->assign('seoKeywords',$info['keywords']);
    	$this->assign('seoDescription',msubstr(strip_tags(htmlspecialchars_decode($info['newsDescription'])),0,400,''));
    	
    	$this->assign('catid',$info['newsType']);
    	$this->assign('data',$data);
    	$this->assign('info',$info);
    	
    	//模板加载
    	if($info['newsType'] == 1){
    		$this->display();
    	}elseif($info['newsType'] == 2 || $info['newsType'] == 3){
    		$this->display('Media:view');
    	}
    }
}
?>