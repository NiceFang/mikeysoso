<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>订单详情</title>
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderbase.css">
    <link rel="stylesheet" href="/Public/home/wap/css/Mikeyparticulars.css">
    <script src="/Public/home/wap/js/rem.js"></script>
    <script>
    </script>
</head>

<body>
    <!-- 头部 -->
    <div class="hear Order_hear">
        <a href="javascript:history.go(-1)" class="jiantou"><img src="/Public/home/wap/images/jiantou2416.png" alt=""></a>
        订单详情
    </div>

    <!-- 卖出 -->
    <div class="content">
        <div class="sale_box">
            <div class="sale_box_left fl">
                <div class="m">
                    <img src="/Public/home/wap/images/m_info.png" alt="">
                </div>
                <?php echo ($orderDetails["pay_nums"]); ?>
            </div>
            <div class="sale_box_content fl">
                <?php if($orderDetails['trans_type'] == 0): ?><p class="name"><?php echo ($payin_name); ?></p>
                    <p class="num"><?php echo ($orderDetails["payin_id"]); ?></p>
                    <?php else: ?>
                    <p class="name"><?php echo ($payout_name); ?></p>
                    <p class="num"><?php echo ($orderDetails["payout_id"]); ?></p><?php endif; ?>


                <div class="div_box">
                    <?php if($orderDetails['pay_type'] == 1): ?><img src="/Public/home/wap/images/yinghangka1.png" alt="">
                        <?php elseif($orderDetails['pay_type'] == 2): ?>
                    <img src="/Public/home/wap/images/zhifubao1.png" alt="">
                        <?php elseif($orderDetails['pay_type'] == 3): ?>
                    <img src="/Public/home/wap/images/weixin1.png" alt="">
                        <?php else: ?>
                    <img src="/Public/home/wap/images/IMtoken1.png" alt=""><?php endif; ?>
                </div>
            </div>
            <div class="div_img">
                <img src="<?php echo ($img); ?>" alt="">
                   <!--     <?php if($orderDetails['pay_state'] == 0): ?><img src="<?php echo (L("djd")); ?>" alt="">
                        <?php elseif($orderDetails['pay_state'] == 1): ?>
                    <img src="/Public/home/wap/images/daifukuan.png" alt="">
                        <?php elseif($orderDetails['pay_state'] == 2): ?>
                    <img src="/Public/home/wap/images/daishoukuan.png" alt="">
                        <?php else: ?>

                    <img src="" alt=""><?php endif; ?>-->
            </div>
        </div>
        <div class="user_info">
            <p class="seller">卖方:<?php echo ($payout_name); ?></p>
            <p>买方: <?php echo ($payin_name); ?></p>
            <p>订单号:<?php echo ($orderDetails["pay_no"]); ?></p>
            <p>买方ID:<?php echo ($orderDetails["payin_id"]); ?></p>
            <p><?php echo (L("mczh1")); ?>:<?php echo ($orderDetails["payout_id"]); ?></p>
            <?php if($orderDetails['trans_type'] == 0): ?><p>订单类型: 买入</p>
                <?php else: ?>
                <p>订单类型: 卖出</p><?php endif; ?>
            <p><?php echo (L("zzpz")); ?>：</p>
            <div class="file_box">
                <input type="file">
                <p><img src="<?php echo ($orderDetails['trans_img']); ?>" alt=""></p>
            </div>
        </div>
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