<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>查看留言</title>
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
    <div class="title">
        【<?php echo ($page["city"]); ?>】<?php echo ($page["title"]); ?>
    </div>
    <div>
        <span style="color:#01A6C1"><i class="fa fa-clock-o"></i></span>
        <span style="color:grey"><?php echo date('m-d',$page['date']); ?>&nbsp;发布</span>
        <span>&#12288;</span>
        <span style="color:#01A6C1"><i class="fa fa-user"></i></span>
        <span style="color:grey"><?php echo count($comment); ?>人留言</span>
    </div>
    <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="width:100%;height:40px;float:none">
            <div style="width:20%;float:left;height:40px">
                <img width="40px" height="40px" src="<?php echo ($vo["headimgurl"]); ?>" />
            </div>
            <div style="width:80%;float:left;height:40px;line-height:40px">
                <?php echo ($vo["nickname"]); ?>(<?php echo ($vo["weixinid"]); ?>)
            </div>
        </div>
        <div class="info">
            【留言】：
        </div>
        <div class="info">
            <?php echo ($vo["comment"]); ?>
        </div>
        <?php if($vo["img_comment"] != ''): ?><div style="height:10px"></div>
            <div style="width:100%">
                <img width="80%" height="auto" src="/Public/Uploads/wesite/<?php echo ($vo["img_comment"]); ?>" />
            </div><?php endif; ?>
        <div style="height:25px"></div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</body>
<script>

</script>
</html>