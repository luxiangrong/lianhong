<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

class PublicAction extends Action {
	var $setting;
	function _initialize() {
    	$this->setting = get_setting();
    	if($this->setting['website']){
    		C('SITE_URL',$this->setting['website']);
    	}
    	$this->assign('setting',$this->setting);
	}
	// 检查用户是否登录
	private function _checkUser(){
    	if($_SESSION['adminid']){
    		return true;
    	}
    	return false;
    }
    function checkUser() {
    	if(!$this->_checkUser() && strtolower(ACTION_NAME) !== 'login'){
    		$this->redirect('Public/login');
    	}
    }

	// 顶部页面
	public function top() {
		$this->checkUser();
		
		//获取用户所属的用户组
		$user = session('adminUsername');
		$userMod = D('User');
		$uWhere['account'] = $user;
		$uWhere['s.status'] = 1;
		$group = $userMod->join(' u left join __SYS_GROUP__ s on u.bind_account=s.id')->where($uWhere)->field('s.*')->find();
		$group['navTops'] = explode(',',$group['navTops']);
	
		
		//查询用户所属权限能显示的头部导航
		$navMod = D('SysNav');
		foreach($group['navTops'] as $k=>$v){
			if($k == 0){
				$id = "id=".$v;
			}else{
				$id .= " or id=".$v;
			}
		}
		$map = 'pid=0 and status=1 and ('.$id.')';
		$list = $navMod->where($map)->select();
//		$nrls = array();
//		foreach($list as $k=>$v){
//			$nrlswhere['pid'] = $v['id'];
//			$url = $navMod->where($nrlswhere)->order('id')->find();
//			$v['suburl'] = $url['navUrl'];
//			$nrls[] = $v;
//		}
//		print_r($list);
		$this->assign('nodeGroupList',$list);
		$this->assign('adminUser',$user);
		$this->display();
	}
	// 尾部页面
	public function footer() {
		C('SHOW_RUN_TIME',false);			// 运行时间显示
		C('SHOW_PAGE_TRACE',false);
		$this->display();
	}
	// 菜单页面
	public function menu() {
        $this->checkUser();
        
        //获取用户所属的用户组
        $user = session('adminUsername');
		$userMod = D('User');
		$uWhere['account'] = $user;
		$group = $userMod->join(' u left join __SYS_GROUP__ s on u.bind_account=s.id')->where($uWhere)->field('s.*')->find();
		$group['navIds'] = explode(',',$group['navIds']);
		
		//查询用户所属权限能显示的头部导航
		$navMod = D('SysNav');
		foreach($group['navIds'] as $k=>$v){
			if($k == 0){
				$id = "id=".$v;
			}else{
				$id .= " or id=".$v;
			}
		}
		$map = 'pid='.$_GET['pid'].' and status=1 and ('.$id.')';
		$list = $navMod->where($map)->order('navSort desc')->select();
	
        $this->assign('menu',$list);
		
		$this->display();
	}

    // 后台首页 查看系统信息
    public function main() {
    	$this->checkUser();
        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
            );
        $this->assign('info',$info);
        $this->display();
    }

	// 用户登录页面
	public function login() {
		if($this->isPost()){
    		$model = D('User');    		
    		$data = $model->create();
    		session('adminUsername',$data['account']);
    		$data['password'] = md5($data['password']);
    		$data['verify'] = md5($_POST['verify']);
    		if($data !== false){
    			if($this->setting['loginAdmin'] == 1){
	    			if($_POST['verify'] == ''){
	    				$this->error("验证码必须");
	    			}elseif($data['verify'] != $_SESSION['verify']){
	    				$this->error("验证码错误");
	    			}
    			}
    			if($data['account'] == ''){
    				$this->error("请输入用户名");
    			}elseif($_POST['password'] == ''){
    				$this->error("请输入密码");
    			}else{
	    			$row = $model->where('account="'.$data['account'].'" and password="'.$data['password'].'"')->find();
	    			if($row){
	    				if($row['status']){
	    					$logData['last_login_time'] = time();
		    				$logData['last_login_ip'] = get_client_ip();
		    				$uid = $model->where('account="'.$data['account'].'" and password="'.$data['password'].'"')->save($logData);
				    		$_SESSION['adminid'] = $row['id'];			    		
				    		$this->redirect('Index/index');	    					
	    				}elseif(!$row['status']){
	    					$this->assign('jumpUrl',U('Public/login'));
	    					$this->error('此用户不能登录');	    						 
	    				}
	    						    		
	    			}else{
	    				$this->error("用户名或密码有误");
	    			}
    			}
    		}
    	}
		$this->display();
	}

	public function index()
	{
		//如果通过认证跳转到首页
		redirect(__APP__);
	}

	// 用户登出
    public function logout(){
        session('adminid',null);
		session('adminUsername',null);
        $this->assign("jumpUrl",U('Public/login'));
        $this->success('登出成功！');
    }

	
    // 更换密码
    public function changePwd(){
		$this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
		if(md5($_POST['verify'])	!= session('verify')) {
			$this->error('验证码错误！');
		}
		$map	=	array();
        $map['password']= md5($_POST['oldpassword']);
        if(session('adminid')) {
            $map['id']		=	session('adminid');
        }
        //检查用户
        $User    =   D("User");
        if(!$User->where($map)->field('id')->find()) {
            $this->error('旧密码不符或者用户名错误！');
        }else {
			$User->password	=	md5($_POST['password']);
			$User->save();
			$this->success('密码修改成功！');
         }
   		
    }
	
	//验证码
	 public function verify()
    {
		$type	 =	 isset($_GET['type'])?$_GET['type']:'gif';
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4,1,$type);
    }

}
?>