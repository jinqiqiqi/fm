<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>展示页管理中心</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link rel="stylesheet" href="/Public/weui/css/weui.css">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<script src="/Public/js/jquery-1.11.3.min.js"></script>
<script src="/Public/js/ajaxfileupload.js"></script>
<script src="/Public/js/jquery.cityselect.js"></script>
<style>
.title{
    font-weight:bold;
    font-size:150%;
    white-space:normal
}
</style>
<body style="background-color: #F3F3F3">
<div style="width:100%;float:none">
	<div style="width:100%;float:left">
		<img width="100%" height="auto" src="/Public/wesite/img/logo.jpg" />
	</div>
</div>
<div style="margin:10px">
    <?php if(is_array($page)): $i = 0; $__LIST__ = $page;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="title" onClick="window.location.href='/index.php/WeSite/Page/index/page_id/<?php echo ($vo["id"]); ?>'">
            【<?php echo ($vo["city"]); ?>】<?php echo ($vo["title"]); ?>
        </div>
        <div>
            <div style="width:100%;float:none">
                <div style="width:80%;float:left">
                    <span style="color:#01A6C1"><i class="fa fa-clock-o"></i></span>
                    <span style="color:grey"><?php echo date('m-d',$vo['date']); ?>&nbsp;发布</span>
                    <span>&#12288;</span>
                    <span style="color:#01A6C1"><i class="fa fa-user"></i></span>
                    <span><a href="javascript:board(<?php echo ($vo["id"]); ?>)"><span><?php echo ($vo["comment"]); ?></span>人留言</a></span>
                </div>
                <div id="status_<?php echo ($vo["id"]); ?>" style="width:20%;float:right;text-align:center">
                    <?php if($vo["offline"] == '0'): ?><a href="javascript:offline(<?php echo ($vo["id"]); ?>,'<?php echo ($vo["city"]); ?>','<?php echo ($vo["title"]); ?>')" style="color:red;text-decoration:underline;">下线</a>
                    <?php else: ?>
                        <span style="color:grey">(已下线)</span><?php endif; ?>
                </div>
            </div>
            
        </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="weui_dialog_confirm" style="display:none">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd"><strong class="weui_dialog_title">下线提醒</strong></div>
        <div class="weui_dialog_bd">自定义弹窗内容，居左对齐显示，告知需要确认的信息等</div>
        <div class="weui_dialog_ft">
            <a href="#" class="weui_btn_dialog default" onClick="cancel()">取消</a>
            <a href="#" class="weui_btn_dialog primary" onClick="check()">确定</a>
        </div>
    </div>
</div>
</body>
<script>
function board(id) {
    window.location.href="/index.php/WeSite/Board/index/page_id/"+id;
}
var to_page_id;
var to_city;
var to_title;
function offline(page_id,city,title) {
    to_page_id = page_id;
    to_city = city;
    to_title = title;
    $(".weui_dialog_bd").html("下线：【"+city+"】"+title);
    $(".weui_dialog_confirm").show();
}
function cancel() {
    $(".weui_dialog_confirm").hide();
}
function check() {
    $.post("/index.php/WeSite/Person/offline",{
            page_id:to_page_id
        },
        function(data) {
            if(data == 'SUCCESS') {
                $(".weui_dialog_confirm").hide();
                $("#status_"+to_page_id).html('<span style="color:grey">(已下线)</span>');
            }
        },
        'text'
    );
}
</script>
</html>