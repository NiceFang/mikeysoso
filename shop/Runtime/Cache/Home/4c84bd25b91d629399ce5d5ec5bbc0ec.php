<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo (L("lsdd")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderSale.css">
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderbase.css">

    <script src="/Public/home/wap/js/rem.js"></script>
    <!-- 获取头部的颜色 -->
    <script type="text/javascript" src="/Public/home/wap/js/jquery.min2.0.js"></script>
    <script>
    </script>

    <style>
        .sale_box {
            position: relative;
        }

        .time {
            font-size: 12px;
            position: absolute;
            top: 5px;
            right: 10px;
            color: #ccc;

        }
    </style>
</head>

<body>
    <!-- 头部 -->
    <div class="hear Order_hear">
        <a href="<?php echo U('Index/myOrderSale');?>" class="jiantou"><img src="/Public/home/wap/images/jiantou2416.png" alt=""></a>
        <?php echo (L("lsdd")); ?>
    </div>

    <div class="deal">
        <div class="left">
            <a  class="a" name="ywc" data-val="ywc">已完成</a>
        </div>
        <div class="right">
            <a class="a"  name="yqx"  data-val="yqx">已取消</a>
        </div>
    </div>

    <!-- 卖出 -->
    <span class="span">
        <?php if(is_array($transData)): $i = 0; $__LIST__ = $transData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="sale_box" data-id="<?php echo ($vo["id"]); ?>">
                <div class="sale_box_left fl">
                    <div class="m">
                        <img src="/Public/home/wap/images/m_info.png" alt="">
                    </div>
                    <?php echo ($vo["pay_nums"]); ?>
                </div>
                <div class="sale_box_content fl">
                    <p class="name"><?php echo ($vo["username"]); ?></p>
                    <?php if($vo["trans_type"] == 1): ?><p class="num"><?php echo ($vo["payout_id"]); ?></p>
                        <?php else: ?>
                        <p class="num"><?php echo ($vo["payin_id"]); ?></p><?php endif; ?>
                    <div class="div_box">
                        <?php if($vo["pay_type"] == 1): ?><img src="/Public/home/wap/images/yinghangka1.png" alt="">
                            <?php elseif($vo["pay_type"] == 2): ?>
                            <img src="/Public/home/wap/images/zhifubao1.png" alt="">
                            <?php elseif($vo["pay_type"] == 3): ?>
                            <img src="/Public/home/wap/images/weixin1.png" alt="">
                            <?php elseif($vo["pay_type"] == 4): ?>
                            <img src="/Public/home/wap/images/IMtoken1.png" alt=""><?php endif; ?>
                    </div>
                </div>
                <div class="time"><?php echo (date("Y-m-d H:i:s",$vo["pay_time"])); ?></div>
                <?php if($name == 'ywc'): ?><div class="sale_box_right history_sale_box_right fr " id="history_sale_box_right">
                        <?php echo (L("ywc")); ?>
                    </div>
                    <?php elseif($name == 'yqx'): ?>
                    <div class="sale_box_right history_sale_box_right fr " id="history_sale_box_call">
                        <?php echo (L("yqx")); ?>
                    </div><?php endif; ?>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
    </span>
</body>

</html>
<script>
    $(function () {
        $(".span").on("click", ".sale_box", function () {
            var orderId = $(this).data('id');
            var url = window.location.search;
            window.location.href = "Mikeyparticulars.html"+url+"&orderId=" + orderId;
        })
        $('.a').click(function () {
          ///user/historyOrder.html?type=cancel
          if($(this).data('val')=="ywc"){
              window.location.href ="/user/historyOrder.html?type=acc"
          }else{
              window.location.href ="/user/historyOrder.html?type=cancel"
          }

          //  $(this).addClass('active').parent().siblings().find("a").removeClass('active');
         });
        var url = window.location.search;
        if(url=="?type=cancel"){
            $("[name=\"yqx\"]").addClass('active')//.parent().siblings().find("a").removeClass('active');
        }else if(url=="?type=acc"){
            $("[name=\"ywc\"]").addClass('active')//.parent().siblings().find("a").removeClass('active');
        }

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