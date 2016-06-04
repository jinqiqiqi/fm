<?php
namespace WeSite\Controller;
use Think\Controller;
class PersonController extends Controller {
	public function index() {
		$wechat = M('cur_wechat') -> where("1 = 1") -> find();
		get_token($wechat['token']);
		$openid = get_openid();
		$page = M('page','ws_') -> where("openid = '%s'",$openid) -> select();
		$my_page = array();
		foreach ($page as $key => $value) {
			$data['id'] = $value['id'];
			$data['title'] = $value['title'];
			$data['date'] = $value['date'];
			$data['offline'] = $value['offline'];
			$data['city'] = $value['city'];
			$data['comment'] = M('comment','ws_') -> where("page_id = %d",$value['id']) -> count();
			array_push($my_page, $data);
		}
		$this->assign('page',$my_page);
		$this->display();
	}
	public function offline() {
		M('page','ws_') -> where("id = %d",I('page_id')) -> save(array("offline" => '1'));
		echo 'SUCCESS';
	}
}
?>