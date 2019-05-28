<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo ($title); ?></title>

<!-- 旧的代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css"> -->

<!-- 新的代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/base.css">
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/accountManage.css">
<link rel="stylesheet" href="/Public/home/wap/css/Setuname.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>
<script src="/Public/home/wap/js/mui.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>


<body>
	<!-- 旧的代码 -->
	<!-- <div class="header">
	    <div class="header_l">
	    <a href="javascript:history.go(-1)"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	    </div>
		<?php if(($type) == "1"): ?><div class="header_c"><h2><?php echo (L("uplogpwd")); ?></h2></div>
		<?php else: ?>
			<div class="header_c"><h2><?php echo (L("paypwdup")); ?></h2></div><?php endif; ?>

	    <div class="header_r"></div>
	</div>

     <div class="big_width100">
        <div class="add_bank_add_gr">
	       <div class="fill_sty add_gr_b10">
	       	<p><?php echo (L("oldpwd")); ?></p>
	       	<input type="password" name="password" class="password" placeholder="<?php echo (L("srjmm")); ?>"   />
	       </div>
	       <div class="fill_sty add_gr_b10 mababno">
	       	<p><?php echo (L("newpwd")); ?></p>
	       	<input type="password" name="password" class="passwordrepat" placeholder="<?php echo (L("srxmm")); ?>"   />
			   <input type="hidden" value="<?php echo ($type); ?>" class="pwdtype">
	       </div>
	     </div>

	        <div class="wangjmim_se">
				<?php if(($type) == "1"): ?><a href="<?php echo U('login/getpsw');?>"><?php echo (L("forgelogpwd")); ?></a>
					<?php else: ?>
					<a href="<?php echo U('login/getpswpay');?>"><?php echo (L("wjzfmm")); ?></a><?php endif; ?>
	        </div>

	       <div class="buttonGeoup">
	       		<a href="javascript:void(0)" class="not_next ljzf_but "><?php echo (L("termine")); ?></a>
	       </div>
	</div> -->

	<!-- 新的代码 -->
	<!-- 头部 -->
	<div class="hear">
		<a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
		<?php echo ($title); ?>
	</div>

	<!-- 密码 -->
	<div class="user_info">
		<form class="mui-input-group">
			<div class="mui-input-row user_info_lis div_psw">
				<label class="name pwd"><?php echo (L("oldpwd")); ?></label>
				<input type="password" class=" pwd_input password" placeholder=""  id="demo_input">
				<img src="/Public/home/wap/images/keshi.png" alt="" id="demo_img"  onclick="hideShowPsw()">
			</div>
			<div class="mui-input-row user_info_lis div_psw">
				<label class="name pwd"><?php echo (L("newpwd")); ?></label>
				<input type="password" class=" pwd_input passwordrepat" placeholder="" id="demo_input1">
					<input type="hidden" value="<?php echo ($type); ?>" class="pwdtype">
				<img src="/Public/home/wap/images/mima.png" alt="" id="demo_img1" onclick="hideShowPsw1()">
			</div>
		</form>
	</div>

	<!-- 忘记密码 -->
	<div class="busy fr">
		<?php if(($type) == "1"): ?><a href="<?php echo U('login/getpsw');?>"><?php echo (L("forgelogpwd")); ?></a>
			<?php else: ?>
			<a href="<?php echo U('login/getpswpay');?>"><?php echo (L("wjzfmm")); ?></a><?php endif; ?>
	</div>

	<!-- 保存按钮 -->
	<div class="save_btn  pwd_save"><?php echo (L("bc")); ?></div>


	<!--错误提示-->
	<input type="hidden" id="jmmbnwk" value="<?php echo (L("jmmbnwk")); ?>">
	<input type="hidden" id="xmmbnwk" value="<?php echo (L("xmmbnwk")); ?>"> <!--新密码不能为空哦-->
	<input type="hidden" id="jymmznw6w" value="<?php echo (L("jymmznw6w")); ?>">
</body>

</html>
<script>
	// input 的值不为空添加按钮样式
	$("form input").blur(function () {
		if (($("#demo_input").val().trim() != "") && ($("#demo_input1").val().trim() != "")) {
			$(".save_btn").addClass("active");
		} else {
			$(".save_btn").removeClass("active");
		}
	})

	//隐藏text block，显示password block
	// 点击显示隐藏密码
	function hideShowPsw() {
		var demoImg = document.getElementById("demo_img");
		var demoInput = document.getElementById("demo_input");
		if (demoInput.type == "password") {
			demoInput.type = "text";
			demo_img.src = "/Public/home/wap/images/keshi.png";
		} else {
			demoInput.type = "password";
			demo_img.src = "/Public/home/wap/images/mima.png";
		}
	}
	function hideShowPsw1() {
		var demoImg1 = document.getElementById("demo_img1");
		var demoInput1 = document.getElementById("demo_input1");
		if (demoInput1.type == "password") {
			demoInput1.type = "text";
			demo_img1.src = "/Public/home/wap/images/keshi.png";
		} else {
			demoInput1.type = "password";
			demo_img1.src = "/Public/home/wap/images/mima.png";
		}
	}


	$('.pwd_save').click(function () {
		//获取语言转换
		var jmmbnwk = $('#jmmbnwk').val();
		var xmmbnwk = $('#xmmbnwk').val();
		var jymmznw6w = $('#jymmznw6w').val();
		var pwdtype = $('.pwdtype').val();
		var pwd = $('.password').val();
		var pwdrpt = $('.passwordrepat').val(); //新密码
        if (pwd == '') {
            msg_alert(jmmbnwk);
        }
        if (pwdrpt == '') {
            msg_alert(xmmbnwk);
            return;
        }
		if(pwdtype==1){
			if(pwdrpt.length<6 || pwdrpt.length>=20){
				msg_alert("<?php echo (L("dlmmznwsz")); ?>")
				return;
			}
			var regEn = /[`~!@#$%^&*()_+<>?:"{},.\/;'[\]]/im,
				regCn = /[·！#￥（——）：；“”‘、，|《。》？、【】[\]]/im;
			if(regEn.test(pwdrpt) || regCn.test(pwdrpt)) {
				msg_alert("登录密码不能包涵特殊字符.");
				return;
			}
        }else if(pwdtype==2){
		    var reg =/^\d{6}$/;
		    if(!reg.test(pwdrpt)){
                msg_alert("<?php echo (L("jymmznw6w")); ?>")
                return;
			}
		}
		$.ajax({
			url: '/User/Setpwd',
			type: 'post',
			data: {
				'pwd': pwd,
				'pwdrpt': pwdrpt,
				'pwdtype': pwdtype
			},
			datatype: 'json',
			success: function (mes) {
				if (mes.status == 1) {

					msg_alert(mes.message, mes.url);
				} else {
					msg_alert(mes.message);
				}
			}
		})
	})
</script>
<link rel="stylesheet" href="/Public/home/wap/css/audio_notice.css">
<!--<link rel="stylesheet" href="/Public/Public/verify/index.js">-->
<!--长连接-->
<!--<script src="https://cdn.bootcss.com/socket.io/2.0.3/socket.io.js"></script>-->
    <div id="audio_notice" >
        <div class="audio">
            <a href="#"></a>
        </div>
        <p class="txt" name="jiaoyi">您的交易订单为08976432的订单已到账，请查收！</p>
        <div class="skip">
            <!-- <audio autoplay="autoplay" src="/Public/home/wap/images/Index/10719.mp3"></audio> -->
            <a href="#"></a>
        </div>
    </div>
<script src="/Public/home/wap/js/jquery-1.9.1.min.js"></script>
<!--弹框JS-->
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script>

$(function () {

        /**
         * 长链接
         * */
            var clickName=$(".Wechat_save").data("name");
             var uid = "<?php echo $_SESSION['userid'] ?>";
             console.log(uid);
           /* var socket = io('http://'+document.domain+':8081');

            socket.on('connect', function(){
                socket.emit('login', uid);
            });
            // 后端推送来消息时
            socket.on('new_msg', function(msg){
                $("[name='jiaoyi']").text(msg);
                $("#audio_notice").fadeIn(200).delay(2000).fadeOut(200);
                console.log(msg);
            });*/
          /**
           *获取选择默认的点击的事件
           *  */
            $(".update").click(function () {
                 $.ajax({
                     type : "POST",  //提交方式    
                     url : "/User/dele",
                     data : {
                         'ac':'update',
                         'clickName':clickName,
                         'id':$(this).data('val')
                     },
                     success : function(result) {
                         msg_alert(result);
                         if (clickName == "imtoken"){
                             window.location.href="/User/addImTokenGathering";
                         }else if(clickName == "weichar"){
                             window.location.href="/User/addWeChatWallet";
                         }else{
                             window.location.href="/User/addAlipayWallet";
                         }
                     },
                     error : function(){
                         msg_alert('服务器内部错误');
                     }
                 })
            });
            /**
             *
             * */
            $(".namex").click(function () {
                $(this).parents('.bank_box').siblings('.big_er_code').show()
            })

            $('.big_er_code').click(function () {
                $(this).hide();

            })
        function msg_alert(message,url){

            if(url){
                layer.msg(message,{time:3000},function(){
                    window.location.href=url;
                });
            }else{
                layer.msg(message,{time:3000});
            }

        }
          /**
           * ajax删除
           * */
          $("[name="+clickName+"_dele]").click(function () {
              var id = $(this).data("val");
              $.ajax({
                  type : "POST",  //提交方式    
                  url : "/User/dele",
                  data : {
                      'ac':'dele',
                      'clickName':clickName,
                      'id':id
                  },
                  success : function(result) {
                      msg_alert(result);
                      if (clickName == "imtoken"){
                          window.location.href="/User/addImTokenGathering";
                      }else if(clickName == "weichar"){
                          window.location.href="/User/addWeChatWallet";
                      }else{
                          window.location.href="/User/addAlipayWallet";
                      }
                  },
                  error : function(){
                      msg_alert('服务器内部错误');
                  }
              });
          });
            /**
             * 添加保存ajax
             */
            $(".Wechat_save").click(function () {
                var formData = new FormData();
                if ($("[name="+clickName+"_r]").is(".select_red")){
                    var checked = 1;
                }else{
                    var checked = 0;
                }
                var fp = $("[name="+clickName+"_file]")[0].files[0];//get文件
                formData.append('file_img',fp);//获取上传的文件
                formData.append('clickName',$(this).data("name"));//获取打开的是哪个页面
                formData.append('userName', $("[name="+clickName+"_name]").val());//判断添加输入的名字
                formData.append('sizeName',$("[name="+clickName+"_size]").val());//获取添加输入的账号
                formData.append('phoneName',$("[name="+clickName+"_phone]").val());//获取输入的手机号
                formData.append('checked',checked);//获取判断是否默认

                $.ajax({
                    type: "POST",
                    url: "/User/AddBound",
                    data:formData,
                    type:'post',
                    processData : false,
                    contentType : false,
                    async:false,
                    success:function(data){
                    //   console.log(data);/User/accountManage /User/addclickNameWallet
                        msg_alert(data);
                        if (clickName == "imtoken"){
                           setTimeout("window.location.href=\"/User/addImTokenGathering\"",1000);
                        }else if(clickName == "weichar"){

                            setTimeout("window.location.href=\"/User/addWeChatWallet\"",1000);
                        }else{

                            setTimeout("window.location.href=\"/User/addAlipayWallet\"",1000);
                        }

                    },
                    error:function(result){
                        //请求失败之后的操作
                    }
                });
            });
});

function fileType(obj){
    var clickName=$(".Wechat_save").data("name");
    var fileType=obj.value.substr(obj.value.lastIndexOf(".")).toLowerCase();//获得文件后缀名
    if(fileType != '.gif' && fileType != '.png' && fileType != '.jpg' && fileType != '.jpeg'){
        $(obj).tips({
            side:3,
            msg:'请上传图片格式的文件',
            bg:'#AE81FF',
            time:3
        });
        $(obj).val('');
    }else{
        var reader = new FileReader();
        reader.readAsDataURL(obj.files[0]);
        reader.onload = function (e) {
            $("[name="+clickName+"_image]").attr("src",this.result);
            $("[name="+clickName+"_image]").css('width','240px');
            $("[name="+clickName+"_image]").css('height','140px');
            $("[name="+clickName+"_ceshi]").text('');
        }
        $("#tu").show();
    }
}
function driverUpload() {
    var clickName=$(".Wechat_save").data("name");
    $("[name="+clickName+"_file]").click(); // 模拟文件上传按钮点击操作
}
$("#select").on('click', function () {
    $("#select").toggleClass("select_red");
})

</script>