<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo (L("yhzc")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/login.css">
    <link rel="stylesheet" href="/Public/home/wap/css/normalize.css">
    <script type="text/javascript" src="/Public/home/common/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
    <script src="/Public/home/wap/js/rem.js"></script>
    <!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>
    <style type="text/css">
        .bgf5 {
            background-size: 100% 100%;
        }
    </style>
</head>

<body class="">
<input id="hid_lag" type="hidden" value="<?php echo I('get.l');?>" />
    <div class="bgf5" style="position:fixed;"></div>
    <div class="login-container register-container bg register_bg">
        <div class="top register_top">
            <div class="loginLanguage">
                <div id="sample" class="dropdown">
                    <div id="div_curr_lag" class="parent">
                        <a href="#">
                            <span><img class="flag" src="/Public/home/wap/images/English.png" alt="" />English</span></a>
                    </div>
                    <div class="son">
                        <div id="div_en-us" onclick="gradeOnclick('en-us')">
                            <a>
                                <img class="flag" src="/Public/home/wap/images/English.png" alt="" />English<span class="value"></span>
                            </a>
                        </div>
                        <div id="div_zh-cn" onclick="gradeOnclick('zh-cn')">
                            <a><img class="flag" src="/Public/home/wap/images/china.png" alt="" />中文<span class="value"></span>
                            </a>
                        </div>
                        <div id="div_zxcghy84-corean" onclick="gradeOnclick('zxcghy84-corean')">
                            <a><img class="flag"
                                    src="/Public/home/wap/images/hanguo.png" alt="" />한국어<span class="value"></span>
                                </a>
                                </div>
                        <div id="div_zxcghy84-jp" onclick="gradeOnclick('zxcghy84-jp')"><a><img class="flag" src="/Public/home/wap/images/Japan.png"
                                    alt="" />わぶん<span class="value"></span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="formbox">
            <!-- <div class="register-title"><span>用户注册</span></div> -->
            <div class="logo registerLogo">
                <img src="/Public/home/wap/images/logo4.png">
            </div>
            <form name="AddUser" action="<?php echo U('Login/register');?>" id="registerForm" class="formrgister" method="get">
                <input type="hidden" name="reg_source" value="<?php echo I('get.source',0,'intval');?>">
                <div class="input_box">
                    <span><img src="/Public/home/wap/images/user.png" alt=""></span>
                    <input type="text" name="username" class="username" placeholder="<?php echo (L("qsrnc")); ?>" value="" autocomplete="off" maxlength="6" onblur="volidateUserName(this)"/>
                </div>
                <div class="input_box">
                    <span><img src="/Public/home/wap/images/phone.png" class="phone" alt=""></span>
                    <input type="text" name="mobile" class="phone_number" placeholder="<?php echo (L("qsrsjhm")); ?>" id="number" />
                </div>
                <div class="input_box">
                    <span><img src="/Public/home/wap/images/password.png" alt=""></span>
                    <input type="password" name="login_pwd" class="password" placeholder="<?php echo (L("qsrddlmm")); ?>" id="demo_input"
                        oncontextmenu="return false" onpaste="return false" />
                    <span class="right"><img id="demo_img" onclick="hideShowPsw()" src="/Public/home/wap/images/mima.png" alt=""></span>
                </div>
                <div class="input_box">
                    <span><img src="/Public/home/wap/images/password.png" alt=""></span>
                    <input type="password" name="relogin_pwd" class="confirm_password" placeholder="<?php echo (L("zcsrdlmm")); ?>"
                        id="zc_input" oncontextmenu="return false" onpaste="return false" />
                    <span class="right"><img id="zc_img" onclick="hideShowPswZC()" src="/Public/home/wap/images/mima.png" alt=""></span>
                </div>
                <div class="input_box">
                    <span><img src="/Public/home/wap/images/password.png" alt=""></span>
                    <input type="password" name="safety_pwd" class="safety_pwd" placeholder="<?php echo (L("qsrjymm")); ?>" id="Jy_input"
                        oncontextmenu="return false" onpaste="return false" />
                    <span class="right"><img id="Jy_img" onclick="hideShowPswJy()" src="/Public/home/wap/images/mima.png" alt=""></span>
                </div>
                <div class="input_box input_code" id="captcha-container">
                    <span><img src="/Public/home/wap/images/groph_code.png" alt=""></span>
                    <input name="verify" class="captcha-text" placeholder="<?php echo (L("qsrjsjg")); ?>" id="j_verify" type="text">
                    <img alt="图形验证码" src="<?php echo U('Home/Login/verify_c',array());?>" title="<?php echo (L("djsx")); ?>">
                </div>
                <!--推荐人账号或者UID-->
                <div class="input_box">
                    <span><img src="/Public/home/wap/images/phone.png" alt="" class="phone"></span>
                    <input type="text" name="pid" placeholder="<?php echo (L("tjrsjhm")); ?>" value="<?php echo ($mobile); ?>">
                </div>
                <div class="input_box input_code">
                    <span><img src="/Public/home/wap/images/moblie_code.png" alt=""></span>
                    <input type="number" id="code" name="code" class="code" placeholder="<?php echo (L("sjyzm")); ?>"
                        oncontextmenu="return false" onpaste="return false" />
                    <a id="mycode"><?php echo (L("hq")); ?></a>
                </div>
                <div class="inde-btn">
                    <button id="submit" type="button" onclick="adduser(a)"><?php echo (L("zc")); ?></button>
                </div>
            </form>
        </div>

        <div class="extra_btn ">
            <a href="<?php echo U('Login/login');?>?l=<?php echo I('get.l');?>&mobile=<?php echo ($mobile); ?>" class="inde-reg">
                <img src="/Public/home/wap/images/fanhui.png" alt=""><?php echo (L("fhdl")); ?></a>
        </div>
    </div>
    <!--点击刷新-->
    <input type="hidden" id="djsx" value="<?php echo (L("djsx")); ?>">
    <!--图形验证码错误-->
    <input type="hidden" id="txyzmcw" value="<?php echo (L("txyzmcw")); ?>">
    <!--请输入手机号码-->
    <input type="hidden" id="qsrsjhm" value="<?php echo (L("qsrsjhm")); ?>">
    <!--分-->
    <input type="hidden" id="fen" value="<?php echo (L("fen")); ?>">
    <!--秒-->
    <input type="hidden" id="miao" value="<?php echo (L("miao")); ?>">
    <!--获取验证码-->
    <input type="hidden" id="hqyzm" value="<?php echo (L("hqyzm")); ?>">
    <!--没有倒计时-->
    <input type="hidden" id="mydjs" value="<?php echo (L("mydjs")); ?>">
    <!--手机号码不能为空-->
    <input type="hidden" id="sjhmbnwk" value="<?php echo (L("sjhmbnwk")); ?>">
    <!--五分钟内禁止注册-->
    <input type="hidden" id="wfznjzzc" value="<?php echo (L("wfznjzzc")); ?>">
    <!--姓名不能为空-->
    <input type="hidden" id="xmbnwk" value="<?php echo (L("xmbnwk")); ?>">
    <!--推荐人不能为空-->
    <input type="hidden" id="tjrbnwk" value="<?php echo (L("tjrbnwk")); ?>">
    <!--推荐人手机号码错误-->
    <input type="hidden" id="tjrsjhmcw" value="<?php echo (L("tjrsjhmcw")); ?>">
    <!--登录密码不能为空-->
    <input type="hidden" id="dlmmbnwk" value="<?php echo (L("dlmmbnwk")); ?>">
    <!--登录密码只能为6-20为数字或字母-->
    <input type="hidden" id="dlmmznwsz" value="<?php echo (L("dlmmznwsz")); ?>">
    <!--两次输入登录密码不一致-->
    <input type="hidden" id="lcsrdlmmbyz" value="<?php echo (L("lcsrdlmmbyz")); ?>">
    <!--交易密码只能为6位数-->
    <input type="hidden" id="jymmznw6w" value="<?php echo (L("jymmznw6w")); ?>">
    <!--验证码不能为空-->
    <input type="hidden" id="yzmbnwk" value="<?php echo (L("yzmbnwk")); ?>">
    <!--请输入新密码-->
    <input type="hidden" id="qsrxmm" value="<?php echo (L("qsrxmm")); ?>">
    <!--请输入确认密码-->
    <input type="hidden" id="qsrqrmm" value="<?php echo (L("qsrqrmm")); ?>">
    <!--两次输入密码不一致-->
    <input type="hidden" id="lcsrdmmbyz" value="<?php echo (L("lcsrdmmbyz")); ?>">

    <!--表单验证-->
    <script type="text/javascript" src="/Public/home/common/js/index.js?v=46"></script>
    <script src="/Public/home/wap/js/jquery.validate.min.js?var1.14.0"></script>
    <script type="text/javascript">
        // 验证码生成  
        var a = 1;
        var captcha_img = $('#captcha-container>img');
        var verifyimg = captcha_img.attr("src");
        var djsx = $('#djsx').val(); //点击刷新
        captcha_img.attr('title', djsx);
        captcha_img.click(function () {
            if (verifyimg.indexOf('?') > 0) {
                $(this).attr("src", verifyimg + '&random=' + Math.random());
            } else {
                $(this).attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            }
        });


        $("#j_verify").blur(function () {
            $.post("<?php echo U('Login/check_verify');?>", {
                code: $("#j_verify").val()
            }, function (data) {
                var txyzmcw = $('#txyzmcw').val();
                if (data == true) {
                    //验证码输入正确
                    a = 0;
                    // layer.msg('图形验证码正确');
                } else {
                    //验证码输入错误
                    a = 1;
                    layer.msg(txyzmcw);

                }
            });
        });

        $('#mycode').click(function () {
            $("#submit").css('backgroundColor', "rgba(255,255,255,0.5)");
            var mobile = $("input[name='mobile']").val();
            var qsrsjhm = $('#qsrsjhm').val(); //请输入手机号
            var txyzmcw = $('#txyzmcw').val();
            var imgCode = $("#j_verify").val();
            if (mobile == '' || mobile == null) {
                layer.msg(qsrsjhm);
            }

            if (a == 1) {
                layer.msg(txyzmcw);
                return;
            } else {
                $.post("<?php echo U('Login/sendCode');?>", {
                    'mobile': mobile,
                    'verify':imgCode,
                    'l': "<?php echo I('get.l');?>"
                }, function (data) {
                    console.log(data);
                   if (data.status == 1) {
                        layer.msg(data.message);
                        RemainTime();
                    } else {
                        layer.msg(data.message);
                    }
                });
            }

        });

        var intime = "<?php echo (session('set_time')); ?>";
        var timenow = "<?php echo time(); ?>";

        var bet = (parseInt(intime) + 60) - parseInt(timenow);
        $(document).ready(function () {
            if (bet > 0) {
                RemainTime();
            }
        });
        var iTime = 59;
        var Account;
        if (bet > 0) {
            iTime = bet;
        }
        // 封装的计时器
        function RemainTime() {
            var iSecond, sSecond = "",
                sTime = "";
            if (iTime >= 0) {
                iSecond = parseInt(iTime % 60);
                iMinute = parseInt(iTime / 60)
                if (iSecond >= 0) {
                    if (iMinute > 0) {
                        sSecond = iMinute + "m" + iSecond + "s";
                    } else {
                        sSecond = iSecond + "s";
                    }
                }
                sTime = sSecond;
                if (iTime == 0) {
                    var hqyzm = $('#hqyzm').val() //获取验证码
                    clearTimeout(Account);
                    sTime = hqyzm;
                    iTime = 59;
                } else {
                    Account = setTimeout("RemainTime()", 1000);
                    iTime = iTime - 1;
                }
            } else {
                sTime = '没有倒计时';
            }
            $('#mycode').html(sTime);
        }

        // 点击密码显示明文及暗文
        function hideShowPsw() {
            var demoImg = document.getElementById("demo_img");
            var demoInput = document.getElementById("demo_input");
            if (demoInput.type == "password") {
                demoInput.type = "text";
                demoImg.src = "/Public/home/wap/images/keshi.png";
            } else {
                demoInput.type = "password";
                demoImg.src = "/Public/home/wap/images/mima.png";
            }
        }

        function hideShowPswZC() {
            var zcImg = document.getElementById("zc_img");
            var zcInput = document.getElementById("zc_input");
            if (zcInput.type == "password") {
                zcInput.type = "text";
                zcImg.src = "/Public/home/wap/images/keshi.png";
            } else {
                zcInput.type = "password";
                zcImg.src = "/Public/home/wap/images/mima.png";
            }
        }

        function hideShowPswJy() {
            var JyImg = document.getElementById("Jy_img");
            var JyInput = document.getElementById("Jy_input");
            if (JyInput.type == "password") {
                JyInput.type = "text";
                JyImg.src = "/Public/home/wap/images/keshi.png";
            } else {
                JyInput.type = "password";
                JyImg.src = "/Public/home/wap/images/mima.png";
            }
        }
        // 点击切换语言下拉菜单
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
                $(".dropdown .son").hide();
            });

            var curr_lag = $("#hid_lag").val();
            if (curr_lag == "") {
                gradeOnclick("en-us");
            } else {
                var curr_html_lag = $("#div_" + curr_lag).html();
                $("#div_curr_lag").html(curr_html_lag);
            }

        });
        //  点击切换语言
        function gradeOnclick(url) {
            window.location.href = "?l=" + url;
        }

        function volidateUserName(e){
            // var reg = /^[\\w[0-9]\u4e00-\u9fa5\uFF21-\uFF3A\uFF41-\uFF5A]/;
            var value1 = $('.username').val();
            //console.log(value1)
            if(value1 == "" || a==null || a==undefined){
                $('.username').attr("placeholder","<?php echo (L("xmbnwk")); ?>");
            }

        }
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