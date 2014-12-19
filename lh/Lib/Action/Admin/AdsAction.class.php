<?php

class AdsAction extends CommonAction{
 	
 	/* 列表
	 */
    function index() {
    	$adsMod = D('Ads');
    	$adpMod = D('Adplace');
    	import('@.ORG.Util.Page');//引入分页类
    	$count = $adsMod->where()->count();//计算总记录数
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$list = $adsMod->join(' s left join __ADPLACE__ p on s.adPlace=p.adpAlias')->field('s.*,p.adpTitle as adPlace')->where()->order('updateTime desc,createTime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    /*
	 * 单页添加、修改
	 * ads表中adType字段值为	word 是文字广告
	 * ads表中adType字段值为	img 是图片广告
	 */
    function edit() {
    	$adsMod = D('Ads');
    	$adpMod = D('Adplace');
    	$types = $adpMod->select();
    	if($this->isPost()){
    		$data = $adsMod->create(); 
    		if($data !== false){
    			if($data['id']){
    				$data['updateTime'] = time(); //获取更新时间
    				$adsMod->save($data);	//修改
    			}else{
    				$data['createTime'] = time();//获取出创建时间
    				$data['updateTime'] = time(); //获取更新时间
    				$adsMod->add($data);	//添加
    			}
    			$this->assign('jumpUrl',U('Ads/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($adsMod->getError());
    		}
    	}
    	$id = $_REQUEST['id'];//获取广告id
    	if($id){
    		$where['id'] = $id;
    		$adsInfo = $adsMod->where($where)->find(); //通过id获取要修改的单页信息
    	}
    	//print_r($types);
    	$this->assign('adsInfo',$adsInfo);
    	$this->assign('adpTypes',$types);
    	$this->display();
    }
    
    /*
	 * 单页删除
	 */
    function del() {
    	$id = $_REQUEST['id'];
    	$dictMod = D('Ads');
    	$sWhere['id'] = $id;
    	$dictMod->where($sWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Ads/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    }
}
?>