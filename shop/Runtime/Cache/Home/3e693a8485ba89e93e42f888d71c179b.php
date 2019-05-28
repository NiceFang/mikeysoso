<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("team")); ?></title>

<!-- 旧的代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css"> -->

<!-- 新的代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/shareRecord.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>
<script src="/Public/home/wap/js/mui.min.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>

<body >

    <!-- 旧代码 -->
    <!-- <div class="header">
        <div class="header_l">
            <a href="javascript:history.go(-1)"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
        </div>
        <div class="header_c">
            <h2><?php echo (L("fxjl")); ?></h2>
        </div>
        <div class="header_r"></div>
    </div>

    <div class="big_width100 por">

        <form action="<?php echo U('User/Teamdets');?>" method="post">
            <div class="zySearch">
                <input id="searchInput" name="uinfo" class="search-input" value="<?php echo ($uinfo); ?>" type="text" placeholder="<?php echo (L("sousuo")); ?>UID/<?php echo (L("sjhm")); ?>">
                <button class="search-btn btn" style="background-color: #2874d5;"><?php echo (L("sousuo")); ?></button>
            </div>
        </form>

        <?php if(is_array($muinfo)): foreach($muinfo as $key=>$v): ?><div class="share_ul">
                <div class="share_ul_l">
                    <img src="/Public/home/wap/heads/<?php echo ($v['img_head']); ?>" alt="">
                    <div class="share_p">
                        <p><?php echo ($v['username']); ?></p>
                        <p>UID:<?php echo ($v['userid']); ?></p>
                        <p><?php echo (L("sjhm")); ?>:<?php echo ($v['mobile']); ?></p>

                    </div>
                </div>
                <div class="shijin"><?php echo (date("Y-m-d H:i:s",$v['reg_date'])); ?></div>

                <?php if($v['use_grade'] == 1): ?><div class="dengjxias">
                        <?php echo (L("zyz")); ?>
                        <?php elseif($v['use_grade'] == 2): ?>
                        <div class="dengjxias dengjxiasa">
                            <?php echo (L("hbws")); ?>
                            <?php elseif($v['use_grade'] == 3): ?>
                            <div class="dengjxias dengjxiasb">
                                <?php echo (L("hbkw")); ?>
                                <?php elseif($v['use_grade'] == 4): ?>
                                <div class="dengjxias dengjxiasc">
                                    <?php echo (L("hbdr")); ?>
                                    <?php elseif($v['use_grade'] == 5): ?>
                                    <div class="dengjxias dengjxiasc">
                                        <?php echo (L("hbds")); ?>
                                        <?php else: ?>
                                        <div class="dengjxias">
                                            <?php echo (L("zyz")); endif; ?>
            </div>
    </div><?php endforeach; endif; ?>
    </div> -->

    <!-- 新的代码 -->

     <!-- 头部 -->
     <div class="hear">
            <a href="<?php echo U('Index/index');?>" class="jiantou"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
            <p><?php echo (L("fxjl")); ?></p>
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
            </div>  -->
        </div>
        <!-- 个人信息 -->
        <div class="search_box">
            <div class="search_content">
                <div class="search_img">
                    <img src="/Public/home/wap/images/search.png" alt="">
                </div>
                <form action="<?php echo U('User/Teamdets');?>" method="post">
                        <input id="searchInput" name="uinfo" class="search-input" value="<?php echo ($uinfo); ?>" type="text" placeholder="<?php echo (L("sousuo")); ?>UID/<?php echo (L("sjhm")); ?>">
                        <!--<button class="search-btn btn" style="background-color: #2874d5;"><?php echo (L("sousuo")); ?></button>-->
                </form>
            </div>
        </div>
        
        <!-- 内容 -->
        <div class="div_box">
            <ul>
                <?php if(is_array($muinfo)): foreach($muinfo as $key=>$v): ?><li class="lis">
                        <div class="lis_top">
                            <div class="user_img fl">
                                <!--<img src="/Public/home/wap/images/<?php echo ($v["img_head"]); ?>" alt="">头像-->
                                <img src="/Public/home/wap/heads/<?php echo ($v['img_head']); ?>">
                                <!--<img src="/Public/home/wap/heads/toux-icon.png">-->
                            </div>
                            <div class="top_content fl">
                                <p class="name"><?php echo (L("nickname")); ?>：<?php echo ($v['username']); ?></p>
                                <p class="uid">UID : <?php echo ($v['userid']); ?> </p>
                                <p class="phone"><?php echo (L("sjhm")); ?>:<?php echo ($v['mobile']); ?></p>
                            </div>
                            <div class="top_right fr">

                                <?php if($v['use_grade'] == 1): ?><div class="top_right_img">
                                        <img src="/Public/home/wap/images/jiangpai.png" alt="">
                                    </div>
                                    <p> <?php echo (L("zyz")); ?></p>
                                    <?php elseif($v['use_grade'] == 2): ?>
                                    <div class="top_right_img">
                                        <img src="/Public/home/wap/images/jiangpaiTwo.png" alt="">
                                    </div>
                                    <p><?php echo (L("hbws")); ?></p>
                                    <?php elseif($v['use_grade'] == 3): ?>
                                    <div class="top_right_img">
                                        <img src="/Public/home/wap/images/jiangpaiThree.png" alt="">
                                    </div>
                                    <p><?php echo (L("hbkw")); ?></p>
                                    <?php elseif($v['use_grade'] == 4): ?>
                                    <div class="top_right_img">
                                        <img src="/Public/home/wap/images/jiangpaiFour.png" alt="">
                                    </div>
                                    <p><?php echo (L("hbdr")); ?></p>
                                    <?php elseif($v['use_grade'] == 5): ?>
                                    <div class="top_right_img">
                                        <img src="/Public/home/wap/images/jiangpaiFive.png" alt="">
                                    </div>
                                    <p><?php echo (L("hbds")); ?></p>
                                    <?php else: ?>
                                    <div class="top_right_img">
                                        <img src="/Public/home/wap/images/jiangpai.png" alt="">
                                    </div>
                                    <?php echo (L("zyz")); endif; ?>
                            </div>
                        </div>
                        <p class="time fr"><?php echo (date("Y-m-d H:i:s",$v['reg_date'])); ?></p>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>
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