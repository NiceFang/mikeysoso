<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("tochangeinto")); ?></title>
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css"> -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/digital.css"> -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css"> -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/YangStyle.css"> -->
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/Intro.css">

<script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>
<body>
    <!-- 头部 -->
    <div class="hear">
        <a href="javascript:history.go(-1)" class="jiantou"><img src="/Public/home/wap/images/integraimages/jiantouzuo.png" alt=""></a>
        <p><?php echo (L("share")); ?></p>
        <!-- 语言切换 -->
        <!-- 先不要删掉 -->
        <div class="top"> <!-- 使用时, class添加top -->
            <!-- <div class="loginLanguage">
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
            </div>-->
        </div> 
    </div>

    <!-- 个人信息 -->
    <div class="user_info">
        <?php echo W('Card/dengji',['userInfo']);?>
    </div>
    <div style="height: 32px;background: #002982">

    </div>
    <!-- 二维码 -->
    <div class="er_code">
        <div class="er_code_pic">
            <img src="<?php echo ($urel); ?>" alt="" style="width: 95%;">
        </div>
        <div class="txt"><?php echo (L("smewm")); ?>  <?php echo (L("xwfk")); ?></div>
        <?php if($name != 1): ?><div class="txt_1"><a href="#"  >（<?php echo (L("djcc")); ?> <?php echo (L("saveimg")); ?>）</a></div>
            <?php else: ?>
            <div class="txt_1"><a href="#" onclick='downloadImage("<?php echo ($urel); ?>")' >（长按图片保存二维码）</a></div><?php endif; ?>

    </div>

    <!-- 查看传入记录 -->
    <div class="checkBtn">
        <a href="<?php echo U('Growth/Introrecords');?>"><?php echo (L("zrjlck")); ?></a>
    </div>
</boay>

    <!-- 之前样式 -->

    <!-- <div class="headerb">
        <div class="userInfo" style="width: 75%">
            <a href="<?php echo U('User/Personal');?>">
                <div class="toux_icon"><img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>"></div>
            </a>
            <div class="uid_xy">
                <p>UID:<?php echo ($uinfo['userid']); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (L("rank")); ?>:
                    <?php echo $uinfo['vip_grade'] ? 'VIP' : L('pthy')?>
                </p>
            </div>
        </div>
        <div class="header_rb"> <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/index/shez-icon.png" alt=""></a></div>
    </div> -->

    <!-- 主体 -->
    <!-- <div class="">
        <div class="w-bj">
            <div class="shaomZ">
                <a class="shaom">
                    <img src="/Public/home/wap/heads/<?php echo ($uinfo['img_head']); ?>" class="icon">
                    <?php if($uinfo['vip_grade'] != 0) {?>
                    <img src="/Public/home/wap/images/hyjb-VIP.png" class="w-vip">
                    <?php }?>
            </div>
            <div class="centBalance">
                <div class="Balance">
                    <p><a class="balance"><?php echo (L("wdzc")); ?><br /><strong><span class="yue"><?php echo ((isset($minecoins[0]['c_nums']) && ($minecoins[0]['c_nums'] !== ""))?($minecoins[0]['c_nums']):"0.0000"); ?></span></strong></a></p>
                </div>
                <div class="Balance">
                    <p><a class="balance"><?php echo (L("nowprice")); ?><br /><strong><span class="jifen"><?php echo ($coindets[0]['coin_price']); ?></span></strong></a></p>
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
                    <h3><?php echo (L("smewm")); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (L("xwfk")); ?></h3>
                    <h4><a href="/Growth/test?filename=.<?php echo ($urel); ?>">(<?php echo (L("djcc")); ?>&nbsp;&nbsp;<?php echo (L("saveimg")); ?>)</a></h4>


                    <div class="bottom"></div>
                </div>
                <div class="w-zhuanchu">
                    <a href="<?php echo U('Growth/Introrecords');?>" id="ternNextStep"><?php echo (L("zrjlck")); ?></a>
                </div>
            </div>
        </div>
    </div> -->
    
    <!--<textarea cols="20" rows="10" id="biao1">用户定义的代码区域</textarea>
    <input type="button" onClick="copyUrl2()" value="点击复制代码" />-->

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
    <!-- <input type="hidden" value="<?php echo (L("zwkf")); ?>" id="zwkf">
    <input type="hidden" value="<?php echo (L("guoji")); ?>" id="guoji"> -->
    <script type="text/javascript">
        $(document).ready(function () {

            $(".xianzjiaoy").click(function () {
                msg_alert("<?php echo (L("zbzcxjjy")); ?>");
            });

        });
        function downloadImage(src) {
            var $a = $("<a></a>").attr("href", src).attr("download", new Date().getTime()+".png");
            $a[0].click();
        }
    </script>
 


        
    <script>
        function copyArticle(event) {
            const range = document.createRange();
            range.selectNode(document.getElementById('content'));

            const selection = window.getSelection();
            if (selection.rangeCount > 0) selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand('copy');
            alert("复制成功！");
        }

        /*document.getElementById('copyBT').addEventListener('click', copyArticle(), false);*/
    </script>
    <script>
        var zwkf = $('#zwkf').val();
        var notSell=$("#notSell");
        $("#notSell,#nokaifang").click(function(){
            alert(zwkf)
        })
        var guoji = $('#guoji').val();
        $("#guojiweikaifang").click(function () {
            if(guoji == 'hanguo'){
                $("#guojiweikaifang").attr('href','');
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