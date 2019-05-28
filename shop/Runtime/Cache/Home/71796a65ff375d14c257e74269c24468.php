<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("ncxg")); ?></title>

<!-- 旧的代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css"> -->

<!-- 新的代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/base.css">
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/Setuname.css">
<link rel="stylesheet" href="/Public/home/wap/css/accountManage.css">
<script src="/Public/home/wap/js/rem.js"></script>
<script src="/Public/home/wap/js/mui.min.js"></script>


<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
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
        <div class="header_c">
            <h2><?php echo (L("ncxg")); ?></h2>
        </div>
        <div class="header_r"></div>
    </div>

    <div class="big_width100">
        <div class="nic_xiu">
            <input type="text" name="username" class="username" value="<?php echo ($uname); ?>" placeholder="<?php echo (L("qsrnc")); ?>"
                autocomplete="off" />
        </div>

        <div class="buttonGeoup">
            <a href="javascript:void(0)" class="not_next ljzf_but "><?php echo (L("termine")); ?></a>
        </div>
    </div>
    <input type="hidden" id="qtxnc" value="<?php echo (L("qtxnc")); ?>"> -->

    <!-- 头部 -->
    <div class="hear">
        <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
        <?php echo (L("upname")); ?>
    </div>

    <!-- 用户信息 -->
    <div class="user_info">
        <form class="mui-input-group">
            <div class="mui-input-row user_info_lis">
                <label class="name nick"><?php echo (L("nickname")); ?></label>
                <input type="text" class="mui-input-clear nick_input username" placeholder="<?php echo (L("qsrnc")); ?>" value="<?php echo ($uname); ?>">
                <!--<input type="text" name="username" class="username" value="<?php echo ($uname); ?>" placeholder="请输入昵称" autocomplete="off"/>-->
            </div>
        </form>
    </div>

    <!-- 保存按钮 -->
    <div class="save_btn "><?php echo (L("bc")); ?></div>
</body>

</html>
<script>
     // 判断名字是否为空, 为其保存按钮添加样式
     $(".nick_input").blur(function () {
        if ($(".nick_input").val().trim() != "") {
            $(".save_btn").addClass("active");
        } else {
            $(".save_btn").removeClass("active");
        }
    })

    $('.save_btn').click(function () {
        var uname = $('.username').val();
        if(uname == null || uname == undefined || uname == '' ){
            msg_alert("<?php echo (L("qtxnc")); ?>");
            return;
        }
        if(uname.length>6){
            msg_alert("<?php echo L('nczcbcggz')?>");
            return;
        }
        $.ajax({
            url:'/User/Setuname',
            type:'post',
            data:{'uname':uname},
            datatype:'json',
            success:function (mes) {
                if(mes.status == 1){
                    msg_alert(mes.message,mes.url);
                }else{
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