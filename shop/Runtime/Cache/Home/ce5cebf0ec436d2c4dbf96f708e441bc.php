<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("qxzyhk")); ?></title>
<!-- 旧代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCena.css"> -->

<!-- 新代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/base.css">
<link rel="stylesheet" href="/Public/home/wap/css/accountManage.css">


<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>
<script src="/Public/home/wap/js/mui.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>

<body>

	<!-- 旧代码 -->
	<!-- <div class="header">
		<div class="header_l">
			<a href="javascript:history.go(-1)"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
		</div>
		<div class="header_c">
			<h2><?php echo (L("qxzyhk")); ?></h2>请选择银行卡
		</div>
		<div class="header_r"></div>
	</div>

	<div class="big_width">
		<div class="pad10"></div>
		<?php if(is_array($morecars)): foreach($morecars as $key=>$v): ?><div class="myBankCard">
				<a href="<?php echo U($actionUrl?$actionUrl.'?cid='.$v['id']:'#');?>" class="clear_wl">
					<img src="/Public/home/wap/images/<?php echo ($v['banq_img']); ?>">
					<div class="yhxx">
						<p><?php echo ($v['banq_genre']); ?></p>
						<p><?php echo ($v['card_number']); ?></p>
					</div>
				</a>
				<div class="myBankCard_snac">
					<?php if(($v['is_default']) == "1"): ?><a href="javascript:void(0);"><?php echo (L("mr")); ?></a>//默认<?php endif; ?>
					<a href="javascript:void(0)" onclick="deleteb(this)" data-id="<?php echo ($v['id']); ?>"><?php echo (L("deleteo")); ?></a>
				</div>

			</div><?php endforeach; endif; ?>

		<div class="addBankCard">
			<a href="<?php echo U('Growth/Addbank');?>" class="clear_wl"><img src="/Public/home/wap/images/addyhk.png">
				<p><?php echo (L("tjyhk")); ?></p>
			</a>
		</div>
	</div>
	<input type="hidden" value="<?php echo (L("qxzdydyhk")); ?>" id="qxzdydyhk"> -->

	<!-- 新代码 -->
	  <!-- 头部 -->
	  <div class="hear">
        <a href="<?php echo U('User/accountManage');?>"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
          <?php echo (L("tjyhk")); ?>
    </div>

    <!-- 银行卡 -->
    <?php if(is_array($morecars)): foreach($morecars as $key=>$v): ?><div class="bank">
        <div class="bank_box">
            <div class="top">
                <div class="top_left fl">
                    <p class="bank_txt"><?php echo (L("bankname")); ?>：<?php echo ($v['banq_genre']); ?></p>
                    <p class="bank_name"><?php echo (L("cardholdername")); ?>：<?php echo ($v['hold_name']); ?></p>
                  <!--  <p class="bank_moblie">持卡人手机：16625588455</p>-->
                    <p class="bank_num"><?php echo (L("cardnum")); ?>：<?php echo ($v['card_number']); ?></p>
                </div>
                <div class="top_right fr">
                    <img src="/Public/home/wap/images/<?php echo ($v['banq_img']); ?>" alt="">
                </div>
            </div>
            <div class="bottom">
                <div class="left fl" name="updateDefault">
                    <?php if($v['is_default'] == 1): ?><div class="select_bg fl select_bg_box select_red" data-id="<?php echo ($v['id']); ?>"></div>
                        <?php else: ?>
                        <div class="select_bg fl select_bg_box " data-id="<?php echo ($v['id']); ?>"></div><?php endif; ?>
                    <p class="fl"><?php echo (L("mr")); ?></p>
                </div>
                <div class="right fr">
                    <!--<div class="div_hide fl">
                        <div class="hide_bg fl show_bg "></div>
                        <p class="fl">显示</p>
                    </div>-->
                    <div class="div_delete fr">
                        <div class="delete_bg fl"></div>
                        <!--<p class="fl">删除</p>-->
                        <a onclick="deleteb(this)" data-id="<?php echo ($v['id']); ?>"><?php echo (L("deleteo")); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div><?php endforeach; endif; ?>
    <div class="footer">
        <!--添加银行卡-->

		<a href="<?php echo U('Growth/Addbank');?>"><?php echo (L("tjyhk")); ?></a>
		</div>
</body>

</html>
<script>
	// 选中状态
	 $(function () {
        $(".bottom").on('click','.select_bg',function(){
             $(this).addClass("select_red").parents(".bank").siblings().find(".select_bg").removeClass('select_red');
        })
    })

    $("[name=\"updateDefault\"]").on("click",function () {
        var Id = $(this).find("div").data("id");
        $.ajax({
            url: '/Growth/updateBank',
            type: 'post',
            data: {
                'Id': Id
            },
            success: function (mes) {
                msg_alert(mes.message);
                window.location.reload()//刷新当前页面.
            }
        })
    })
	function deleteb(e) {
		var qxzdydyhk = $('#qxzdydyhk').val();
		var bangid = $(e).attr('data-id');
		if (bangid == '') {
			msg_alert(qxzdydyhk);
		}
		$.ajax({
			url: '/Growth/Cardinfos',
			type: 'post',
			data: {
				'bangid': bangid
			},
			datatype: 'json',
			success: function (mes) {
				if (mes.status == 1) {
					msg_alert(mes.message);
                    window.location.reload()//刷新当前页面.
				} else {
					msg_alert(mes.message);
				}
			}
		})
	}
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