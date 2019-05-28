<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- 字体颜色兼容 -->
<meta name="format-detection" content="telephone=no">
<title><?php echo (L("turnout")); ?></title>

<!-- 旧的代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css">
<link rel="stylesheet" href="/Public/home/wap/css/YangStyle.css"> -->


<!-- 新的代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/integralConversion.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>
<script src="/Public/home/wap/js/mui.min.js"></script>

<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>

<style>


</style>

<body>
	<!-- 旧的代码 -->
	<!-- <div class="header w-header">
		<div class="header_l">
			<a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
		</div>
		<div class="header_c">
			<h2><?php echo (L("turnout")); ?></h2>
		</div>
		<div class="header_r"><a href="<?php echo U('Index/Turncords');?>"><?php echo (L("zcjl")); ?></a></div>
	</div>

	<div class="big_width100">
		<div class="centBalance">
			<div class="Balance">
				<p><a class="balance"><?php echo (L("yue")); ?><br /><strong class="moneyS_icon"><img src="/Public/home/wap/images/integraimages/balance3030.png"><span
							 class="yue" style="color:#cfb263"><?php echo ($moneyinfo['cangku_num']); ?></span></strong></a></p>
			</div>
			<div class="Balance">
				<p><a class="balance"><?php echo (L("jifen")); ?><br /><strong class="moneyS_icon"><img src="/Public/home/wap/images/integraimages/balance3030.png"><span
							 class="jifen"><?php echo ($moneyinfo['fengmi_num']); ?></span></strong></a></p>
			</div>
			<div class="dLine"></div>
		</div>
		<div class="w-center">
			<div class="fill_sty">
				<h2><?php echo (L("rollOut")); ?></h2>
				<input type="number" name="other_account" placeholder="<?php echo (L("srsjhm")); ?>" autocomplete="off" id="phone_uid">
				<div class="w-mydiv">
					<h3><?php echo (L("srsjhm")); ?></h3>
					<div class="bottom"></div>
				</div>
				<div class="buttonGeoup">
					<a href="#" class="not_next" id="ternNextStep"><?php echo (L("nextstep")); ?></a>
					<a href="<?php echo U('Index/exehange');?>" class="exchange"><?php echo (L("jfdh")); ?></a>
				</div>
			</div>
		</div>

	</div> -->
	
	 <!-- 头部 -->
	 <div class="hear">
			<a href="<?php echo U('Index/index');?>" class="jiantou"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
			<p><?php echo (L("turnout")); ?></p>
			<!-- 语言切换 -->
			<!-- 先不要删掉 -->
			<!-- <div class="top">
				<div class="loginLanguage">
					<div id="sample" class="dropdown">
						<div id="div_curr_lag" class="parent">
							<a href="#">
								<span><img class="flag" src="images/English.png" alt="" />English</span></a>
						</div>
						<div class="son">
							<div id="div_en-us" onclick="gradeOnclick('en-us')">
								<a>
									<img class="flag" src="images/china.png" alt="" />
									English
									<span class="value"></span>
								</a>
							</div>
							<div id="div_zh-cn" onclick="gradeOnclick('zh-cn')">
								<a>
									<img class="flag" src="images/china.png" alt="" />
									中文
									<span class="value"></span>
								</a>
							</div>
							<div id="div_zxcghy84-corean" onclick="gradeOnclick('zxcghy84-corean')">
								<a>
									<img class="flag" src="images/hanguo.png" alt="" />
									한국어
									<span class="value"></span>
								</a>
							</div>
							<div id="div_zxcghy84-jp" onclick="gradeOnclick('zxcghy84-jp')">
								<a>
									<img class="flag" src="images/Japan.png" alt="" />
									わぶん
									<span class="value"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div> -->
	</div>
	<!-- 个人信息 -->
	<div class="user_info">
		<?php echo W('Card/dengji',['userInfo']);?>
	</div>
	<!-- 余额积分 -->
	<div class="mui-content tab">
		<div class="title">
			<div id="segmentedControl" class="mui-segmented-control mui-segmented-control-inverted mui-segmented-control-primary title_box">
				<li id="zhuanchu">
					<a class="mui-control-item title_box_a  mui-active" href="#item2" id="a">
						<?php echo (L("rollOut")); ?>
					</a>
				</li>
				<li id="lijilu">
					<a class="mui-control-item title_box_a" href="#item3" id="b">
						<?php echo (L("zcjl")); ?>
					</a>
				</li>
			</div>
		</div>
		<div class="content">
			<div id="item2" class="mui-control-content integral mui-active">
				<p class="price"><?php echo (L("srsjhm")); ?></p>
				<div class="div_input">

					<input type="number" name="other_account" placeholder="<?php echo (L("srsjhm")); ?>" autocomplete="off" id="phone_uid">
				</div>
				<!-- <p class="hint">提示：最低兑换数量是100</p> -->
				<div class="conversion turnout_conversion turnout">

					<a  class="not_next" id="ternNextStep"><?php echo (L("nextstep")); ?></a>
					<!--<a href="<?php echo U('Index/exehange');?>" class="exchange"><?php echo (L("jfdh")); ?></a>-->
				</div>
			</div>
			<div id="item3" class="mui-control-content record">
				<div class="all_box">
					<div class="column">
						<ul>
							<li><?php echo (L("ywlx1")); ?></li>
							<li><?php echo (L("shue")); ?></li>
							<li><?php echo (L("dangq")); echo (L("yue")); ?></li>
							<li><?php echo (L("sj")); ?></li>
						</ul>
					</div>
					<div class="roll_box">
						
						<div id="refreshContainer" class="scroll mui-clearfix mui-content mui-scroll-wrapper refreshContainer" style="height: 100%;">
							<div class="mui-scroll mui-clearfix asd">
								<!--添加下拉小物件-->
								<?php echo W('Card/jilu',['usermoney_record',10,'3,4']);?>
							</div>
						</div>
					</div>
				</div>
				<div class="refresh">
					<div>
						<div class="arrows fl">
							<img src="/Public/home/wap/images/jiantouxia.png" alt="">
						</div>
						<span class="fl">下拉加载更多</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>


	<!-- //配置错误说明 -->
	<input type="hidden" value="<?php echo (L("dfzhbnwk")); ?>" id="msg1">
	<script type="text/javascript">
		var msg = $('#msg1').val(); //获取错误信息
		$('#ternNextStep').on('click', function () {
			Checku();
		});
		/*	if($("#lijilu").children('a').is(".mui-active")){
			    alert(1)
				console.log(($("#lijilu").children('a')))
			}else{
			    alert(2)
			}*/


	/*$(".lis").on("click",function () {
		alert(1);
    })*/


	</script>



</body>

</html>
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