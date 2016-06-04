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
		    	<span>公众号首页</span>
		  	</h3>
		  	<div class="clear"></div>		  	
		  	<div class="editor active" id="showtext">
		  		<div style="text-align:right;margin:10px">
					<button type="button" class="btn btn-success" onclick="window.location.href='/admin.php/Wechat/Wechat/add'">+添加</button>
		  		</div>
				<table class="table table-bordered table-condensed table-striped" style="background-color: white">
				   	<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;background-color: #464646;color:white">
				      	<tr>
				         	<th class="col-sm-5">原始ID</th>
				         	<th class="col-sm-5">公众号名称</th>
				         	<th class="col-sm-2">操作</th>
				      	</tr>
				   	</thead>
				   	<tbody>
				   		<?php if(is_array($wechat)): $i = 0; $__LIST__ = $wechat;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["token"] == $selected_token)): ?><tr id="wechat_<?php echo ($vo["id"]); ?>" style="background-color:#EFAD4D;color:white">
				   			<?php else: ?>
								<tr id="wechat_<?php echo ($vo["id"]); ?>"><?php endif; ?>					      	
					         	<td><?php echo ($vo["token"]); ?></td>
					         	<td><?php echo ($vo["name"]); ?></td>
					         	<td>
					         		<button type="button" class="btn btn-primary btn-xs" onclick="edit_wechat('<?php echo ($vo["id"]); ?>')">编辑</button>
					         		<button type="button" class="btn btn-danger btn-xs" onclick="delete_wechat('<?php echo ($vo["id"]); ?>','<?php echo ($vo["name"]); ?>')">删除</button>
					         		<button type="button" class="btn btn-info btn-xs" onclick="select_wechat('<?php echo ($vo["id"]); ?>','<?php echo ($vo["token"]); ?>','<?php echo ($vo["name"]); ?>')">选择</button>
					         	</td>
					      	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				   	</tbody>
				</table>
		  	</div>

		  	<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  	<div class="modal-content">
				   	<div class="modal-header">
				       	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				            &times;
				       	</button>
				       	<h4 class="modal-title" id="myModalLabel">
				       		删除公众号
				       	</h4>
				      	</div>
				      	<div class="modal-body">
				         	
				      	</div>
				      	<div class="modal-footer">
				      		<button type="button" class="btn btn-default" data-dismiss="modal">
				           		取消
				           	</button>
				          	<button type="button" class="btn btn-default" onclick="delete_check()">
				           		确定
				           	</button>
				       	</div>
				   	</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>
			<div class="modal fade" id="delete_fail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  	<div class="modal-content">
				   	<div class="modal-header">
				       	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				            &times;
				       	</button>
				       	<h4 class="modal-title" id="myModalLabel">
				       		删除公众号
				       	</h4>
				      	</div>
				      	<div class="modal-body">
				         	删除公众号失败！
				      	</div>
				      	<div class="modal-footer">
				          	<button type="button" class="btn btn-default" data-dismiss="modal">
				           		关闭
				           	</button>
				       	</div>
				   	</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>
			<div class="modal fade" id="select_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				  	<div class="modal-content">
				   	<div class="modal-header">
				       	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				            &times;
				       	</button>
				       	<h4 class="modal-title" id="myModalLabel">
				       		设置当前公众号
				       	</h4>
				      	</div>
				      	<div class="modal-body">
				         	
				      	</div>
				      	<div class="modal-footer">
				          	<button type="button" class="btn btn-default" data-dismiss="modal">
				           		关闭
				           	</button>
				           	<button type="button" class="btn btn-primary" onclick="select_check()">
				           		确定
				           	</button>
				       	</div>
				   	</div><!-- /.modal-content -->
				</div><!-- /.modal -->
			</div>
		</div>
	</div>	
	<script>
	function edit_wechat(id) {
		window.location.href="/admin.php/Wechat/Wechat/edit/id/"+id;
	}
	var to_delete_id;
	function delete_wechat(id,name) {
		to_delete_id = id;
		$("#delete_modal .modal-body").html("删除公众号" + name + "！");
		$("#delete_modal").modal();
	}
	function delete_check() {
		$.post("/admin.php/Wechat/Wechat/delete_wechat", {
				id:to_delete_id
			},
			function(data) {
				if(data == 'SUCCESS') {
					$("#wechat_"+to_delete_id).hide();
					$("#delete_modal").modal('hide');
				} else {
					$("#delete_fail_modal").modal();
				}			
			},
			'text'
		);
	}
	var selected_id;
	var selected_token;
	function select_wechat(id,token,name) {
		selected_id = id;
		selected_token = token;
		$("#select_modal .modal-body").html('设置公众号："' + name + '"为当前公众号？');
		$("#select_modal").modal();		
	}
	function select_check() {
		$.post("/admin.php/Wechat/Wechat/select_wechat", {
				token:selected_token
			},
			function(data) {
				if(data == 'SUCCESS') {
					$("tr[id^='wechat_']").each(function(){
					    $(this).css('background-color','white');
						$(this).css('color','black');
					});
					$("#wechat_"+selected_id).css('background-color','#EFAD4D');
					$("#wechat_"+selected_id).css('color','white');
				}
				$("#select_modal").modal('hide');
			},
			'text'
		);
	}
	</script>
</body>
</html>