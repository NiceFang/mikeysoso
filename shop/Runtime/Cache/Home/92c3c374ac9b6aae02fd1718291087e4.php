<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- 字体颜色兼容 -->
<meta name="format-detection" content="telephone=no">
<title><?php echo (L("duihuan")); ?></title>
<!-- 旧的样式 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css"> -->
 <link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css">
<!-- <link rel="stylesheet" href="/Public/home/wap/css/YangStyle.css"> -->


<!-- 新的样式 -->
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/integralConversion.css">
<script type="text/javascript" src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/mui.min.js"></script>

<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>
<style>
	/* .bg96 { background: #fff;margin-top: 0;}
	.big_width100{margin: 0;}
	.centBalance{background: url(/Public/home/wap/images/mcbj.png) no-repeat;background-size: 100% 100%;padding: .6rem 0;}
    .w-mydiv h3{color: #000;}
    .w-mydiv h4 {color: #2874d5;font-size: .24rem !important;text-align: center;}
    .w-mydiv{ width: 85%;}

	.zhifu_price {
		display: flex;
		justify-content: center;
		margin-top: 0.0833rem;
	}

	.moneyS_icon {
		display: flex;
		justify-content: center;
	}

	.moneyS_icon img {
		width: 14px;
		height: 14px;
	} */
</style>

<body>

	<!-- 头部 -->
	<div class="hear">
		<a href="<?php echo U('Index/index');?>" class="jiantou"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
		<p><?php echo (L("jfdh2")); ?></p>
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
			<div id="segmentedControl" class="mui-segmented-control mui-segmented-control-inverted mui-segmented-control-primary title_box segmentedControl">
				<li id="zhuanchu">
					<a class="mui-control-item title_box_a  mui-active" href="#item2" id="a">
						<?php echo (L("jfdh")); ?>
					</a>
				</li>
				<li id="lijilu">
					<a class="mui-control-item title_box_a" href="#item3" id="b">
						<!--互转记录-->
						<?php echo (L("dhjl")); ?>
					</a>
				</li>
			</div>
		</div>
		<div class="content">
			<div id="item2" class="mui-control-content integral mui-active">
				<p class="price"><?php echo (L("srdhje")); ?></p>
				<div class="div_input">
					<input type="number" name="other_account" placeholder="<?php echo (L("qsr100dzs")); ?>" autocomplete="off" class="dhnums" id="phone_uid">
				</div>
				<p class="hint"><?php echo (L("tszsdhsl")); ?></p>
				<div class="conversion turnout_conversion turnout">
					<a class="not_next ljzf_but" id="aaa"><?php echo (L("qrdh")); ?></a>
					<a href="<?php echo U('Index/exehange');?>" class="exchange"><?php echo (L("srdhje")); ?></a>
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
							<div class="mui-scroll mui-clearfix">
								<!--添加下拉小物件-->
									<?php echo W('Card/jilu',['userscores_record',10,'2']);?>
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


	<!--浮动层-->
	<div class="ftc_wzsf" style="display: none">
					<div class="srzfmm_box">
						<div class="qsrzfmm_bt clear_wl">
							<img src="/Public/home/wap/images/xx_03.jpg" class="tx close fl">
							<span class="fl"><?php echo (L("input_pwd")); ?></span></div>
						<div class="zfmmxx_shop">
							<div class="mz"><?php echo (L("sjhd")); ?></div>
							<div class="zhifu_price"><img src="/Public/home/wap/images/integraimages/Mhei.png" alt=""><p></p></div></div>
						<ul class="mm_box">
							<li></li><li></li><li></li><li></li><li></li><li></li>
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

	<!-- //设置错误变量 -->
	<input type="hidden" value="<?php echo (L("dhjebnxy")); ?>" id="dhjebnxy">
	<input type="hidden" value="<?php echo (L("dhjebz")); ?>" id="dhjebz">
	<input type="hidden" value="<?php echo (L("dhjebsbs")); ?>" id="dhjebsbs">
	<script type="text/javascript">
		var dhjebnxy = $('#dhjebnxy').val();
		var dhjebz = $('#dhjebz').val();
		var dhjebsbs = $('#dhjebsbs').val();
		$('#aaa').on('click', function () {
			var maxe = $('#money').text(); //余额
			var maxe = Number(maxe); //余额
			var dhnums = $('.dhnums').val(); //要兑换的数量
			var dhnums = Number(dhnums); //要兑换的数量
			if (dhnums < 100) {
				msg_alert(dhjebnxy);
				return;
			}

			if (maxe < dhnums) {
				msg_alert(dhjebz);
				return;
			} else {
				var yuee = dhnums % 100;
				if (yuee != 0) {
					msg_alert(dhjebsbs);
					return;
				}
			}

			var getjifens = dhnums * 6;
			$('.zhifu_price p').text(getjifens + '.00');
			$(".ftc_wzsf").show();

			$('html,body').css('height', '100%');
			// $('body').css('margin-top', '1rem');

			$('.w-header').css('position', 'fixed');
			$('.header .w-header').css('top', '0');
			$('.header .w-header').css('left', '0');
		});
		$(function () {
			//关闭浮动
			$(".close").click(function () {
				$(".ftc_wzsf").hide();
				$(".mm_box li").removeClass("mmdd");
				$(".mm_box li").attr("data", "");
				i = 0;
				$('.w-header').css('position', 'static');
				$('.header .w-header').css('top', '0');
				$('.header .w-header').css('left', '0');

				$('html,body').css('height', '');
				$('body').css('margin-top', '0');

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
							var dhnums = $('.dhnums').val(); //要兑换的数量
							$.ajax({
								url: '/Index/Exehange',
								type: 'post',
								data: {
									'dhnums': dhnums,
									'pwd': pwd
								},
								datatype: 'json',
								success: function (mes) {
									if (mes.status == 1) {
										msg_alert(mes.message,mes.url);
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
		});
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