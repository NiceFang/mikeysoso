<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("turnout")); ?></title>

<!-- 旧的样式 -->
<link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css">
<link rel="stylesheet" href="/Public/home/wap/css/YangStyle.css">

<!-- 新的样式 -->
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/integralConversion.css">
<link rel="stylesheet" href="/Public/home/wap/css/mutual.css?t=2">

<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>

<style>
	.bg96 { background: #fff;margin-top: 0;}
	.big_width100{margin: 1rem 0 0;}
 	.click{background: #2874d5 !important;}
	.click .bottom1{border-bottom-color: #cfb164 !important;}

	.zhifu_price {
		display: flex;
		justify-content: center;
		align-items: center;
		margin-top: 0.0833rem;
	}
</style>

<body>

	<!-- 旧的代码 -->
	<!-- <div class="headera">
		<div class="header_la ">
			<a href="<?php echo U('Index/Turnout');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
		</div>
		<div class="header_ca">
			<h2><?php echo (L("turnout")); ?></h2>

		</div>
	</div> -->

	<!-- <div class="big_width100">
		<div class="w-bj">
			<div class="shaomZ">
				<a href="javascript:void(0)" class="shaom">
					<img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>" class="icon">
					<img src="/Public/home/wap/images/hyjb-VIP.png" class="w-vip">
				</a>
				<p><?php echo (L("hym")); ?><span><?php echo ($uinfo['username']); ?></span><br>
				<?php echo 'UID:'.$_GET['sid']?></p>
				
			</div>
		</div>
		<div class="w-center">
			<div class="fill_sty">
				<h2><?php echo (L("zcje")); ?></h2>
				<div class="w-mydiv1">
					<div class="top"></div>
				</div>
				<div class="w-two-div">
					<div class="w-left click">
						<a href="###">
							<div class="w-zhuan" style="top:0.85rem;margin-left: 42%" >&nbsp;&nbsp;<img src="/Public/home/wap/images/integraimages/balance3030.png" style="line-height: 0;height: 20px"> -->
	<!--<div class="bottom1"></div>-->
	<!-- </div> -->
	<!-- </a> -->
	<!-- </div> -->
	<!-- <div class="w-right">
						<a href="###">
							<div class="w-zhuan">转&nbsp;&nbsp;USD($)
								<div class="bottom1"></div>
							</div>
						</a>
					</div> -->
	<!-- <input class="w-input paynums" type="number" placeholder="<?php echo (L("qsr100dzs")); ?>"> -->
	<!-- <input type="hidden" value="<?php echo ($uinfo['userid']); ?>" class="zuid"> -->
	<!-- </div> -->
	<!-- <input class="w-input1 mobilelast" type="number" placeholder="请输入对方手机号码末尾4位" maxlength="4" id="oper_2" onkeyup="value=value.replace(/[^\d]/g,'') "
						ng-pattern="/[^a-zA-Z]/"> -->
	<!-- <div class="w-zhuanchu"> -->
	<!-- <a href="javascript:void(0);" class="not_next ljzf_but " id="operConfirm"><?php echo (L("qrzc")); ?></a> -->
	<!-- </div> -->
	<!-- </div> -->
	<!-- </div> -->
	<!--浮动层-->

	<!-- 新的代码 -->
	<!-- 头部 -->
	<div class="hear">
		<a href="<?php echo U('Index/Turnout');?>" class="jiantou"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
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
	<div class="mutual_user_info">
		<input type="hidden" value="<?php echo ($uinfo['userid']); ?>" class="zuid">
		<div class="mutual_user_info_bg">
			<div class="div_img">

				<img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>" alt="">
			</div>
			<p class="uid">UID : <?php echo ($uinfo["userid"]); ?></p>
			<p class="uid username"><?php echo (L("nickname")); ?>:<?php echo ($uinfo["username"]); ?></p>
			<p class="grade"><?php echo (L("rank")); ?>:<?php echo ($uinfo["grade_name"]); ?></p>
		</div>
	</div>
	<!-- 余额积分 -->
	<div class="mui-content tab">
		<div class="content">
			<div id="item2" class="mui-control-content integral mui-active">
				<p class="price mutual_price"><?php echo (L("zcje")); ?></p>
				<div class="input_num">
					<input type="num" class="paynums" id="paynums" placeholder="<?php echo (L("qsr100dzs")); ?>">
				</div>
				<!--	<a href="#" class="cny">转 CNY</a>-->
				<!-- <p class="hint">提示：最低兑换数量是100</p> -->
				<div class="conversion  mutual_conversion">
					<a href="javascript:void(0);" class="not_next ljzf_but" id="operConfirm"><?php echo (L("qrzc")); ?></a>
				</div>
			</div>
		</div>
	</div>




	<div class="ftc_wzsf">
		<div class="srzfmm_box">
			<div class="qsrzfmm_bt clear_wl">
				<img src="/Public/home/wap/images/xx_03.jpg" class="tx close fl">
				<span class="fl"><?php echo (L("qsrzfmm")); ?></span></div>
			<div class="zfmmxx_shop">
				<div class="mz"><?php echo (L("x")); ?>（<?php echo ($uinfo["userid"]); ?>）<?php echo (L("zf")); ?></div>
				<div class="zhifu_price"><img src="/Public/home/wap/images/integraimages/Mhei.png" alt="">
					<div></div>
				</div>
			</div>
			<ul class="mm_box">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
		<div class="numb_box">
			<div class="xiaq_tb">
				<img src="/Public/home/wap/images/jftc_14.jpg" height="10"></div>
			<ul class="nub_ggg">
				<li><a href="javascript:void(0);" class="zf_num">1</a></li>
				<li><a href="javascript:void(0);" class="zj_x zf_num">2</a></li>
				<li><a href="javascript:void(0);" class="zf_num">3</a></li>
				<li><a href="javascript:void(0);" class="zf_num">4</a></li>
				<li><a href="javascript:void(0);" class="zj_x zf_num">5</a></li>
				<li><a href="javascript:void(0);" class="zf_num">6</a></li>
				<li><a href="javascript:void(0);" class="zf_num">7</a></li>
				<li><a href="javascript:void(0);" class="zj_x zf_num">8</a></li>
				<li><a href="javascript:void(0);" class="zf_num">9</a></li>
				<li><a href="javascript:void(0);" class="zf_empty"><?php echo (L("emptya")); ?></a></li>
				<li><a href="javascript:void(0);" class="zj_x zf_num">0</a></li>
				<li><a href="javascript:void(0);" class="zf_del"><?php echo (L("deleteo")); ?></a></li>
			</ul>
		</div>
		<div class="hbbj"></div>
	</div>

	</div>
	<!--<input type="hidden" id="qsrzqdzzje" value="qsrzqdzzje">-->
	<script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>
	<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
	<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
	<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
	<!-- 获取头部的颜色 -->
	<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>
	<script type="text/javascript">
		$(".w-two-div>div").on('click', function () {
			$(this).addClass("click").siblings().removeClass("click");
		});
		$(".pay_list_c1").click(function () {
			$(this).addClass("on").siblings().removeClass("on");
		})
	</script>

	<!--  -->
	<script type="text/javascript">
		//当输入框失去焦点，页面自动滚动到顶部 
		$("input,select").blur(function () {
			setTimeout(() => {
				const scrollHeight = document.documentElement.scrollTop || document.body.scrollTop || 0;
				window.scrollTo(0, Math.max(scrollHeight - 1, 0));
			}, 100);
		})
		$('#operConfirm').click(function () {
			var paytype = $(".pay_list_c1.on p input").val(); //转账方式
			var paynums = ($('.paynums').val()); //支付金额
			var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;

			var mobila = $('.mobilelast').val(); //手机号码后四位
			// var txye =parseFloat($.trim($('#oper_1').val())); //要兑换的数量 1-1200
			var exg = /^(([1-9]\d*)|\d)(\.\d{1,2})?$/;
			var qsrzqdzzje = $('#qsrzqdzzje').val();

			if (!reg.test(paynums)) {
				msg_alert("<?php echo L('qsrzqdzzje')?>");
				return;
			}
			// var exg = /^\d{4}$/
			// if (!exg.test(mobila)) {
			// 	msg_alert('请输入手机号末4位数');
			// 	return;
			// }
			$('.zhifu_price div').text(paynums);
			$(".ftc_wzsf").show();
			$('.hear').css('padding-top', '1px');
			$('html,body').css('height', '100%');

			//判断是否为苹果
			var isIPHONE = navigator.userAgent.toUpperCase().indexOf('IPHONE') != -1;

			// 元素失去焦点隐藏iphone的软键盘
			function objBlur(id, time) {
				if (typeof id != 'string') throw new Error('objBlur()参数错误');
				var obj = document.getElementById("paynums"),
					time = time || 300,
					docTouchend = function (event) {
						if (event.target != obj) {
							setTimeout(function () {
								obj.blur();
								document.removeEventListener('touchend', docTouchend, false);
							}, time);
						}
					};
				console.log(obj)
				if (obj) {
					obj.addEventListener('focus', function () {
						document.addEventListener('touchend', docTouchend, false);
					}, false);
				} else {
					throw new Error('objBlur()没有找到元素');
				}
			}

			if (isIPHONE) {
				var input = new objBlur('input');
				input = null;
			}


			// function BlurOrFocus() {
			// 	var obj = document.getElementById("paynums");
			// 	// console.log(obj)
			// 	var docTouchend = function (event) {

			// 		if (event.target != obj) {
			// 			setTimeout(function () {
			// 				obj.blur();
			// 				document.removeEventListener('touchend', docTouchend, false);
			// 			}, 1000);

			// 		}
			// 	}

			// 	if (obj) {
			// 		obj.addEventListener('touchstart', function () {
			// 			document.addEventListener('touchend', docTouchend, false);
			// 		}, false);
			// 	}

			// }
			// BlurOrFocus();
		});


		//获取数据传值
		function Getvalue() {
			var paytype = $(".pay_list_c1.on p input").val(); //转账方式
			var paynums = Number($('.paynums').val()); //支付金额
			var zuid = $('.zuid').val(); //转账会员id
			var mobila = $('.mobilelast').val(); //手机号码后四位
			var minemoney = Number($('#shengyue').text()); //当前账户余额
			var data = {
				'paytype': paytype,
				'paynums': paynums,
				'zuid': zuid,
				'mobila': mobila,
				'minemoney': minemoney
			};
			return data;
		}

		// $(function(){
		//出现浮动层
		$(".ljzf_but").click(function () {
			// $(".ftc_wzsf").hide();
		});
		//关闭浮动
		$(".close").click(function () {
			$(".ftc_wzsf").hide();
			$(".mm_box li").removeClass("mmdd");
			$(".mm_box li").attr("data", "");
			i = 0;
			$('html,body').css('height', '100%');
			location.reload();
		});
		//数字显示隐藏
		$(".xiaq_tb").click(function () {
			$(".numb_box").slideUp(500);
		});
		$(".mm_box").click(function () {
			$(".numb_box").slideDown(500);
		});
		//----
		var i = 0;
		$(".nub_ggg li .zf_num").click(function () {
			if (i < 6) {
				$(".mm_box li").eq(i).addClass("mmdd");
				$(".mm_box li").eq(i).attr("data", $(this).text());
				i++
				if (i == 6) {
					setTimeout(function () {
						var pwd = "";
						$(".mm_box li").each(function () {
							pwd += $(this).attr("data");
						});

						//ajax提交密码以及参数
						var post_data = Getvalue(); //获取上面的参数
						$.ajax({
							url: '/Index/Changeout',
							type: 'post',
							data: {
								'post_data': post_data,
								'pwd': pwd
							},
							datatype: 'json',
							success: function (mes) {
								if (mes.status == 1) {
								    alert(mes.message);
									//msg_alert(mes.message, mes.url);
									$(".ftc_wzsf").hide();
									$(".mm_box li").removeClass("mmdd");
									$(".mm_box li").attr("data", "");
									i = 0;
								} else {
									msg_alert(mes.message);
									$(".mm_box li").removeClass("mmdd");
									$(".mm_box li").attr("data", "");
									i = 0;
								}
							}
						})
					}, 100);
				};
			}
		});

		$(".nub_ggg li .zf_del").click(function () {
			if (i > 0) {
				i--
				$(".mm_box li").eq(i).removeClass("mmdd");
				$(".mm_box li").eq(i).attr("data", "");
			}
		});

		$(".nub_ggg li .zf_empty").click(function () {
			$(".mm_box li").removeClass("mmdd");
			$(".mm_box li").attr("data", "");
			i = 0;
		});
		// });
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