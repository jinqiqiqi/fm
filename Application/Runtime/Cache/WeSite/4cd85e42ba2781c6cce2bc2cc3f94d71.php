<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<title>【<?php echo ($page["city"]); ?>】<?php echo ($page["title"]); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link rel="stylesheet" href="/Public/weui/css/weui.css">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<script src="/Public/js/jquery-1.11.3.min.js"></script>
<script src="/Public/js/ajaxfileupload.js"></script>
<script src="/Public/js/jquery.cityselect.js"></script>
<script src="/Public/js/jweixin-1.0.0.js"></script>
<style>
.info{
    font-size:120%;
    white-space:normal
}
</style>
<script>
    wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?php echo ($signPackage["appId"]); ?>', // 必填，公众号的唯一标识
            timestamp: '<?php echo ($signPackage["timestamp"]); ?>', // 必填，生成签名的时间戳
            nonceStr: '<?php echo ($signPackage["nonceStr"]); ?>', // 必填，生成签名的随机串
            signature: '<?php echo ($signPackage["signature"]); ?>',// 必填，签名，见附录1
            jsApiList: ['hideMenuItems','onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
        });

        wx.ready(function(){
            wx.hideMenuItems({
                menuList: ['menuItem:share:timeline'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
            });
            wx.onMenuShareAppMessage({
                title: '【<?php echo ($page["city"]); ?>】<?php echo ($page["title"]); ?>', // 分享标题
                desc: '这是来自好友分享的靠谱交友展示帖', // 分享描述
                link: 'http://umay.ren/index.php/WeSite/Page/index/page_id/<?php echo ($page["id"]); ?>', // 分享链接
                imgUrl: 'http://umay.ren/Public/Uploads/wesite/<?php echo ($page["img_front"]); ?>', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    //window.location.href="<?php echo ($url["url"]); ?>";
                },
                cancel: function () { 
                }
            });
            wx.onMenuShareTimeline({
                title: '【<?php echo ($page["city"]); ?>】<?php echo ($page["title"]); ?>', // 分享标题
                desc: '这是来自好友分享的靠谱交友展示帖', // 分享描述
                link: 'http://umay.ren/index.php/WeSite/Page/index/page_id/<?php echo ($page["id"]); ?>', // 分享链接
                imgUrl: 'http://umay.ren/Public/Uploads/wesite/<?php echo ($page["img_front"]); ?>', // 分享图标
                type: '', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () { 
                    //window.location.href="<?php echo ($url["url"]); ?>";
                },
                cancel: function () { 
                }
            })
        });
</script>
<body style="background-color: #F3F3F3">
<div style="width:100%;float:none">
	<div style="width:100%;float:left">
		<img width="100%" height="auto" src="/Public/wesite/img/logo.jpg" />
	</div>
</div>
<div style="margin:10px">
    <div style="height:35px"></div>
    <div style="width:100%">
        <img width="100%" height="auto" src="/Public/Uploads/wesite/<?php echo ($page["img_front"]); ?>" />
    </div>
    <div class="info">
        【昵称】：<?php echo ($page["nickname"]); ?>
    </div>
    <div class="info">
        【性别】：<?php echo ($page["gender"]); ?>
    </div>
    <div class="info">
        【年龄】：<?php echo ($page["age"]); ?>年
    </div>
<div style="height:10px"></div>
    <div class="info">
        【说说自己】：
    </div>
    <div class="info">
        <?php echo ($page["my_skill"]); ?>
    </div>
<div style="height:10px"></div>
    <div class="info">
        【谈谈期望】：
    </div>
    <div class="info">
        <?php echo ($page["want_skill"]); ?>
    </div>
    <div style="height:30px"></div>
    <?php if($page["img_1"] != ''): ?><div style="width:100%">
            <img width="80%" height="auto" src="/Public/Uploads/wesite/<?php echo ($page["img_1"]); ?>" />
        </div><?php endif; ?>
    <div style="height:10px"></div>
    <?php if($page["img_2"] != ''): ?><div style="width:100%">
            <img width="80%" height="auto" src="/Public/Uploads/wesite/<?php echo ($page["img_2"]); ?>" />
        </div><?php endif; ?>
    <div style="height:10px"></div>
    <?php if($page["img_3"] != ''): ?><div style="width:100%">
            <img width="80%" height="auto" src="/Public/Uploads/wesite/<?php echo ($page["img_3"]); ?>" />
        </div><?php endif; ?>
    <div style="height:50px"></div>
    <div style="width:100%;height:30px;float:none">
        <?php if($page["offline"] == '0'): ?><div style="width:30%;float:left;height:30px">
                <i class="fa fa-thumbs-up" style="color:red" onClick="zan('<?php echo ($page["id"]); ?>')"></i>赞(<span id="score" style="color:grey"><?php echo ($zan); ?></span>)
            </div>
            <div style="width:70%;float:left;height:30px">
                <div style="display:inline;height:30px;line-height: 30px;text-align:center;border:2px #FF6634 solid;border-top-left-radius:5px;border-bottom-left-radius: 5px;color:#FF6634;font-size:16px;padding:5px 10px 5px 10px" onClick="window.location.href='/index.php/WeSite/Comment/index/id/<?php echo ($page["id"]); ?>'">
                    我要留言
                </div>     
                <div style="display:inline;height:30px;line-height: 30px;text-align:center;border:2px #FF6634 solid;border-top-right-radius:5px;border-bottom-right-radius: 5px;color:white;background-color:#FF6634;font-size:16px;padding:5px 10px 5px 10px" onClick="window.location.href='/index.php/WeSite/Register/index'">
                    我也挂牌
                </div>
            </div>
        <?php else: ?>
            <div style="width:30%;float:left;height:30px">
                <i class="fa fa-thumbs-up" style="color:grey"></i>赞(<span id="score" style="color:grey"><?php echo ($zan); ?></span>)
            </div>
            <div style="width:70%;float:left;height:30px">
                <div style="display:inline;height:30px;line-height: 30px;text-align:center;border:2px grey solid;border-right:0px;border-top-left-radius:5px;border-bottom-left-radius: 5px;color:grey;font-size:16px;padding:5px 10px 5px 10px">
                    交换停止
                </div>
                <div style="display:inline;height:30px;line-height: 30px;text-align:center;border:2px #FF6634 solid;border-top-right-radius:5px;border-bottom-right-radius: 5px;color:white;background-color:#FF6634;font-size:16px;padding:5px 10px 5px 10px" onClick="window.location.href='/index.php/WeSite/Register/index'">
                    我也挂牌
                </div>
            </div><?php endif; ?>
    </div>                
</div>
<div style="height:30px"></div>
<div style="margin-left:10%;margin-right:10%">
    <img width="100%" height="auto" src="/Public/wesite/img/qrcode.jpg" />
</div>
</body>
<script>
function zan(page_id) {
    $.post("/index.php/WeSite/Page/zan",{
            page_id:page_id
        },
        function(data) {
            if(data == 'ZANED') {
                alert("您已点过赞！");
            } else if (data == 'SUCCESS') {
                $("#score").html(parseInt($("#score").html())+1);
            }
        },
        'text'
    );
}
</script>
</html>