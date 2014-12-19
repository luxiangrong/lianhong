<?php

class UserAction extends CommonAction{
	//用户列表
    public function index(){
    	$userMod = M('User');
    	import("@.ORG.Util.Page");  //导入分页类
    	$count = $userMod->count(); //查询满足要求的总记录数
    	$Page = new Page($count,25); //实例化分页类传入总记录数和每页显示的记录数
    	$show = $Page->show(); //分页显示输出
    	$list = $userMod->join(' u left join __SYS_GROUP__ s on u.bind_account = s.id')->order('update_time desc,create_time desc')->limit($Page->firstRow.','.$Page->listRows)->field('u.*,s.groupName')->select();
//    	$lists = array();
//    	foreach($list as $k => $v){
//    		$groupMod = D('SysGroup');
//    		$groupwhere['id'] = $v['bind_account'];
//    		$groups = $groupMod->where($groupwhere)->find();
//    		$v['groupName'] = $groups['groupName'];
//    		$lists[] = $v;
//    		
//    	}
    	$this->assign('list',$list);
    	$this->assign('page',$show);
    	$this->display();
    }
    
    //用户添加
    public function edit(){
    	$userMod = M('User');
    	$id = $_REQUEST['id'];
    	if($this->isPost()){
    		$user = $userMod->create();			
    		if($id){
    			$user['update_time'] = time();
    			$where['id'] = $id;
    			if($user['password']){
    				$user['password'] = md5($user['password']);
    			}else{
    				unset($user['password']);
    			}
    			$userMod->where($where)->save($user);
    			$this->success('修改成功',U('User/index'));
    		}else{
    			$user['password'] = md5($user['password']);
    			$user['update_time'] = time();
    			$user['create_time'] = time();
    			$userMod->add($user);
    			$this->success('添加成功',U('User/index'));
    		}
    	}
    	if($id){
    		$where['id'] = $id;
    		$users = $userMod->where($where)->find();
    		$this->assign('users',$users);
    	}
    		$groupMod = D('SysGroup');
    		$groupwhere['status'] = 1;
    		$group = $groupMod->where($groupwhere)->select();
    		$this->assign('group',$group);
    		$this->display();
    }
    
    
    //用户删除
    public function del(){
    	$userMod = M('User');
    	$id = $_REQUEST['id'];
    	if($id){
    		$where['id'] = $id;
    		$userMod->where($where)->delete();
    		$this->success('成功删除',U('User/index'));
    	}else{
    		$this->error('删除失败');
    	}
    }
}
?>