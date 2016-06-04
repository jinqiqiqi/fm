<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<title>[友媒]朋友帮你找寻靠谱的Ta</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link rel="stylesheet" href="/Public/weui/css/weui.css">
<link rel="stylesheet" href="/Public/css/font-awesome.min.css">
<script src="/Public/js/jquery-1.11.3.min.js"></script>
<script src="/Public/js/ajaxfileupload.js"></script>
<script src="/Public/js/jquery.cityselect.js"></script>

<body style="background-color: #F3F3F3">
<div style="width:100%;float:none">
	<div style="width:100%;float:left">
		<img width="100%" height="auto" src="/Public/wesite/img/logo.jpg" />
	</div>
</div>
	<div class="weui_cells_title">上传封面照片</div>
	<div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_bd">                        
                        <div class="weui_uploader_input_wrp">
                            <input class="weui_uploader_input" id="img_front" name="img_front" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple="">
                        </div>
                        <div style="display:inline-block">
							<img id="img_front_prev" height="79px" width="auto" src="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    	var img_front_sel = false;
		$(function(){
            $("#img_front").change(function(e){
                $("#loadingToast p").html("图片上传中...")
                $("#loadingToast").show();
                var file = e.target.files[0]||e.dataTransfer.files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload=function(){
                        getImgData(this.result,orientation,function(data){
                            //这里可以使用校正后的图片data了
                            img_front_sel = true;
                            $("#img_front_prev").attr('src',data);
                            upload_pic('img_front');
                        }); 
                        //$("<img src='"+this.result+"'/>").appendTo("body");
                    }
                    reader.readAsDataURL(file);
                }
            });
        })
        function getImgData(img,dir,next){
            var image=new Image();
            image.onload=function(){
                var degree=0,drawWidth,drawHeight,width,height;   drawWidth=this.naturalWidth;
                drawHeight=this.naturalHeight;
                //以下改变一下图片大小
                var maxSide = Math.max(drawWidth, drawHeight);
                if (maxSide > 1024) {
                    var minSide = Math.min(drawWidth, drawHeight);     minSide = minSide / maxSide * 1024;
                    maxSide = 1024;
                    if (drawWidth > drawHeight) {
                        drawWidth = maxSide;
                        drawHeight = minSide;
                    } else {
                        drawWidth = minSide;
                        drawHeight = maxSide;
                    }
                }
                var canvas=document.createElement('canvas');
                canvas.width=width=drawWidth;
                canvas.height=height=drawHeight;
                var context=canvas.getContext('2d');   
                //判断图片方向，重置canvas大小，确定旋转角度，iphone默认的是home键在右方的横屏拍摄方式
                switch(dir){
                    //iphone横屏拍摄，此时home键在左侧
                    case 3:
                        degree=180;
                        drawWidth=-width;
                        drawHeight=-height;
                        break;
                        //iphone竖屏拍摄，此时home键在下方(正常拿手机的方向)
                    case 6:
                        canvas.width=height;
                        canvas.height=width;
                        degree=90;
                        drawWidth=width;
                        drawHeight=-height;
                        break;
                        //iphone竖屏拍摄，此时home键在上方
                    case 8:
                        canvas.width=height;
                        canvas.height=width;
                        degree=270;
                        drawWidth=-width;
                        drawHeight=height;
                        break;
                }
                //使用canvas旋转校正
                context.rotate(degree*Math.PI/180);
                context.drawImage(this,0,0,drawWidth,drawHeight);
                //返回校正图片
                next(canvas.toDataURL("image/jpeg",.8));
            }
            image.src=img;
        }
	</script>	
    <div class="weui_cells_title">个人信息</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd" style="width:25%"><label class="weui_label" style="width:100%">标题</label></div>
            <div class="weui_cell_bd weui_cell_primary" style="width:75%">
                <input class="weui_input" type="text" id="title" placeholder="给你的挂牌展示页拟一个标题"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd" style="width:25%"><label class="weui_label" style="width:100%">昵称</label></div>
            <div class="weui_cell_bd weui_cell_primary" style="width:75%">
                <input class="weui_input" type="text" id="nickname" placeholder="给自己起一个朗朗上口的昵称"/>
            </div>
        </div>  
        <div class="weui_cell">
            <div class="weui_cell_hd" style="width:25%"><label class="weui_label" style="width:100%">年龄</label></div>
            <div class="weui_cell_bd weui_cell_primary" style="width:75%">
                <input class="weui_input" type="number" id="age" pattern="[0-9]*" placeholder="输入出生年份"/>
            </div>
        </div>        
    </div>
    <div class="weui_cells_title">所在省、市</div>
    <div id="city_select" class="weui_cells">
        <div class="weui_cell weui_cell_select weui_select_after">
            <div class="weui_cell_hd" style="width:20%">
                <label for="" class="weui_label" style="width:100%">省</label>
            </div>
            <div class="weui_cell_bd weui_cell_primary" style="width:80%">
                <select id="provience" class="prov weui_select" name="select1">
                </select>
            </div>
        </div>
        <div class="weui_cell weui_cell_select weui_select_after">
            <div class="weui_cell_hd" style="width:20%">
                <label for="" class="weui_label" style="width:100%">市</label>
            </div>
            <div class="weui_cell_bd weui_cell_primary" style="width:80%">
                <select id="city" class="city weui_select" name="select2">
                </select>
            </div>
        </div>
    </div>
    <script>
    	$(function() {
         	$("#city_select").citySelect({
                prov: "北京",
                nodata: "none"
            });
        });
    </script>
    <div class="weui_cells_title">性别</div>
    <div class="weui_cells weui_cells_radio">
        <label class="weui_cell weui_check_label" for="x11">
            <div class="weui_cell_bd weui_cell_primary">
                <p>男</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="gender" value="男" id="x11">
                <span class="weui_icon_checked"></span>
            </div>
        </label>
        <label class="weui_cell weui_check_label" for="x12">
            <div class="weui_cell_bd weui_cell_primary">
                <p>女</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" name="gender" value="女" class="weui_check" id="x12" checked="checked">
                <span class="weui_icon_checked"></span>
            </div>
        </label>
    </div>
    <div class="weui_cells_title">说说自己</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea id="my_skill" class="weui_textarea" placeholder="简单介绍一下自己" rows="3" maxlength="800"></textarea>
                <div class="weui_textarea_counter">上限400字</div>
            </div>
        </div>
    </div>
    <div class="weui_cells_title">谈谈期望</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea id="want_skill" class="weui_textarea" placeholder="说说对于Ta的期望" rows="3" maxlength="800"></textarea>
                <div class="weui_textarea_counter">上限400字</div>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_hd weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">最多添加3张图片</div>
                        <div class="weui_cell_ft">0/3</div>
                    </div>
                    <div class="weui_uploader_bd">
                        <div style="float:left;margin-right:10px">
							<img id="img_1_pre" height="79px" width="auto" src="" />
                        </div>
                        <div style="float:left;margin-right:10px">
							<img id="img_2_pre" height="79px" width="auto" src="" />
                        </div>
                        <div style="float:left;margin-right:10px">
							<img id="img_3_pre" height="79px" width="auto" src="" />
                        </div>
                        <div class="weui_uploader_input_wrp">
                            <input class="weui_uploader_input" id="img_1" name="img_1" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple />
                        </div>
                        <div class="weui_uploader_input_wrp" style="display:none">
                            <input class="weui_uploader_input" id="img_2" name="img_2" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple />
                        </div>
                        <div class="weui_uploader_input_wrp" style="display:none">
                            <input class="weui_uploader_input" id="img_3" name="img_3" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    	var img_1_sel = false;
    	var img_2_sel = false;
    	var img_3_sel = false;
    	$(function(){
            $("#img_1").change(function(e){
                var file = e.target.files[0]||e.dataTransfer.files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload=function(){
                        getImgData(this.result,orientation,function(data){
                            //这里可以使用校正后的图片data了
                            $("#img_1").parent().hide();
                            $("#img_2").parent().show();
                            $("#img_1_pre").attr('src',data);
                            img_1_sel = true;
                        }); 
                        //$("<img src='"+this.result+"'/>").appendTo("body");
                    }
                    reader.readAsDataURL(file);
                }
            });
            $("#img_2").change(function(e){
                var file = e.target.files[0]||e.dataTransfer.files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload=function(){
                        getImgData(this.result,orientation,function(data){
                            //这里可以使用校正后的图片data了
                            $("#img_2").parent().hide();
                            $("#img_3").parent().show();
                            $("#img_2_pre").attr('src',data);
                            img_2_sel = true;
                        }); 
                        //$("<img src='"+this.result+"'/>").appendTo("body");
                    }
                    reader.readAsDataURL(file);
                }
            });
            $("#img_3").change(function(e){
                var file = e.target.files[0]||e.dataTransfer.files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload=function(){
                        getImgData(this.result,orientation,function(data){
                            //这里可以使用校正后的图片data了
                            $("#img_3_pre").attr('src',data);
                            img_3_sel = true;
                        }); 
                        //$("<img src='"+this.result+"'/>").appendTo("body");
                    }
                    reader.readAsDataURL(file);
                }
            });
        })
    </script>
    <div style="height:60px"></div>
    <div id="loadingToast" class="weui_loading_toast" style="display:none;">
        <div class="weui_mask_transparent"></div>
        <div class="weui_toast">
            <div class="weui_loading">
                <!-- :) -->
                <div class="weui_loading_leaf weui_loading_leaf_0"></div>
                <div class="weui_loading_leaf weui_loading_leaf_1"></div>
                <div class="weui_loading_leaf weui_loading_leaf_2"></div>
                <div class="weui_loading_leaf weui_loading_leaf_3"></div>
                <div class="weui_loading_leaf weui_loading_leaf_4"></div>
                <div class="weui_loading_leaf weui_loading_leaf_5"></div>
                <div class="weui_loading_leaf weui_loading_leaf_6"></div>
                <div class="weui_loading_leaf weui_loading_leaf_7"></div>
                <div class="weui_loading_leaf weui_loading_leaf_8"></div>
                <div class="weui_loading_leaf weui_loading_leaf_9"></div>
                <div class="weui_loading_leaf weui_loading_leaf_10"></div>
                <div class="weui_loading_leaf weui_loading_leaf_11"></div>
            </div>
            <p class="weui_toast_content">...</p>
        </div>
    </div>
    <div style="position:fixed;bottom:0px;width:100%;background-color: #009FC6;height:40px;line-height: 40px;text-align:center;color:white" onClick="submit()">
		<i class="fa fa-volume-up"></i>&nbsp;确认提交
    </div>
</body>
<script>
var img_front_name = "";
var img_1_name = "";
var img_2_name = "";
var img_3_name = "";
function submit() {
    $("#loadingToast p").html("数据上传中...");
	if($("#title").val() == "") {
		alert("请输入标题！");
		$("#title").focus();
	} else if ($("#nickname").val() == "") {
		alert("请输入昵称！");
		$("#nickname").focus();
	} else if ($("#age").val() == "") {
		alert("请输入出生年份！");
		$("#age").focus();
	} else if ($("#age").val() > 2016 || $("#age").val() < 1900) {
		alert("请输入正确出生年份！");
		$("#age").focus();
	} else if (img_front_sel == false) {
		alert("请上传封面照片！");
	} else {
        if(img_1_sel == true) {
            $("#loadingToast").show();
            upload_pic('img_1');
        } else if (img_2_sel == true) {
            $("#loadingToast").show();
            upload_pic('img_2');
        } else if (img_3_sel == true) {
            $("#loadingToast").show();
            upload_pic('img_3');
        } else {
            $("#loadingToast").show();
            upload_data();
        }
	}
}
function upload_pic(id) {
	$.ajaxFileUpload({
        url: '/index.php/WeSite/Register/upload_pic_'+id, 
        secureuri: false, //一般设置为false
        fileElementId: id, // 上传文件的id、name属性名
        dataType: 'text', //返回值类型，一般设置为json、application/json
        success: function(data, status){  
        	if(id == 'img_front') {
            	img_front_name = data;
                $("#loadingToast").hide();
        	} else if (id == 'img_1') {
        		img_1_name = data;
        		if (img_2_sel == true) {
            		upload_pic('img_2');
            	} else if (img_3_sel == true) {
            		upload_pic('img_3');
            	} else {
            		upload_data();
            	}
        	} else if (id == 'img_2') {
        		img_2_name = data;
        		if (img_3_sel == true) {
            		upload_pic('img_3');
            	} else {
            		upload_data();
            	}
        	} else if (id == 'img_3') {
        		img_3_name = data;
        		upload_data();
        	}
        },
        error: function(data, status, e){ 
            alert(e);
        }
    });
}
var submitting = false;
function upload_data() {
    if(submitting == false) {
        submitting = true;
        $.post("/index.php/WeSite/Register/submit",{
                title:$("#title").val(),
                provience:$("#provience").val(),
                city:$("#city").val(),
                nickname:$("#nickname").val(),
                age:$("#age").val(),
                gender:$('input:radio[name="gender"]:checked').val(),
                my_skill:$("#my_skill").val(),
                want_skill:$("#want_skill").val(),
                img_front:img_front_name,
                img_1:img_1_name,
                img_2:img_2_name,
                img_3:img_3_name
            },
            function(data) {
                if(data.status == 'SUCCESS') {
                    $("#loadingToast").hide();
                    window.location.href = '/index.php/WeSite/Page/index/page_id/'+data.page_id;
                } else {
                    $("#loadingToast").hide();
                    alert("提交失败!");
                    submitting = false;
                }
            },
            'json'
        );
    }	
}
</script>
</html>