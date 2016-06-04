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
		    	<span>自定义菜单</span>
		  	</h3>
		  	<div class="clear"></div>
		  	<div class="editor active" id="showtext">	
		  		<button type="button" class="btn btn-success" onclick="release()">发布</button>
		  		<div style="width:100%;height:10px"></div>
		  		<table class="table table-bordered table-condensed table-striped" style="background-color: white">
				   	<thead style="border-top-left-radius: 3px;border-top-right-radius: 3px;background-color: #464646;color:white">
				      	<tr>
				         	<th class="col-sm-2">菜单名称</th>
				         	<th class="col-sm-2">菜单类别</th>
				         	<th class="col-sm-1">序号</th>
				         	<th class="col-sm-6">URL</th>
				         	<th class="col-sm-1">操作</th>
				      	</tr>
				   	</thead>
				   	<tbody>
				   		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="menu_<?php echo ($vo["id"]); ?>">					      	
					         	<td><i class="fa fa-plus-square" style="color:#EFAD4D"></i>&nbsp;<?php echo ($vo["name"]); ?></td>
					         	<td><?php echo ($vo["type"]); ?></td>
					         	<td><?php echo ($vo["number"]); ?></td>
					         	<td><?php echo ($vo["url"]); ?></td>
					         	<td><button type="button" class="btn btn-danger btn-xs" onclick="delete_menu('<?php echo ($vo["id"]); ?>')">删除</button></td>
					      	</tr>
					      	<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr id="menu_<?php echo ($v["id"]); ?>">					      	
						         	<td>&#12288;<?php echo ($v["name"]); ?></td>
						         	<td><?php echo ($v["type"]); ?></td>
						         	<td><?php echo ($v["number"]); ?></td>
						         	<td><?php echo ($v["url"]); ?></td>
						         	<td><button type="button" class="btn btn-danger btn-xs" onclick="delete_menu('<?php echo ($v["id"]); ?>')">删除</button></td>
						      	</tr><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
				   	</tbody>
				</table>
				<div style="text-align:right">
					<button type="button" class="btn btn-primary" onclick="add_menu()">+添加</button>
				</div>
				<div style="width:100%;height:20px"></div>
				<div id="add_menu_panel" class="panel panel-default" style="display:none">
				   	<div class="panel-heading">
				      	添加菜单
				   	</div>
				   	<div class="panel-body">
				      	<div class="form-group">
					      	<label for="name">菜单名称</label>
					      	<input id="name" type="text" class="form-control" id="name" placeholder="输入菜单名称">
					   	</div>
					   	<div class="form-group">
					      	<label for="name">一级菜单</label>
						    <select id="parent" class="form-control">
						        <option>无</option>
						        <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						    </select>
					   	</div>
				      	<div class="form-group">
					      	<label for="name">菜单类型</label>
						    <select id="type" class="form-control" onchange="select_type(this.options[this.options.selectedIndex].value)">
						        <option>无事件一级菜单</option>
						        <option>跳转URL</option>
						        <option>点击推事件</option>
						    </select>
					   	</div>
					   	<div class="form-group" style="display:none">
					      	<label for="name">序号</label>
					      	<input id="number" type="text" class="form-control" id="name" placeholder="输入菜单序号">
					   	</div>
					   	<div class="form-group" style="display:none">
					      	<label for="name">URL</label>
					      	<input id="url" type="text" class="form-control" id="name" placeholder="输入跳转到链接URL">
					   	</div>
					   	<div class="form-group" style="display:none">
					      	<label for="name">key</label>
					      	<input id="key" type="text" class="form-control" id="name" placeholder="输入key值">
					   	</div>
					   	<div class="form-group">
					   		<button type="submit" class="btn btn-default" onclick="cancel()">取消</button>
					      	<button type="submit" class="btn btn-default" onclick="add()">添加</button>
					   	</div>
				   	</div>
				</div>
				<div class="modal fade" id="releaseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				   	<div class="modal-dialog">
				      	<div class="modal-content">
				         	<div class="modal-header">
				            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				                  &times;
				            	</button>
				            	<h4 class="modal-title" id="myModalLabel">
				               		自定义菜单
				            	</h4>
				         	</div>
				         	<div class="modal-body">
				            	
				         	</div>
				         	<div class="modal-footer">
				            	<button type="button" class="btn btn-default" data-dismiss="modal">
				            		确认
				            	</button>
				         	</div>
				      	</div>
					</div>
				</div>
				<script>
				function hide() {
					$("#number").parent().hide();
					$("#url").parent().hide();
					$("#key").parent().hide();
				}
				function select_type(type) {
					hide();
					if(type == '跳转URL') {
						$("#number").parent().show();
						$("#url").parent().show();
					} else if(type == '点击推事件') {
						$("#number").parent().show();
						$("#key").parent().show();
					}
				}
				function release() {
					$.post("/admin.php/Wechat/Menu/release",
						function(data) {
							if(data.errcode == 0) {
								$("#releaseModal .modal-body").html("菜单发布成功！");
								$("#releaseModal").modal();
							}
						},
						'json'
					);
				}
				function add_menu() {
					$("#add_menu_panel").show();
				}
				function add() {
					$.post("/admin.php/Wechat/Menu/add",{
							name:$("#name").val(),
							parent:$("#parent").val(),
							type:$("#type").val(),
							number:$("#number").val(),
							url:$("#url").val(),
							key:$("#key").val()
						},
						function(data) {
							if(data == 'SUCCESS') {
								window.location.href="/admin.php/Wechat/Menu/index";
							}
						},
						'text'
					);
				}
				function cancel() {
					$("#add_menu_panel").hide();
				}
				function delete_menu(id) {
					$.post("/admin.php/Wechat/Menu/delete",{
							id:id
						},
						function(data) {
							if(data == 'SUCCESS') {
								$("#menu_"+id).hide();
							}
						},
						'text'
					);
				}
				</script>
			</div>
			<div class="modal fade" id="menu_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			   	<div class="modal-dialog">
			      	<div class="modal-content">
			         	<div class="modal-header">
			            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			                  &times;
			            	</button>
			            	<h4 class="modal-title" id="myModalLabel">
			               		自定义菜单
			            	</h4>
			         	</div>
			         	<div class="modal-body">
			            	
			         	</div>
			         	<div class="modal-footer">
			            	<button type="button" class="btn btn-default" onclick="add_wechat()">
			            		确认
			            	</button>
			         	</div>
			      	</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	var cur_token = '<?php echo ($cur_token); ?>';
	$(function(){
		if(cur_token == 'NOEXIST') {
			$("#menu_modal .modal-body").html("请先添加公众号，再设置公众号菜单！");
			$("#menu_modal").modal();
		}
	});
	function add_wechat() {
		window.location.href="/admin.php/Wechat/Wechat/add";
	}
</script>
</html>