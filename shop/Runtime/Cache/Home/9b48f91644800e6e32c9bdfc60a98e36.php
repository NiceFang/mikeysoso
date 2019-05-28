<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo (L("myoder")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderSale.css">
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderbase.css">
    <script src="/Public/home/wap/js/rem.js"></script>
    
    <link rel="stylesheet" href="https://cdn.bootcss.com/mui/3.7.1/css/mui.min.css">
    <script src="/Public/home/wap/js/jquery-3.3.1.min.js"></script>
    <!--弹框JS-->
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>

    <script src="https://cdn.bootcss.com/mui/3.7.1/js/mui.min.js"></script>
    <!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>

    <style>
            .mui-table-view {
                background-color: rgba(0, 0, 0, 0);
                border: 0;
            }
            .mui-table-view-cell {
                padding: 0;
                border: 0;
                margin-top: 0.1667rem;
                position: relative;
                
            }
            .mui-table-view-cell>.mui-slider-handle {
                background-color: rgba(0, 0, 0, 0);
                margin: 0 auto;
                width: 6.8333rem
            }
            .mui-content>.mui-table-view:first-child {
                margin: 0;
            }
            .mui-table-view:before,.mui-table-view:after,.mui-table-view-cell:after {
                background-color: rgba(0, 0, 0, 0);
            }
    
            .sale_box {
                margin: 0;
            }
    
    
            
        </style>
</head>



<body>
    <!-- 头部 -->
    <div class="hear Order_hear">
        <a href="<?php echo U('Index/trading_center');?>" class="jiantou"><img src="/Public/home/wap/images/jiantou2416.png" alt=""></a>
        <?php echo (L("myoder")); ?>
        <a href="<?php echo U('user/historyOrder');?>?type=acc" class="history"><img src="/Public/home/wap/images/history_info.png" alt=""></a>
    </div>
    <!-- 买卖 -->
    <div class="deal">
        <div class="left">
            <a href="<?php echo U('Index/myOrderSale');?>?type=1" class="<?php if(I('get.type') == 1 ): ?>active<?php endif; ?>"><?php echo (L("sellout")); ?></a>
        </div>
        <div class="right">
            <a href="<?php echo U('Index/myOrderSale');?>?type=0" class="<?php if(I('get.type') == 0 ): ?>active<?php endif; ?>"><?php echo (L("purchase")); ?></a>
        </div>
    </div>

    <!-- 卖出 -->

    
    <div class="mui-content">
            <ul id="OA_task_1" class="mui-table-view">
                <?php if(is_array($orders)): foreach($orders as $key=>$vo): ?><li  class="mui-table-view-cell">
                        <div class="mui-slider-right mui-disabled">
                            <a class="mui-btn mui-btn-red" id="cancel" data-uid="<?php echo ($userid); ?>" data-pid="<?php echo ($vo["payin_id"]); ?>" data-type="<?php echo I('get.type');?>" data-id="<?php echo ($vo["id"]); ?>"><?php echo (L("qxdd")); ?></a>
                        </div>
                        <div class="mui-slider-handle">
                            <div class="sale_box">
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
                                        <?php if($vo["pay_type"] == 1): ?><img src="/Public/home/wap/images/trading_center/yinghangke.png" alt="">
                                            <?php elseif($vo["pay_type"] == 2): ?>
                                            <img src="/Public/home/wap/images/trading_center/zhifubao.png" alt="">
                                            <?php elseif($vo["pay_type"] == 3): ?>
                                            <img src="/Public/home/wap/images/trading_center/weixin.png" alt="">
                                            <?php elseif($vo["pay_type"] == 4): ?>
                                            <img src="/Public/home/wap/images/trading_center/IMtoken.png" alt=""><?php endif; ?>
                                    </div>
                                </div>
                                <!--<?php if($vo["pay_state"] == 3): ?>-->
                                    <!--<div class="sale_box_right fr confirm" id="confirm" data-id="<?php echo ($vo["id"]); ?>">-->
                                       <!--<input type="hidden" id="order" value="<?php echo ($vo["id"]); ?>">-->
                                        <!--<a>去 收 款</a>-->
                                    <!--</div>-->
                                    <!--<?php else: ?>-->
                                    <!--<div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">-->
                                        <!--<a href="<?php echo U('Index/confirm_pay','');?>">待 付 款</a>-->
                                    <!--</div>-->
                                <!--<?php endif; ?>-->
                                <?php if(I('get.type') == 0): if($vo["pay_state"] == 1): ?><div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                                <a href="<?php echo U('Index/confirm_pay');?>?type=1&id=<?php echo ($vo["id"]); ?>"><?php echo (L("qfk")); ?></a>
                                            </div>
                                            <?php elseif($vo["pay_state"] == 0): ?>
                                            <div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                                <a href="<?php echo U('User/Mikeyparticulars');?>?type=acc&orderId=<?php echo ($vo["id"]); ?>"><?php echo (L("djd")); ?></a>
                                            </div>
                                            <?php elseif($vo["pay_state"] == 2): ?>
                                            <div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                                <a href="<?php echo U('User/Mikeyparticulars');?>?type=acc&orderId=<?php echo ($vo["id"]); ?>"><?php echo (L("dsk")); ?></a>
                                                <!-- 已经付款订单调到详情页-->
                                            </div>
                                            <?php else: ?>
                                            <div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                                <a href="#">未 知</a>
                                            </div><?php endif; ?>
                                    <?php else: ?>
                                    <?php if($vo["pay_state"] == 1): ?><div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                            <a href="<?php echo U('User/Mikeyparticulars');?>?type=acc&orderId=<?php echo ($vo["id"]); ?>"><?php echo (L("dfk")); ?></a>
                                        </div>
                                        <?php elseif($vo["pay_state"] == 0): ?>
                                        <div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                            <a href="<?php echo U('User/Mikeyparticulars');?>?type=acc&orderId=<?php echo ($vo["id"]); ?>"><?php echo (L("djd")); ?></a>
                                        </div>
                                        <?php else: ?>
                                        <div class="sale_box_right fr confirm"  data-id="<?php echo ($vo["id"]); ?>">
                                            <a href="<?php echo U('Index/confirm_pay');?>?type=2&id=<?php echo ($vo["id"]); ?>"><?php echo (L("qsk")); ?></a>
                                        </div><?php endif; endif; ?>
                            </div>
                        </div>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div>


</body>

</html>
<script>
    function msg_alert(message,url){

        if(url){
            layer.msg(message,{time:3000},function(){
                window.location.href=url;
            });
        }else{
            layer.msg(message,{time:3000});
        }

    }
        $('#OA_task_1').on('click','#cancel',function(){
            var e = this;
            var id = $(e).attr('data-id');
            var uid = $(e).data('uid');
            var pid = $(e).data('pid');
            var r=confirm("<?php echo (L("qdyqxm")); ?>");
            var type = $(e).data('type');
            // var url = '/Index/quxiao_order';
            if(uid == pid){
                url = '/Growth/quxiao_order';
            }else{
                url = '/Trading/quxiao_order';
            }
            if (r==true)
            {
                $.ajax({
                    url:url,
                    type:'post',
                    data:{id:id},
                    success:function(meg){
                       if(meg.status == 0){
                            msg_alert(meg.message);
                       }else{
                           msg_alert(meg.message);
                         window.location.href='/index/myOrderSale?type='+type;
                       }
                    }
                })
            }
            else
            {

            }


        })
    // $('#OA_task_1').click(function(){
    $('#OA_task_1').on('click','#confirm',function(){
        var order = $(this).attr('data-id');
        window.location.href = "<?php echo U('Index/affirmGathering');?>?order="+order;
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