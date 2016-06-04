<?php
namespace WeSite\Controller;
use Think\Controller;
class RegisterController extends Controller {
	public function index() {
		$wechat = M('cur_wechat') -> where("1 = 1") -> find();
		$map ['token'] = $wechat['token'];
		get_token($wechat['token']);
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

		$this->display();
	}
	function image_resize($f, $t, $tw, $th){
        $temp = array(1=>'gif', 2=>'jpeg', 3=>'png');
        list($fw, $fh, $tmp) = getimagesize($f);
        if(!$temp[$tmp]){
                return false;
        }
        $tmp = $temp[$tmp];
        $infunc = "imagecreatefrom$tmp";
        $outfunc = "image$tmp";
 
        $fimg = $infunc($f);
        // 把图片铺满要缩放的区域
        if($fw/$tw > $fh/$th){
            $zh = $th;
            $zw = $zh*($fw/$fh);
            $_zw = ($zw-$tw)/2;
        }else{
            $zw = $tw;
            $zh = $zw*($fh/$fw);
            $_zh = ($zh-$th)/2;
        }
        $zimg = imagecreatetruecolor($zw, $zh);
        // 先把图像放满区域
        imagecopyresampled($zimg, $fimg, 0,0, 0,0, $zw,$zh, $fw,$fh);
 
        // 再截取到指定的宽高度
        $timg = imagecreatetruecolor($tw, $th);
        imagecopyresampled($timg, $zimg, 0,0, 0+$_zw,0+$_zh, $tw,$th, $zw-$_zw*2,$zh-$_zh*2);

        if($outfunc($timg, $t)){
                return true;
        }else{
                return false;
        }
	}
	public function upload_pic_img_front() {
		$img_type = strstr($_FILES['img_front']['name'],'.');
		$pic_name = date("YmdHis") . rand(1,10000) . $img_type; //命名图片名称
		$pic_path = "./Public/Uploads/wesite/" . $pic_name;
		$this->image_resize($_FILES["img_front"]["tmp_name"],$pic_path,600,600);
		unlink($_FILES["img_front"]["tmp_name"]);
		//move_uploaded_file($_FILES["img_front"]["tmp_name"],$pic_path);
		echo $pic_name;
	}
	public function upload_pic_img_1() {
		$img_type = '.jpg';
		$pic_name = date("YmdHis") . rand(1,10000) . $img_type; //命名图片名称
		$pic_path = "./Public/Uploads/wesite/" . $pic_name;
		$info = getimagesize($_FILES["img_1"]["tmp_name"]);
		$data['width'] = $info[0];
		$data['height'] = $info[1];
		$this->image_resize($_FILES["img_1"]["tmp_name"],$pic_path,600,600*$data['height']/$data['width']);
		unlink($_FILES["img_1"]["tmp_name"]);
		//move_uploaded_file($_FILES["img_1"]["tmp_name"],$pic_path);
		echo $pic_name;
	}
	public function upload_pic_img_2() {
		$img_type = '.jpg';
		$pic_name = date("YmdHis") . rand(1,10000) . $img_type; //命名图片名称
		$pic_path = "./Public/Uploads/wesite/" . $pic_name;		
		$info = getimagesize($_FILES["img_2"]["tmp_name"]);
		$data['width'] = $info[0];
		$data['height'] = $info[1];
		$this->image_resize($_FILES["img_2"]["tmp_name"],$pic_path,600,600*$data['height']/$data['width']);
		unlink($_FILES["img_2"]["tmp_name"]);
		//move_uploaded_file($_FILES["img_2"]["tmp_name"],$pic_path);
		echo $pic_name;
	}
	public function upload_pic_img_3() {
		$img_type = '.jpg';
		$pic_name = date("YmdHis") . rand(1,10000) . $img_type; //命名图片名称
		$pic_path = "./Public/Uploads/wesite/" . $pic_name;
		$info = getimagesize($_FILES["img_3"]["tmp_name"]);
		$data['width'] = $info[0];
		$data['height'] = $info[1];
		$this->image_resize($_FILES["img_3"]["tmp_name"],$pic_path,600,600*$data['height']/$data['width']);
		unlink($_FILES["img_3"]["tmp_name"]);
		//move_uploaded_file($_FILES["img_2"]["tmp_name"],$pic_path);
		echo $pic_name;
	}
	public function submit() {
		$data['openid'] = get_openid();
		$data['title'] = I('title');
		$data['nickname'] = I('nickname');
		$data['provience'] = I('provience');
		$data['city'] = I('city');
		$data['age'] = I('age');
		$data['gender'] = I('gender');
		$data['my_skill'] = I('my_skill');
		$data['want_skill'] = I('want_skill');
		$data['img_front'] = I('img_front');
		$data['img_1'] = I('img_1');
		$data['img_2'] = I('img_2');
		$data['img_3'] = I('img_3');
		$data['date'] = time();
		$id = M('page','ws_') -> add($data);
		$reply['status'] = 'SUCCESS';
		$reply['page_id'] = $id;
		echo json_encode($reply);
	}
}
?>