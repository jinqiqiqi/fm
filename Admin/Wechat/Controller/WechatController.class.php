<?php
namespace Wechat\Controller;
use Think\Controller;
class WechatController extends Controller {
	public function index() {
		$selected_token = M('cur_wechat') -> select();
		$this->assign('selected_token',$selected_token[0]['token']);
		$wechat = M('wechat') -> select();
		$this->assign('wechat',$wechat);
		$this->display();
	}
	public function add() {
		$this->display();
	}
	public function add_wechat() {
		$wechat = M('wechat') -> where("token = '%s'",I('token')) -> find();
		if($wechat) {
			$reply['status'] = 'EXIST';
			echo json_encode($reply);
		} else {
			$data['name'] = I('name');
			$data['token'] = I('token');
			$data['appid'] = I('appid');
			$data['appsecret'] = I('appsecret');
			$id = M('wechat') -> add($data);
			if((M('cur_wechat') -> count()) == 0) {				
				$cur_wechat['token'] = I('token');
				M('cur_wechat') -> add($cur_wechat);
			}
			$param['id'] = $id;
			$reply['status'] = 'SUCCESS';
			$url = 'http://';
		    if (isset ( $_SERVER ['HTTPS'] ) && $_SERVER ['HTTPS'] == 'on') {
		        $url = 'https://';
		    }
			$reply['url'] = $url . $_SERVER['HTTP_HOST'] . U('Wechat/Index/index',$param);
			$reply['token'] = 'weixin';
			echo json_encode($reply);
		}
	}
	public function delete_wechat() {
		$info = M('wechat') -> where("id = %d",intval(I('id'))) -> delete();
		if($info) {
			echo 'SUCCESS';
		} else {
			echo 'FAIL';
		}
	}
	public function edit() {
		$param['id'] = I('id');
		$url = 'http://';
		if (isset ( $_SERVER ['HTTPS'] ) && $_SERVER ['HTTPS'] == 'on') {
		    $url = 'https://';
		}
		$url = $url . $_SERVER['HTTP_HOST'] . U('Wechat/Index/index',$param);
		$this->assign('server_url',$url);
		$this->assign('server_token','weixin');
		$wechat = M('wechat') -> where("id = '%d'",I('id')) -> find();
		$this->assign('wechat',$wechat);
		$this->display();
	}
	public function edit_wechat() {
		$wechat = M('wechat') -> where("id = %d",I('id')) -> find();
		if(!$wechat) {
			echo 'NOEXIST';
		} else {
			$data['appid'] = I('appid');
			$data['appsecret'] = I('appsecret');
			M('wechat') -> where("id = %d",I('id')) -> save($data);
			echo 'SUCCESS';
		}
	}
	public function select_wechat() {
		M('cur_wechat') -> where('1=1')->delete();
		$cur_wechat['token'] = I('token');
		$info = M('cur_wechat') -> add($cur_wechat);
		echo 'SUCCESS';
	}
}
?>