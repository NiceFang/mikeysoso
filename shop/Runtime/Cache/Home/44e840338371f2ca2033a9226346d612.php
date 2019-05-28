<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("tellfriend")); ?></title>
<!-- <link rel="stylesheet" href="/Public/home/wap/css/mui.min.css"> -->
<!-- 旧代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/digital.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css">
<link rel="stylesheet" href="/Public/home/wap/css/YangStyle.css"> -->

<!-- 新代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/share.css">
<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script src="/Public/home/wap/js/mui.min.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>


<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<script type="text/javascript" src="/Public/home/common/js/clipboard.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>
<style>
    /* .bg96{background: #fff;}
    .big_width100{background: #fff;}
    .w-bj p{margin: 0;}
	.centBalance .dLine{top: 0.3rem;}
    .w-mydiv h3{color: #000;font-size: .4rem;}
    .w-mydiv h4 {color: #000;font-size: .26rem !important;text-align: center;}
    .w-mydiv{ width: 85%;}
    #text_input {
        -webkit-touch-callout: text;
        -webkit-user-select: text;
        -moz-user-select: text;
        -ms-user-select: text;
        user-select: text;
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

    <!-- 旧的代码 -->
    <!-- <div class="headerb">
        <div class="userInfo" style="width: 75%">
            <a href="<?php echo U('User/Personal');?>">
                <div class="toux_icon"><img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>"></div>
            </a>
            <div class="uid_xy">
                <p>UID:<?php echo ($uinfo['userid']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (L("rank")); ?>:
                    <?php echo $uinfo['use_grade_name'] ? $uinfo['use_grade_name'] : L('zyz')?>
                </p>
            </div>
        </div>
        <div class="header_rb"> <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/index/shez-icon.png" alt=""></a></div>
    </div>

    </div>


    <div class="big_width100">
        <div class="w-bj">
            <div class="shaomZ">
                <a class="shaom">
                    <img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>" class="icon">
                    <?php if($uinfo['vip_grade'] != 0) {?>
                    <img src="/Public/home/wap/images/hyjb-VIP.png" class="w-vip">
                    <?php }?>
                </a>
            </div>
            <div class="centBalance">
                <div class="Balance">
                    <p><a class="balance" href="###"><?php echo (L("yue")); ?><br /><strong class="moneyS_icon"><img src="/Public/home/wap/images/integraimages/balance3030.png"><span
                                    class="yue"><?php echo (Showtwo($moneyinfo['cangku_num'])); ?></span></strong></a></p>
                </div>
                <div class="Balance">
                    <p><a class="balance" href="###"><?php echo (L("jifen")); ?><br /><strong class="moneyS_icon"><img src="/Public/home/wap/images/integraimages/balance3030.png"><span
                                    class="jifen"><?php echo (Showtwo($moneyinfo['fengmi_num'])); ?></span></strong></a></p>
                </div>
                <div class="dLine"></div>
            </div>
        </div>
        <div class="w-center">
            <div class="fill_sty">
                <div class="w-erweima">
                    <img src="<?php echo ($urel); ?>" alt="">
                </div>
                <div class="w-mydiv">
                    <h3><?php echo (L("tellfriend")); ?>&nbsp;<?php echo (L("tjsm")); ?></h3> -->
    <!-- <h4> -->
    <!--<a href="<?php echo ($urel); ?>" download="download.png">(点击此处&nbsp;&nbsp;保存二维码)</a>-->
    <!--<a href="/Growth/test?filename=.<?php echo ($urel); ?>" >(点击此处&nbsp;&nbsp;保存二维码)</a>-->
    <!-- <input type="text" value="<?php echo ($url); ?>" id="text_input"> -->
    <!-- <a class="btn" target="<?php echo ($urel); ?>" data-clipboard-action="copy" data-clipboard-target="#btn2">(点击此处&nbsp;&nbsp;复制链接)</a> -->
    <!-- <a id="copy_text">(<?php echo (L("djcc")); ?>&nbsp;&nbsp;<?php echo (L("fzdm")); ?>)</a> -->
    <!-- </h4> -->
    <!-- <div class="bottom"></div> -->
    <!-- </div>
                <div class="w-zhuanchu">
                    <a href="<?php echo U('User/Teamdets');?>" id="ternNextStep"><?php echo (L("fxjlck")); ?></a>
                </div>
            </div>
        </div>
    </div> -->


    <!-- 新的代码 -->
    <!-- 头部 -->
    <div class="hear">
        <a href="<?php echo U('Index/index');?>" class="jiantou"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
        <p><?php echo (L("share")); ?></p>
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

    <!-- 高度 -->

    <div class="height"></div>

    <!-- 内容 -->
    <div class="content">
        <div class="qr_code">
            <img src="<?php echo ($urel); ?>" alt="">
        </div>
        <div class="share">
            <p class="txt"><?php echo (L("tellfriend")); echo (L("tjsm")); ?></p>
            <input type="text" value="<?php echo ($url); ?>" id="text_input">
            <a id="copy_text" class="copy">(<?php echo (L("djcc")); ?>&nbsp;&nbsp;<?php echo (L("fzdm")); ?>)</a>
            <a href="<?php echo U('User/Teamdets');?>" class="examine_share"><?php echo (L("fxjlck")); ?></a>

        </div>
    </div>

    <script>
        var inputElem = document.getElementById('text_input');
        var btnElem = document.getElementById('copy_text');
        btnElem.addEventListener('click', function () {
            if (!document.execCommand) {
                console.error('copy unsupport');
               
                return;
            }
            inputElem.select();
            var result = document.execCommand('copy');
            if (result) {
                console.log('copy success');
                // alert("")
            } else {
                console.error('copy fail');
            }
        });
    </script>

     
    <!-- <div class="big_width100" >
   
   <div class="qindHB">
     <div class="qindHB_nb">
         <img src="/Public/home/wap/images/hongbaoyema.png" class="qinb_imga">
          <a href="javascript:void(0);" >
            <a href="<?php echo U('Index/index');?>"><img src="/Public/home/wap/images/cunryuea.png"></a>
          </a>
          <div class="qiandHB_wz">
            
          </div>
     </div>
   </div>
   <div class="qindHB_bg"> </div>

 </div> -->
    <input type="hidden" value="<?php echo (L("zbzcxjjy")); ?>" id="zbzcxjjy">
    <input type="hidden" value="<?php echo (L("fzcg")); ?>" id="fzcg">
    <input type="hidden" value="<?php echo (L("zwkf")); ?>" id="zwkf">
    <input type="hidden" value="<?php echo (L("guoji")); ?>" id="guoji">
    <input type="hidden" value="<?php echo (L("fzcg")); ?>" id="fzcg">
    <script type="text/javascript">
        $(document).ready(function () {
            var zbzcxjjy = $('#zbzcxjjy').val();
            $(".xianzjiaoy").click(function () {
                msg_alert(zbzcxjjy);
            });
            // new ClipboardJS('.btn', {
            //     text: function (trigger) {
            //         return trigger.getAttribute('target'); // 返回需要复制的内容
            //         clipboard.destroy()
            //     }

        })
    </script>
    <script>
        var inputElem = document.getElementById('text_input');
        var btnElem = document.getElementById('copy_text');
        var fzcg = $('#fzcg').val();
        btnElem.addEventListener('click', function () {
            if (!document.execCommand) {
                console.error('copy unsupport');

                return;
            }
            inputElem.select();
            var result = document.execCommand('copy');
            if (result) {
                msg_alert(fzcg);
            } else {}
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var zbzcxjjy = $('#zbzcxjjy').val();
            $(".xianzjiaoy").click(function () {
                msg_alert(zbzcxjjy);
            });
            // 点击复制链接
            // var clipboard = new ClipboardJS('.btn');

            // clipboard.on('success', function (e) {
            //     console.log(e);
            //     // clipboard.destroy()
        });
        function downloadImage(src) {
            if(confirm("是否确定下载")){
                var $a = $("<a></a>").attr("href", src).attr("download", new Date().getTime()+".png");
                $a[0].click();
            }else{
                return false;
            }

        }
    </script>
    <style type="text/css">
        .qindHB_bg {
            top: 0;
            left: 0;
            background: rgba(0, 0, 0, .6);
            z-index: 100;
            position: fixed;
            height: 100%;
            width: 100%;
        }

        .qindHB {
            position: absolute;
            z-index: 101;
            padding: 0;
            left: 0;
            top: 0;
            width: 100%;
            opacity: 1;

        }

        .qindHB_nb {
            z-index: 102;
            width: 100%;
            position: relative;
        }

        .qindHB_nb a {
            width: 100%;
            display: block;
            margin-top: 20px;
        }

        .qindHB_nb a img {
            z-index: 104;
            width: 100%;
        }

        .qinb_imga {
            height: 22rem;
            margin: 0 auto;
            display: block;
            margin-top: 2rem;
        }

        .qiandHB_wz {
            position: absolute;
            top: 7rem;
            width: 50%;
            left: 25%;
            text-align: center;
        }

        .qiandHB_wz h3 {
            font-size: 1.8rem;
            padding-bottom: 1rem;
            border-bottom: 1px dotted rgba(217, 45, 45, 0.4);
            color: #d92d2d;
            line-height: 1.8rem;
            font-weight: 900;
        }

        .qiandHB_wz p {
            font-size: 1rem;
            color: #d92d2d;
            line-height: 2.4rem;
            font-weight: 900;
        }
    </style>


        
        
    <script>
        function copyArticle(event) {
            var fzcg = $('#fzcg').val();
            const range = document.createRange();
            range.selectNode(document.getElementById('content'));

            const selection = window.getSelection();
            if (selection.rangeCount > 0) selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');
            alert(fzcg);
        }

        document.getElementById('copyBT').addEventListener('click', copyArticle, false);
    </script>
    <script>
        function download(url, name) {
            var aLink = $('a');
            aLink.download = name;
            aLink.href = url;
            aLink.dispatchEvent(new MouseEvent('click', {}))
        }
        download()
    </script>
    <script>
        var zwkf = $('#zwkf').val();
        var notSell = $("#notSell");
        notSell.click(function () {
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