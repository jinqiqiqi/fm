<?php
namespace WeSite\Controller;
use Think\Controller;
class BoardController extends Controller {
	public function index() {
		$page = M('page','ws_') -> where("id = %d",I('page_id')) -> find();
		$this->assign('page',$page);
		$comment = M('comment','ws_') -> where("page_id = %d",I('page_id')) -> select();
		$this->assign('comment',$comment);
		$this->display();
	}
}
?>