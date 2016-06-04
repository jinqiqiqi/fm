<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<link rel="stylesheet" href="/Public/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/Public/admin/css/admin.css">
<script src="/Public/js/jquery-1.11.3.min.js"></script>
<script src="/Public/bootstrap/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<title>公众号管理</title>
</head>
<body>
	<header>
	  	<div class="inner">
	    	<div class="top-logo inner">
	      		<a href="" title="" id="web_logo">
	        		<img width="200" src="/Public/admin/img/logo.png"style="margin:10px 0px 10px 0px">
	      		</a>
	    	</div>
	  	</div>
	  	<div style="width:100%; margin:0 auto;height:37px;background-color: #464646;">
	    	<div id="menu">
		    	<ul class="menu">	
		    		<li>
		    			<a href="/admin.php/Wechat/Wechat/index"><span style="font-weight:bold;text-align:center;">公众号管理</span></a>
		    		</li> 
		    		<li>
		    			<a href="/admin.php/Message/Conf/index"><span style="font-weight:bold;text-align:center;">消息管理</span></a>
		    		</li>   		        	
	        	</ul>
	    	</div>
	  	</div>
	</header>
	<div class="sidebar inner">
		<div class="sb_nav">
	    	<div class="ti1-bg">
		      	<span>公众号</span>
	    	</div>
		    <h3 class="title1"></h3>
		    <div class="active" id="sidebar" data-csnow="39" data-class3="0" data-jsok="2">
		      	<dl class="list-none navnow">
		        	<dt id="part2_164">
			          	<a href="/admin.php/Wechat/Wechat/index" class="zm">
				            <span>
				              公众号管理
				            </span>
			          	</a>
		        	</dt>
		      	</dl>
		      	<dl class="list-none navnow">
		        	<dt id="part2_164">
			          	<a href="/admin.php/Wechat/Menu/index" class="zm">
				            <span>
				              自定义菜单
				            </span>
			          	</a>
		        	</dt>
		      	</dl>
		      	<div class="clear"></div>
		    </div>
	  	</div>

		<div class="sb_box br-bg">
		  	<h3 class="title">
		    	<span>编辑公众号</span>
		  	</h3>
		  	<div class="clear"></div>
		  	<div class="editor active" id="showtext">	
				<div class="panel panel-default">
				   	<div class="panel-heading">
				      	公众号信息
				   	</div>
				   	<div class="panel-body">
				   		<div class="form-group">
					      	<label for="name">微信名称</label>
					      	<input id="name" type="text" class="form-control" id="name" placeholder="<?php echo ($wechat["name"]); ?>" disabled>
					   	</div>
				      	<div class="form-group">
					      	<label for="name">原始ID</label>
					      	<input id="token" type="text" class="form-control" id="name" placeholder="<?php echo ($wechat["token"]); ?>" disabled>
					   	</div>
					   	<div class="form-group">
					      	<label for="name">AppID(应用ID)</label>
					      	<input id="appid" type="text" class="form-control" id="name" value="<?php echo ($wechat["appid"]); ?>">
					   	</div>
					   	<div class="form-group">
					      	<label for="name">AppSecret(应用密钥)</label>
					      	<input id="appsecret" type="text" class="form-control" id="name" value="<?php echo ($wechat["appsecret"]); ?>">
					   	</div>
					   	<div class="form-group">
					      	<button type="submit" class="btn btn-default" onclick="edit_wechat()">提交</button>
					   	</div>
				   	</div>		   	
				</div>
				<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				   	<div class="modal-dialog">
				      	<div class="modal-content">
				         	<div class="modal-header">
				            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				                  &times;
				            	</button>
				            	<h4 class="modal-title" id="myModalLabel">
				               		编辑公众号
				            	</h4>
				         	</div>
				         	<div class="modal-body">
				            	
				         	</div>
				         	<div class="modal-footer">
				            	<button type="button" class="btn btn-default" data-dismiss="modal">
				            		关闭
				            	</button>
				         	</div>
				      	</div><!-- /.modal-content -->
					</div><!-- /.modal -->
				</div>
				<script>
				var wechat_id = '<?php echo ($wechat["id"]); ?>';
				function edit_wechat() {
					$.post("/admin.php/Wechat/Wechat/edit_wechat",{
							id:wechat_id,
							appid:$("#appid").val(),
							appsecret:$("#appsecret").val()
						},
						function(data) {
							if(data == 'SUCCESS') {
								$("#add_modal .modal-body").html("提交成功！");
							} else if (data == 'NOEXIST') {
								$("#add_modal .modal-body").html("编辑的公众号不存在！");
							} else {
								$("#add_modal .modal-body").html("编辑失败！");
							}
							$("#add_modal").modal();
						},
						'text'
					);
				}
				</script>
				<div class="panel panel-default">
				   	<div class="panel-heading">
				      	公众号服务器配置
				   	</div>
				   	<div class="panel-body">
				      	<div class="form-group">
					      	<label for="name">URL</label>
					      	<input type="text" class="form-control" value="<?php echo ($server_url); ?>" id="name" disabled>
					   	</div>
					   	<div class="form-group">
					      	<label for="name">Token</label>
					      	<input type="text" class="form-control" value="<?php echo ($server_token); ?>" id="name" disabled>
					   	</div>
					   	<div style="margin:20px 25% auto 25%">
							<img width="100%" height="auto" src="/Public/admin/img/wechat/wechat_conf.png" />
					   	</div>
				   	</div>		   	
				</div>
			</div>
		</div>
	</div>
</body>
</html>