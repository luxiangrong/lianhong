<?php

class SysgroupAction extends CommonAction{
	
	/*
	 * 权限列表
	 */
    public function index() {
    	$groupMod = D('SysGroup');
    	import('@.ORG.Util.Page');//引入分页类
    	$count = $groupMod->where()->count();//计算总记录数
    	$Page = new Page($count,25); //实例化分页类，每页显示数
    	$show = $Page->show();
    	$list = $groupMod->where()->order('')->limit($Page->firstRow.','.$Page->listRows)->select();
    	
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    /*
     * 添加、修改
     */
    public function edit() {
    	$groupMod = D('SysGroup');    	
    	$navMod = D('SysNav');
    	if($this->isPost()){
    		$data = $groupMod->create();
    		if($data !== false){  //子导航选择
				foreach($data['navIds'] as $key=>$ids){
					$tops[] = $key;
					foreach($ids as $ke=>$id){
						$navIds[] = $id;
					}
				}
				$data['navTops'] = implode(',',$tops);
				$data['navIds'] = implode(',',$navIds);
    			if($data['id']){
    				$groupMod->save($data);	//修改
    			}else{
    				$groupMod->add($data);	//添加
    			}
    			$this->assign('jumpUrl',U('Sysgroup/index'));
    			$this->success('保存成功');
    		}else{
    			$this->error($groupMod->getError());
    		}
    	}
    	
    	//修改值
    	$id = $_REQUEST['id'];//获取id
    	if($id){
    		$where['id'] = $id;
    		$groupInfo = $groupMod->where($where)->find(); //通过id获取要修改的信息
    		$groupInfo['navTops'] = explode(',',$groupInfo['navTops']);
    		$groupInfo['navIds'] = explode(',',$groupInfo['navIds']);
    	}
    	
    	
    	$nav['pid'] = 0;
    	$navTop = $navMod->where($nav)->select(); //查询顶部导航
    	foreach($navTop as $k=>$v){
    		$con['pid'] = $v['id'];
    		$navSun[$v['id']] = $navMod->where($con)->select(); //查询左侧导航
    	}
    
    	$this->assign('groupInfo',$groupInfo);
    	$this->assign('navTop',$navTop);
    	$this->assign('navSun',$navSun);
    	$this->display();
    }
    
    /*
     * 删除
     */
    public function del() {
    	$id = $_REQUEST['id'];
    	$groupMod = D('SysGroup');
    	$sWhere['id'] = $id;
    	$groupMod->where($sWhere)->delete(); //删除指定id的记录
    	$this->assign('jumpUrl',U('Sysgroup/index'));//跳转到列表页
    	$this->success('删除成功');//提示信息
    	$this->display();
    }
}
?>