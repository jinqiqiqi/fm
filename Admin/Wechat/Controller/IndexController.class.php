<?php
namespace Wechat\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index() {   		
    	include "wxapi.class.php";
		$wechatObj = new wechat();
    	if(IS_GET) { 
			$wechatObj->valid();
    	} else if (IS_POST) {
    		$this->handle_msg();
    	}
    }
    public function handle_msg() {
    	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
            the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $data = array();
            foreach($postObj as $key => $value) {
            	$data[$key] = strval($value);
            }
            $fromUsername = $data['FromUserName'];
            $toUsername = $data['ToUserName'];
            $msgType = $data['MsgType'];
            if($msgType == 'event') {
              	if($data['Event']=="subscribe") {
                    $conf = M('config') -> where("token = '%s'",$toUsername) -> find();
                    if($conf['message'] == 'SUBSCRIBE_POSTER') {
                        $ctr = A('Message/SubPoster');
                        $ctr -> subscribe($data);
                    } else if ($conf['message'] == 'ATHOMI') {
                        $qr = A('Message/Qrcode_Scan');
                        $qr->scan($data);                        
                    }
               	} elseif ($data['Event'] == "CLICK") {
                    if($data['EventKey'] == "MY_POSTER") {
                        $poster = A('Message/Poster');
                        $poster -> my_poster($fromUsername,$toUsername);           
                    }                    
                } else if ($data['Event'] == "LOCATION") {
                    $loc = A('Message/Location');
                    $loc -> report($data);
                }
            } else if($msgType == 'text') {
                $content = $data['Content'];
                $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";
                if(true) {
                    $msgType = "text";
                    $time = time();
                    $contentStr = '<a href="http://lokei.aliapp.com/index.php/KuaiDi_V2/Search/order/express/' . $content . '">点击查询</a>订单信息';
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }
            }
        } else {
            echo "";
            exit;
        }
    }
}