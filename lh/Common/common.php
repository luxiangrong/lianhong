<?php
Load('extend');

//导航地址处理
function get_navurl($url) {
	if (stripos($url, '://www')) {
		return $url;
	} else {
		//$tmp = explode('/',$url); 		 	
		return U($url);
	}
}

//读取配置文件
function get_setting() {
	$setinfos = F('setting');
	if (!$setinfos) {
		$setting = D('Setting');
		$setinfo = $setting->getSetting();
		F('setting', $setinfo);
		$setinfos = $setinfo;
	}
	return $setinfos;
}

//邮件发送
function send_email($email, $title, $content) {
	$_setting = get_setting();
	if (!$_setting['smtpServer'])
		return false;
	import('@.ORG.Mail');
	$smtpServer = $_setting['smtpServer'];
	$smtpPort = $_setting['smtpPort'];
	$smtpSsl = $_setting['smtpSsl'];
	$smtpUser = $_setting['smtpUser'];
	$smtpPw = $_setting['smtpPw'];
	$smtp = new Smtp($smtpServer, $smtpPort, $smtpSsl ? true : false, $smtpUser, $smtpPw);
	return $smtp->sendmail($email, $smtpUser, $title, $content);
}

/*	调用广告
 * $adPlace  	广告位
 * $p		显示的前缀
 * $s		显示的后缀
 */
function get_ads($adPlace, $args = array ()) {
	//读取缓存
	$Data = S($adPlace);
	if ($Data) {
		return $Data;
	}

	$Prefix = $args['p'] ? $args['p'] : '';
	$Suffix = $args['s'] ? $args['s'] : '';
	$adpModel = M('Adplace');
	$adpWhere['adpAlias'] = $adPlace;
	$adpInfo = $adpModel->where($adpWhere)->find();
	$return = '';
	if ($adpInfo) {
		$adsModel = M('Ads');
		$adsWhere['adPlace'] = $adPlace;
		if ($adpInfo['adpRand']) {
			$ads = $adsModel->field('s.*,rand() as ran')->order('ran');
		} else {
			$ads = $adsModel->order('updateTime desc');
		}
		if ($adpInfo['adpNum']) {
			if ($adpInfo['adpNum'] == 1) {
				$ads = $ads->where($adsWhere)->find();
			} else {
				$ads = $ads->where($adsWhere)->limit($adpInfo['adpNum'])->select();
			}
		} else {
			$ads = $ads->where($adsWhere)->select();
		}

		if ($args === true) {
			$return = array ();
			foreach ($ads as $key => $v) {
				if (is_array($v)) {
					$return[] = array_merge($adpInfo, $v);
				} else {
					$return = array_merge($adpInfo, $ads);
					break;
				}
			}
		} else {
			$newAds = is_array($ads[0]) ? $ads : array (
				$ads
			);
			$ads = $newAds;
			$string = '';
			foreach ($ads as $key => $v) {
				$adsurl = $v['adUrl'];
				$str = $Prefix;
				$str .= $adsurl ? '<a href="' . $adsurl . '" target="' . $adpInfo['adpTarget'] . '">' : '';
				if ($v['adType'] == 'img') {
					$str .= "<img src=\"" . $v['adContent'] . "\" width=\"" . $adpInfo['adpWidth'] . "\" height=\"" . $adpInfo['adpHeight'] . "\"/>";
				}
				elseif ($v['adType'] == 'word') {
					$str .= $v['adContent'];
				}
				$str .= $adsurl ? '</a>' : '';
				$str .= $Suffix;
				$string .= $str;
			}

			$return = $string;
		}
	}

	if ($adpInfo['adpCache']) {
		S($adPlace, $return, $adpInfo['adpCache']);
	}

	return $return;
}

//前台日期
function client_date($t) {
	return date('Y.m.d', $t);
}

//前台字符串截取
function client_substr($str, $len) {
	$str = strip_tags($str);
	return msubstr($str, 0, $len);
}

//根据类型 和id  返回下拉框
function get_info($type, $id) {
	$pid = $id ? $id : 0;
	$option = array ();
	if ($type == 'region') {
		$regionModel = M('Region');
		$pWhere['pid'] = $pid;
		$regioninfo = $regionModel->where($pWhere)->select();
		foreach ($regioninfo as $key => $v) {
			$option[] = "<option value=\"" . $v['id'] . "\">" . $v['regionName'] . "</option>";
		}

	}
	elseif ($type == 'gcate') {
		$goodsModel = M('GoodsCate');
		$pWhere['pid'] = $pid;
		$pWhere['storeId'] = 0;
		$goodsinfo = $goodsModel->where($pWhere)->select();
		foreach ($goodsinfo as $key => $v) {
			$option[] = "<option value=\"" . $v['id'] . "\">" . $v['cateName'] . "</option>";
		}

	}

	$return = '';
	if ($option) {
		$return = '<select name="goodsCates[]" id="' . $pid . '"><option>请选择……</option>' . implode("\n", $option) . '</select>';
	}
	return $return;
}

//判断状态：是/否
function status($fields){
	return $fields ? "是" : "否";
}

//时间格式
function format_date($time){
	return date("Y-m-d H:i",$time);
}



//处理热门关键词
function getKeywords($string){
	$string = str_replace('，',',',$string);
	$keywords = explode(',',$string);
	return $keywords;
}



/*
 * 词语过滤
 * $v  词语
 */
function check_bad_words($v){
	$setting = get_setting();
	$sensitive = getKeywords($setting['sensitive']);
	foreach($sensitive as $key=>$val){
		$len = strlen($val);
		$v = str_replace($val,str_repeat('*',$len),$v);
	}
	return $v;
}



?>
