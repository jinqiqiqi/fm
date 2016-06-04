<?php
namespace WeSite\Controller;
use Think\Controller;
class CommentController extends Controller {
	public function index() {
		$wechat = M('cur_wechat') -> where("1 = 1") -> find();
		$map ['token'] = $wechat['token'];
    	$info = M ( 'wechat' )->where ( $map )->find ();

			$callback = GetCurUrl ();	
			$param ['appid'] = $info ['appid'];				
			if (! isset ( $_GET ['getOpenId'] )) {
				$param ['redirect_uri'] = $callback . '&getOpenId=1';
				$param ['response_type'] = 'code';
				$param ['scope'] = 'snsapi_userinfo';
				$param ['state'] = 'STATE';
				$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?' . http_build_query ( $param ) . '#wechat_redirect';
				redirect ( $url );
			} elseif ($_GET ['state']) {
				$param ['secret'] = $info ['appsecret'];
				$param ['code'] = I ( 'code' );
				$param ['grant_type'] = 'authorization_code';
						
				$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?' . http_build_query ( $param );
				$content = httpGet ( $url );
				$content = json_decode ( $content, true );
				$url = "https://api.weixin.qq.com/sns/userinfo?access_token=" . $content['access_token'] . "&openid=" . $content['openid'] . "&lang=zh_CN";
				$res = httpGet($url);
				$res = json_decode($res, true);
				$openid = $res['openid'];
				$member = M('member') -> where("openid = '%s'",$openid) -> find();
				if(!$member) {
					$data['token'] = $wechat['token'];
					$data['openid'] = $openid;
					$data['nickname'] = $res['nickname'];
					$data['headimgurl'] = $res['headimgurl'];
					M('member') -> add($data);
				} else {
					$data['nickname'] = $res['nickname'];
					$data['headimgurl'] = $res['headimgurl'];
					M('member') -> where("openid = '%s'",$openid) -> save($data);
				}
				get_openid($openid);
			}
		$this->assign('page_id',I('id'));
		$this->display();
	}
	public function upload_pic() {
		$img_type = '.jpg';
		$pic_name = date("YmdHis") . rand(1,10000) . $img_type; //命名图片名称
		$pic_path = "./Public/Uploads/wesite/" . $pic_name;
		move_uploaded_file($_FILES["img_comment"]["tmp_name"],$pic_path);
		echo $pic_name;
	}
	public function submit() {
		$openid = get_openid();
		$member = M('member') -> where("openid = '%s'",$openid) -> find();
		$data['page_id'] = I('page_id');
		$data['openid'] = $openid;
		$data['nickname'] = $member['nickname'];
		$data['headimgurl'] = $member['headimgurl'];
		$data['weixinid'] = I('weixinid');
		$data['comment'] = I('comment');
		$data['img_comment'] = I('img_comment');
		$data['date'] = time();
		M('comment','ws_') -> add($data);
		$page = M('page','ws_') -> where("id = %d",I('page_id')) -> find();
		$page_openid = $page['openid'];		
		$wechat = M('cur_wechat') -> where("1 = 1") -> find();
		$token = $wechat['token'];
		$content = '{
		    "touser":"'.$page_openid.'",
		    "msgtype":"text",
		    "text":
		    {
		         "content":"'.$member['nickname'].' 给你留言了！快去看看吧！"
		    }
		}';
		$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=' . get_access_token($wechat['token']);
		$res = httpPost($url,$content);

		echo "SUCCESS";
	}
}
?>