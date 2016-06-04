<?php
namespace Wechat\Controller;
use Think\Controller;
class MenuController extends Controller {
    public function index() {
        $cur_token = M('cur_wechat') -> select();
        if(count($cur_token) > 0) {
            $this->assign('cur_token',$cur_token[0]['token']);
        } else  {
            $this->assign('cur_token','NOEXIST');
        }
        $menu = array();
        $fl_menu = M('menu') -> where("token = '%s' AND level = %d",$cur_token[0]['token'],1) -> order('number') -> select();
        foreach ($fl_menu as $key => $value) {
            $menu_parent['name'] = $value['name'];
            $menu_parent['number'] = $value['number'];
            $menu_parent['type'] = $value['type'];
            $menu_parent['url'] = $value['url'];
            $menu_parent['id'] = $value['id'];
            $menu_child = array();
            $sl_menu = M('menu') -> where("token = '%s' AND parent = '%s'",$cur_token[0]['token'],$value['name']) -> order('number') -> select(); 
            foreach ($sl_menu as $k => $v) {
                $menu_tmp['name'] = $v['name'];
                $menu_tmp['number'] = $v['number'];
                $menu_tmp['type'] = $v['type'];
                $menu_tmp['url'] = $v['url'];
                $menu_tmp['id'] = $v['id'];
                array_push($menu_child, $menu_tmp);
            }
            $menu_parent['child'] = $menu_child;
            array_push($menu,$menu_parent);
        }
        $this->assign('menu',$menu);
    	$this->display();
    }
    public function add() {
        $cur_token = M('cur_wechat') -> select();
        $data['token'] = $cur_token[0]['token'];
        $data['name'] = I('name');
        $data['type'] = I('type');
        $data['number'] = I('number');
        $data['url'] = I('url');
        $data['parent'] = I('parent');
        $data['key'] = I('key');
        if(I('parent') == '无') {
            $data['level'] = 1;
        } else {
            $data['level'] = 2;
        }
        M('menu') -> add($data);
        echo 'SUCCESS';
    }
    public function delete() {
        $info = M('menu') -> where("id = %d",I('id')) -> delete();
        echo 'SUCCESS';
    }
    public function release() {
        $cur_token = M('cur_wechat') -> select();
        get_token($cur_token[0]['token']);
        $access_token = get_access_token();
        $menu_data = $this->create_menu_data();

        //$jsonmenu = str_replace('&quot;','"',I('menu'));
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $result = httpPost($url, $menu_data);
        echo $result;
    }
    function create_menu_data() {        
        $cur_token = M('cur_wechat') -> select();
        $parent = M('menu') -> where("token = '%s' AND level = %d",$cur_token[0]['token'],1) -> select();
        $button = array();
        foreach ($parent as $key => $value) {
            $parent_menu = array();
            if($value['type'] == '无事件一级菜单') {
                $parent_menu['name'] = urlencode($value['name']);
                $child = M('menu') -> where("token = '%s' AND parent = '%s'",$cur_token[0]['token'],$value['name']) -> select();
                if(count($child) > 0) {
                    $sub_menu = array();
                    foreach ($child as $k => $v) {
                        if($v['type'] == '跳转URL') {
                            $menu['type'] = 'view';
                            $menu['name'] = urlencode($v['name']);
                            $menu['url'] = htmlspecialchars_decode($v['url']);
                            array_push($sub_menu,$menu);
                        }
                    }
                    $parent_menu['sub_button'] = $sub_menu;
                }
            } elseif ($value['type'] == '跳转URL') {
                $parent_menu['type'] = 'view';
                $parent_menu['name'] = urlencode($value['name']);
                $parent_menu['url'] = htmlspecialchars_decode($value['url']);
            } elseif ($value['type'] == '点击推事件') {
                $parent_menu['type'] = 'click';
                $parent_menu['name'] = urlencode($value['name']);
                $parent_menu['key'] = urlencode($value['key']);
            }
            array_push($button,$parent_menu);
        }
        $menu_data['button'] = $button;
        return urldecode(json_encode($menu_data));
    }
}