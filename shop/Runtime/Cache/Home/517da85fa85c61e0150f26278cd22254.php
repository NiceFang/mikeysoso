<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!--title><?php echo (L("ucenter")); ?></title-->
<title></title>
<link rel="stylesheet" href="/Public/home/wap/css/style.css?v=123">
<!-- <link rel="stylesheet" href="/Public/home/wap/css/meCen.css?v=1212"> -->
<link rel="stylesheet" href="/Public/home/wap/css/index.css?v=3">


<!--线上JQ包-->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
<!--本地JQ包-->
<script src="/Public/home/wap/js/jquery-1.9.1.min.js?v=4646"></script>
<!--本地JQ包-->

<!--<script type="text/javascript" src="/Public/home/wap/js/jquery.glide.min.js"></script>-->
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<!-- 首页的样式 -->
<script type="text/javascript" src="/Public/home/common/js/index.js?v=32441"></script>
<script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>

<body class="bg96">
	<!-- 主体内容 start -->
	<div class="mainer">
		<!-- 语言切换 -->
		<div class="top">
			<div class="loginLanguage">
				<div id="sample" class="dropdown">
					<div id="div_curr_lag" class="parent">
						<a href="#">
							<span><img class="flag" src="/Public/home/wap/images/English.png" alt="" />English</span></a>
					</div>
					<div class="son">
						<!--英文-->
						<div id="div_en-us" onclick="gradeOnclick('en-us')"><a><img class="flag" src="/Public/home/wap/images/English.png" alt="" />English<span
								 class="value"></span></a></div>
						<!--中文-->
						<div id="div_zh-cn" onclick="gradeOnclick('zh-cn')"><a><img class="flag" src="/Public/home/wap/images/china.png" alt="" />中文<span
								 class="value"></span></a></div>
						<!--韩文-->
						<div id="div_zxcghy84-corean" onclick="gradeOnclick('zxcghy84-corean')"><a><img class="flag" src="/Public/home/wap/images/hanguo.png"
								 alt="" />한국어<span class="value"></span></a></div>
						<!--日文-->
						<div id="div_zxcghy84-jp" onclick="gradeOnclick('zxcghy84-jp')"><a><img class="flag" src="/Public/home/wap/images/Japan.png" alt="" />わぶん<span
								 class="value"></span></a></div>
					</div>
				</div>
			</div>
		</div>

		<!-- 用户信息 -->
		<div class="userInfo">
			<!-- 人物头像 -->
			<a>
				<!-- 头像图片 -->
				<div class="toux_icon">
					<img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>">
					<!--<img src="/Public/home/wap/heads/toux-icon.png">-->
				</div>
			</a>

			<div class="userInfoR">
				<!-- 用户名 -->
				<p class="username"><?php echo (L("nickname")); ?>:<?php echo ($uinfo['username']); ?></p>

				<!-- ID 与 级别 -->
				<div class="uid_xy">
					<p>UID:<?php echo ($uinfo['userid']); ?></p>
					<p><?php echo (L("rank")); ?>:
						<?php echo $uinfo['use_grade_name'] ? $uinfo['use_grade_name'] : L('zyz')?>
					</p>
				</div>
			</div>

		</div>
		<input type="hidden" name="TOKEN" value="<?php echo session('TOKEN');?>">

		<!-- 我的余额 / 我的积分 -->
		<div class="balance_box">
			<a href="<?php echo U('Index/Bancerecord');?>">
				<div class="my_balance">
					<p class="title"><?php echo (L("yue")); ?>:</p>
					<div class="num">
						<i></i><?php echo ($moneyinfo['cangku_num']); ?>
					</div>

				</div>
			</a>
			<a href="<?php echo U('Index/Exchangerecords');?>">
				<div class="my_integral">
					<p class="title"><?php echo (L("jifen")); ?>:</p>
					<div class="num">
						<i></i><?php echo ($moneyinfo['fengmi_num']); ?>
					</div>
				</div>
			</a>
		</div>

		<!-- 余额增加3个小icon -->
		<!-- <div class="add_YE"> -->
		<!-- 第一个icon -->
		<!-- <div class="iocn_one">
				<p class="num">0.23</p>
				<i class="icon"></i>
			</div> -->
		<!-- 第二个icon -->
		<!-- <div class="iocn_two">
				<p class="num">0.24</p>
				<i class="icon"></i>
			</div> -->
		<!-- 第三个icon -->
		<!-- <div class="iocn_three">
				<p class="num">0.42</p>
				<i class="icon"></i>
			</div> -->

		<!-- 小气泡 -->
		<!-- <div class="bubble">直推奖触发，<br>余额增加0.24</div>
		</div> -->


		<!-- <div class="add_YE">
    			<?php if(is_array($away_execute)): foreach($away_execute as $key=>$vo): ?><div class="iocn_one QQ" data-id="<?php echo ($vo["id"]); ?>" style="top: <?php echo ($vo["top"]); ?>;right :<?php echo ($vo["right"]); ?>;">
						<p class="num"><?php echo ($vo["scores"]); ?></p>
						<i class="icon" style="width: <?php echo ($vo["size"]); ?>;height: <?php echo ($vo["size"]); ?>;"></i>
						<div class="bubble" style="display: none;"><?php echo ($vo["explain"]); ?><br><?php echo ($vo["account"]); ?></div>
					</div><?php endforeach; endif; ?>
				<?php if(($can_get) > "0"): ?><div class="iocn_one" style="top: 1.0278;right :1.0278;">
						<p class="num" ><?php echo ($can_get); ?></p>
						<i class="icon" style="width: 1.0278;height: 1.0278;"></i>
					</div>
					<div class="bubble" style="display: none;"><?php echo (L("mrhb")); ?><br><?php echo (L("yezj")); echo ($can_get); ?></div><?php endif; ?>
    		</div>			 -->

		<div class="add_YE" id="add_YE">

			<?php if(is_array($away_execute)): foreach($away_execute as $key=>$vo): ?><div class="iocn_one QQ" data-type="award" data-id="<?php echo ($vo["id"]); ?>" style="top: <?php echo ($vo["top"]); ?>;right :<?php echo ($vo["right"]); ?>;">
					<p class="num"><?php echo ($vo["scores"]); ?></p>
					<i class="icon" style="width: <?php echo ($vo["size"]); ?>;height: <?php echo ($vo["size"]); ?>;"></i>
					<div class="bubble" style="display: none;"><?php echo ($vo["explain"]); ?><br><?php echo ($vo["account"]); ?></div>
				</div><?php endforeach; endif; ?>

			<?php if(($can_get) > "0"): ?><div class="iocn_one QQ " data-type="days" style="top:<?php echo ($position["top"]); ?>;right :<?php echo ($position["right"]); ?>;">
					<p class="num" val="<?php echo ($can_get); ?>"><?php echo ($can_get); ?></p>
					<i class="icon" style="width: <?php echo ($position["size"]); ?>;height: <?php echo ($position["size"]); ?>;"></i>
					<div class="bubble" style="display: none;"><?php echo (L("mrhb")); ?><br><?php echo (L("yezj")); echo ($can_get); ?></div>
				</div><?php endif; ?>
		</div>




		<!-- 扫码/交易中心 -->
		<div class="trading_center">
			<a onclick="BSL.Qcode('0','qrcodeCallback')">
				<div class="icon">
					<img src="/Public/home/wap/images/index/icon01.png" alt="">
					<p class="txt"><?php echo (L("scan")); ?></p>
				</div>
			</a>
			<a href="<?php echo U('Growth/Intro');?>">
				<div class="icon">
					<img src="/Public/home/wap/images/index/icon02.png" alt="">
					<p class="txt"><?php echo (L("tochangeinto")); ?><i></i><?php echo (L("ru")); ?></p>
				</div>
			</a>
			<a href="<?php echo U('Index/Turnout');?>">
				<div class="icon">
					<img src="/Public/home/wap/images/index/icon03.png" alt="">
					<p class="txt"><?php echo (L("turnout")); ?></p>
				</div>
			</a>
			<a href="<?php echo U('Index/trading_center');?>">
				<!--<a class="notSell">-->
				<div class="icon">
					<img src="/Public/home/wap/images/index/icon04.png" alt="">
					<p class="txt"><?php echo (L("trade")); ?></p>
				</div>
			</a>
		</div>
	</div>

	<!-- 公告/积分/分享/团队 -->
	<div class="banner_box">
		<ul class="fun_list">
			<li>
				<a href="<?php echo U('User/News');?>">
					<div class="icon">
						<img src="/Public/home/wap/images/index/gg.png" alt="公告">
					</div>
					<p class="txt"><?php echo (L("notice")); ?></p>
				</a>
			</li>
			<li>
				<a href="<?php echo U('Index/exehange');?>">
					<div class="icon">
						<img src="/Public/home/wap/images/index/jfdh.png" alt="积分兑换">
					</div>
					<p class="txt"><?php echo (L("jfdh2")); ?></p>
				</a>
			</li>
			<li>
				<a href="<?php echo U('User/Sharecode');?>">
					<div class="icon">
						<img src="/Public/home/wap/images/index/fx.png" alt="分享">
					</div>
					<p class="txt"><?php echo (L("share")); ?></p>
				</a>
			</li>
			<li>
				<a href="<?php echo U('User/Teamdets');?>">


					<div class="icon">
						<img src="/Public/home/wap/images/index/td.png" alt="团队">
					</div>
					<p class="txt"><?php echo (L("team")); ?></p>
				</a>
			</li>
		</ul>
	</div>

	<!-- 头像放大展示开始 -->
	<div class="user_head">
		<div class="head_box">
			<img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>" alt="">
		</div>
	</div>

	<!-- 中间内容 end -->
	<!--<input id="hid_lag" type="hidden" value="<?php echo I('get.l');?>" />
	<input id="hid_lag" type="hidden" value="<?php echo cookie('think_language');?>" />
	<input type="hidden" value="<?php echo (L("zwkf")); ?>" id="zwkf">
	<input type="hidden" value="<?php echo (L("nwfwqx")); ?>" id="nwfwqx">
	<input type="hidden" value="<?php echo (L("guoji")); ?>" id="guoji">-->
	<script type="text/javascript">
		// $.ajax
		$(document).ready(function () {
			var zwkf = $('#zwkf').val();
			var nwfwqx = $('#nwfwqx').val();
			$(".xianzjiaoy").click(function () {
				msg_alert(zwkf);
			});
			$(".quanxian").click(function () {
				msg_alert(nwfwqx);
			});
		});
		$("#quit").click(function () {
			$(".notice").hide();
		})
		$(".notice .read").click(function () {
			$(".notice").hide();
		})

		// 点击人物头像放大展示
		$(".toux_icon").click(function () {
			$(".user_head").show();

		})
		$(".user_head").click(function () {
			$(this).toggle();
		})
	</script>
	<!--扫一扫调用-->
	<script>
		function Dosaoyisao() {
			qrcodeCallback();
		}
	</script>
	<script>
		function Dosaoyisao() {
			qrcodeCallback();
		}

		function qrcodeCallback(result) {
			window.location.href = result;
		}
	</script>
	<script>
		var zwkf = $('#zwkf').val();
		var notSell = $("#notSell");
		$("#notSell,#nokaifang").click(function () {
			alert(zwkf)
		})
		var guoji = $('#guoji').val();
		$("#guojiweikaifang").click(function () {
			if (guoji == 'hanguo') {
				$("#guojiweikaifang").attr('href', '');
				alert(zwkf);
			}
		})
	</script>
	<script type="text/javascript">
		$(function () {
			$.ajax({
				type: "POST", //提交方式    
				url: "/Index/pdajax",
				data: {
					'ac': 'index',
				},
				success: function (result) {
					if (result != 0) {
                        $("#quit").append("<img src=\"/Public/home/wap/images/quit.png\" alt=\"\">");
                        $("#notice").append("<img src=\"/Public/home/wap/images/notice.png\" alt=\"\">");
						var json = JSON.parse(result);
						$("#gongao").css("display", "block");
						$("#affiche").text(json.title + ":");
						$("#px").html(json.content);

					}
				}
			})
			$("#queding,#quit").click(function () {
				$("#gongao").css("display", "none");
			})
		})
	</script>
	<div class="footer-fan">
		<a href="<?php echo U('Index/index');?>">
			<img src="/Public/home/wap/images/shouye_select.png" alt="首页">
			<p class="active"><?php echo (L("sy")); ?></p>
		</a>
		<!-- <a href="<?php echo U('Turntable/index');?>"> -->
		<a id="notSell">
			<img src="/Public/home/wap/images/zican.png" alt="资产">
			<p><?php echo (L("zichan")); ?></p>
		</a>
		<a href="https://shangmeng.itdoor.cc/app/index.php?i=9&c=entry&m=ewei_shopv2&do=mobile&r=diypage&id=35" >
			<img src="/Public/home/wap/images/gouwuche.png" alt="商城">
			<p><?php echo (L("shoppingmall")); ?></p>
		</a>
		<a href="<?php echo U('User/Personal');?>">
			<img src="/Public/home/wap/images/wode.png" alt="我的">
			<p><?php echo (L("my")); ?></p>
		</a>
	</div>


</body>

<!-- 弹窗(不改) -->
<div class="notice" id="gongao" style="display:none;">
	<div class="notice_box">
		<div class="notice_box_img" id="notice">
		</div>
		<div class="quit" id="quit">
		</div>
		<p class="notice_txt">公 告</p>
		<p class="title" id="affiche"></p>
		<div class="text">
			<p id="px">        </p>
		</div>
		<p class="wallet">Mikey 钱包</p>
		<div class="read" id="queding">已阅</div>
	</div>
</div>

</html>

<script>
	// 更改语言
	$(document).ready(function () {
		//js获取coookie方法
		function get_cookie(Name) {
			var search = Name + "=" //查询检索的值
			var returnvalue = ""; //返回值
			if (document.cookie.length > 0) {
				sd = document.cookie.indexOf(search);
				if (sd != -1) {
					sd += search.length;
					end = document.cookie.indexOf(";", sd);
					if (end == -1)
						end = document.cookie.length;
					//unescape() 函数可对通过 escape() 编码的字符串进行解码。
					returnvalue = unescape(document.cookie.substring(sd, end))
				}
			}
			return returnvalue;
		}

		// 获取头部颜色
		getColor();
		// 点击切换语言
		$(".dropdown .son").hide();
		$("#div_curr_lag").click(function () {
			$(".dropdown .son").toggle();
		});

		$(".dropdown .son div a").click(function () {
			var text = $(this).html();
			$(".dropdown .parent a span").html(text);
			// localStorage.setItem('key',JSON.stringify(text));
			$(".dropdown .son").hide();
		}); //选择完成以后隐藏页面
		var _cookie = get_cookie('think_language');
		var curr_lag = $("#hid_lag").val();
		if (_cookie == "") {
			//若cookie是空的
			gradeOnclick("en-us");
		} else {
			var curr_html_lag = $("#div_" + _cookie).html();
			$("#div_curr_lag").html(curr_html_lag);
		}
	});

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

<!-- 气泡 -->
<script type="text/javascript">
	$(".QQ").one('click', function (e) {
		var id = $(this).data('id');
		var qq = $(this);
        var token = $("[name='TOKEN']").val();
		var type = $(this).data('type');
		if (type == "days") {
			var days = $(this).find().context.outerText;
		} else {
			var days = 0;
		}
		$.ajax({
			url: '/Index/updateJF',
			type: 'post',
			data: {
				'type': type,
				'id': id,
				'days': days,
				'token':token
			},
			datatype: 'json',
			success: function (mes) {
				//console.log(mes);
				var Obj = JSON.parse(mes);
				//console.log(Obj);
				if (Obj.status == 1) {
                    $("[name='TOKEN']").val(Obj.token);
					qq.delay(500).fadeOut(200);
					qq.children(".bubble").fadeIn(200);
					$(".my_balance").find("div").html("<i></i>" + parseFloat(Obj.val));
					$(".my_integral").find("div").html("<i></i>" + parseFloat(Obj.integrals));
					$(e.target).remove();
					if ($(".QQ").children("i").length == 0) {
						window.location.reload();
					}
				} else {
					msg_alert(Obj.message);
					window.location.reload();
				}
			}
		});
	});
</script>
<script>
	var zwkf = $('#zwkf').val();
	// var notSell = $(".notSell");
	$(".notSell").click(function () {
		msg_alert(zwkf)
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