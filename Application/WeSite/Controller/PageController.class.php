<?php
namespace WeSite\Controller;
use Think\Controller;
class PageController extends Controller {
	public function index() {
		$wechat = M('cur_wechat') -> where("1 = 1") -> find();
		get_token($wechat['token']);
		get_openid();

		require "jssdk.php";
		$map ['token'] = $wechat['token'];
    	$info = M ( 'wechat' )->where ( $map )->find ();
		$js_tool = new \JSSDK($info['appid'],$info['appsecret']);
		$signPackage = $js_tool -> getSignPackage();
		$this->assign('signPackage',$signPackage);
		
		$page = M('page','ws_') -> where("id = %d",I('page_id')) -> find();
		$this->assign('page',$page);
		$zan = M('zan','ws_') -> where("page_id = %d",I('page_id')) -> count();
		$this->assign('zan',$zan);
		$this->display();
	}
	public function zan() {
		$zan = M('zan','ws_') -> where("page_id = %d AND openid = '%s'",I('page_id'),get_openid()) -> find();
		if($zan) {
			echo 'ZANED';
		} else {
			$data['page_id'] = I('page_id');
			$data['openid'] = get_openid();
			$data['date'] = time();
			M('zan','ws_') -> add($data);
			echo 'SUCCESS';
		}
	}
}
?>