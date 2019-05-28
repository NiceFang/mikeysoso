<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("Setup")); ?></title>
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">  -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/meCen.css"> -->
<link rel="stylesheet" href="/Public/home/wap/css/reset.css">
<link rel="stylesheet" href="/Public/home/wap/css/uploads.css">
<link rel="stylesheet" href="/Public/home/wap/css/login.css">

<link rel="stylesheet" href="/Public/home/wap/css/normalize.css">
<link rel="stylesheet" href="/Public/home/wap/css/wen.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css">

<link rel="stylesheet" href="/Public/home/wap/css/YangStyle.css">
<link rel="stylesheet" href="/Public/home/wap/css/Personal.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/upload.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>

<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>
<style>
	/*.sett_xiug{display:none;}*/
	/*.button,#clipBtn{width: 130px;font-size: 16px;}*/
	body{background: #f4f4f4;}
	/*.sett_xiug{display:none;}*/
	/*.button,#clipBtn{display: block;z-index: 2;height: .8rem;width: 90%;margin: 0 auto;float: none;border-radius: 5px;text-align: center;line-height: 40px;color: #fff;font-size: 16px;margin-bottom: 10px;}*/
	.setlistboxs ul{margin-top: 10px;}
	.setlistboxs ul li a div{display: flex;align-items: center;}
	/*.bg96{background: #fff;}
    .big_width100{background: #fff; margin-top:1rem; }*/
    .w-bj p{margin: 0;}
	/*.w-nicheng{line-height: .7rem;color: #9ba2ee !important;}
	.red_package{padding: 15px ;background-color: #fff;}*/
	.red_package a{display: flex;justify-content: space-between;align-items: center;}
	.red_package .red_left {display: flex;align-items: center;font-size: 12px;color:#333;}
	.red_package .red_left img{width: 15px;height: 20px;margin-right: 10px;}
	.red_package .red_left span{margin-left: 10px;color:#999;}
	.red_package  .arrow{display: flex;align-items: center;}
	.red_package  .arrow span{width: 4px;height: 4px;border-radius: 50%;background-color: red;display: inline-block;}
	.red_package  .arrow img{width: 22px;height: 22px;}
	.loginLanguage {
		width: 118px;
		height: 48px;
		position: absolute;
		right: 0;

	}
</style>


	<!-- 头部 -->
	<div class="head">
		<div class="head_title">
			<div class="top">
				<div class="loginLanguage">
					<div id="sample" class="dropdown" >
						<div id="div_curr_lag" class="parent">
							<a href="#">
								<span><img class="flag select_flag" src="/Public/home/wap/images/English.png" alt="" />English</span></a>
						</div>
						<div class="son">
							<div id="div_en-us" onclick="gradeOnclick('en-us')"><a><img class="flag" src="/Public/home/wap/images/English.png" alt="" />English<span
									 class="value"></span></a></div>
							<div id="div_zh-cn" onclick="gradeOnclick('zh-cn')"><a><img class="flag" src="/Public/home/wap/images/china.png" alt="" />中文<span
									 class="value"></span></a></div>
							<div id="div_zxcghy84-corean" onclick="gradeOnclick('zxcghy84-corean')"><a><img class="flag" src="/Public/home/wap/images/hanguo.png"
									 alt="" />한국어<span class="value"></span></a></div>
							<div id="div_zxcghy84-jp" onclick="gradeOnclick('zxcghy84-jp')"><a><img class="flag" src="/Public/home/wap/images/Japan.png"
									 alt="" />わぶん<span class="value"></span></a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="user">
			<div class="user_info ">
				<div class="div_img fl" id="user_head">
					<img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>"  alt="">
					<input type="file" id="head_file" onchange="imgChange()" name="header_img" hidden>
				</div>
				<div class="user_info_right fl">
					<p class="name"><?php echo (L("usename")); ?> : <?php echo ($uinfo['username']); ?></p>
					<div>
						<p class="uid">UID :<?php echo ($uid); ?></p>
						<p class="grade"><?php echo (L("rank")); ?>：<?php echo ($uinfo['use_grade_name']); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="centBalance">
			<div class="Balance">
				<a class="balance" href="<?php echo U('Index/Bancerecord');?>">
					<p><?php echo (L("yue")); ?></p>
					<div class="balance_box">
						<div class="div_info fl">
							<img src="/Public/home/wap/images/mony.png" alt="">
						</div>
						<span class="yue fl">
							&nbsp;<?php echo (Showtwo($moneyinfo['cangku_num'])); ?>
						</span>
					</div>
				</a>
			</div>
			<div class="Balance">
				<a class="balance" href="<?php echo U('Index/Exchangerecords');?>">
					<p><?php echo (L("jifen")); ?></p>
					<div class="balance_box">
						<div class="div_info fl">
							<img src="/Public/home/wap/images/mony.png" alt="">
						</div>
						<span class="yue fl">
							&nbsp;<?php echo (Showtwo($moneyinfo['fengmi_num'])); ?>
						</span>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="setlistboxs">
		<ul style="margin-top: 0;">
			<li><a href="<?php echo U('User/Setuname');?>">
					<div>
						<img src="/Public/home/wap/images/user/nicheng.png" alt="">
						<p><?php echo (L("nickname")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
			<li><a href="<?php echo U('User/Mobile');?>">
					<div>
						<img src="/Public/home/wap/images/user/dianhua.png" alt="">
						<p><?php echo (L("dh")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
			<li><a href="<?php echo U('User/accountManage');?>">
					<div>
						<img src="/Public/home/wap/images/user/zhanghuguanli.png" alt="">
						<p><?php echo (L("bankcard")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
		</ul>
		<ul>
			<li><a href="<?php echo U('User/Setpwd',array('type'=>1));?>">
					<div>
						<img src="/Public/home/wap/images/user/denglvmima.png" alt="">
						<p><?php echo (L("loginpwd")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
			<li><a href="<?php echo U('User/Setpwd',array('type'=>2));?>">
					<div>
						<img src="/Public/home/wap/images/user/zhifumima.png" alt="">
						<p><?php echo (L("paypwd")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
		</ul>
		<ul>
			<li><a href="<?php echo U('User/News');?>" class="guojiweikaifang">
					<div>
						<img src="/Public/home/wap/images/user/gonggao.png" alt="">
						<p><?php echo (L("notice")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
			<li><a href="<?php echo U('Index/feedbackInfo');?>">
					<div>
						<img src="/Public/home/wap/images/user/tousu.png" alt="">
						<p><?php echo (L("complins")); ?></p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
			<li><a href="javascript:void(0)">
					<div>
						<img src="/Public/home/wap/images/user/banben.png" alt="">
						<p><?php echo (L("edition")); ?>(1.1.0)</p>
					</div>
					<img src="/Public/home/wap/images/jiantouyou.png" alt="">
				</a></li>
		</ul>
		
	</div>
	<div class="loginout">
		<a class="quit" href="<?php echo U('User/Loginout');?>"><?php echo (L("loginout")); ?></a>
	</div>
	<div style="height: 1px"></div>
	<div class="footer-fan">
		<a href="<?php echo U('Index/index');?>">
			<img src="/Public/home/wap/images/shouye.png" alt="首页">
			<p class=""><?php echo (L("sy")); ?></p>
		</a>
		<!-- <a href="<?php echo U('Turntable/index');?>"> -->
		<a id="notSell">
			<img src="/Public/home/wap/images/zican.png" alt="资产">
			<p><?php echo (L("zichan")); ?></p>
		</a>

		<a href="https://shangmeng.itdoor.cc/app/index.php?i=9&c=entry&m=ewei_shopv2&do=mobile">
			<img src="/Public/home/wap/images/gouwuche.png" alt="商城">
			<p><?php echo (L("shoppingmall")); ?></p>
		</a>
		<a href="<?php echo U('User/Personal');?>">
			<img src="/Public/home/wap/images/wode_select.png" alt="我的">
			<p class="active"><?php echo (L("my")); ?></p>
		</a>
	</div>

<script type="text/javascript">
	$(".w-x").click(function () {
		$(".htmleaf-container").toggle();
	})

	$(document).ready(function () {
		$("#duoyhide").click(function () {
			$("#duoynone").toggle(); //toggle() 方法切换元素的可见状态。 如果被选元素可见,则隐藏这些元素,如果被选元素隐藏,则显示这些元素。
		});

	});

	$(document).ready(function () {
		$("#duoyhidea").click(function () {
			$("#duoynone").toggle(); //toggle() 方法切换元素的可见状态。 如果被选元素可见,则隐藏这些元素,如果被选元素隐藏,则显示这些元素。
		});

	});
</script>

<script>
    $("#user_head").click(function () {
        $('#head_file').click();
    })
    // // 点击改变用户头像
    function imgChange() {
        //获取点击的文本框
        var file = document.getElementById("head_file");
        //  人物头像
        var user_head = document.getElementById("user_head");
        console.log($('#head_file')[0].files[0]);
        // 人物头像地址
        var formData = new FormData();
        var img = $('#head_file')[0].files[0];
        formData.append('header_img',img);
        $.ajax({
            url:"<?php echo U('User/upload_img');?>",
            type:'post',
            processData : false,
            contentType : false,
            async:false,
            data:formData,
            success:function(data){
                console.log(data);
                if(data.status==0){
                    alert(data.message);
                }else{
                    msg_alert("<?php echo (L("xgcg")); ?>");
                    window.location.reload();

                }
            }

        });
    }
</script>


<script type="text/javascript">
    //js获取coookie方法
    function get_cookie(Name) {
        var search = Name + "="//查询检索的值
        var returnvalue = "";//返回值
        if (document.cookie.length > 0) {
            sd = document.cookie.indexOf(search);
            if (sd!= -1) {
                sd += search.length;
                end = document.cookie.indexOf(";", sd);
                if (end == -1)
                    end = document.cookie.length;
                //unescape() 函数可对通过 escape() 编码的字符串进行解码。
                returnvalue=unescape(document.cookie.substring(sd, end))
            }
        }
        return returnvalue;
    }
	$(document).ready(function () {
		// 点击切换语言
		$(".dropdown .son").hide();
		$("#div_curr_lag").click(function () {
			$(".dropdown .son").toggle();
		});
		$(".dropdown .son div a").click(function () {
			var text = $(this).html();
			$(".dropdown .parent a span").html(text);
			// localStorage.setItem('key',JSON.stringify(text));
			$(".dropdown .son").hide(); //选择完成以后隐藏页面
		});
		var curr_lag = $("#hid_lag").val();
		//console.log(curr_lag);
        var _cookie = get_cookie('think_language');

        if (_cookie == "") {
            //若cookie是空的
            gradeOnclick("en-us");
        } else {
            var curr_html_lag = $("#div_" + _cookie).html();
            $("#div_curr_lag").html(curr_html_lag);
        }

	});
	var curr_lag = $("#hid_lag").val();
	var curr_html_lag = $("#div_" + curr_lag).html();
	$("#div_curr_lag").html(curr_html_lag);

	function gradeOnclick(url) {
        $.ajax({
            url: '/Index/Lang',
            type: 'post',
            data: {
                'url': url
            },
            success: function (mes) {
                if (mes.status) {
                    window.location.href = "?l=" + mes.message;
                } else {
                    alert(mes.message);
                }
            }
        })
	};
</script>
<script>
	$("#notSell").click(function () {
		msg_alert("<?php echo (L("zwkf")); ?>");
	})
</script>
<!--头像上传新EEEEE-->
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