<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo (L("qrdk")); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderSale.css">
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderbase.css">
    <script src="/Public/home/wap/js/rem.js"></script>
    <link rel="stylesheet" href="/Public/Public/verify/skin/layer.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/mui/3.7.1/css/mui.min.css">

    <script src="/Public/home/wap/js/jquery-3.3.1.min.js"></script>
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

        .sale_box_right a{
            background-color: #E72C18;
            border-radius: 0.1042rem;
        }


        /* 遮罩层 */
        .marker,.show_pic_marsker {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
        }

        .remit_bottom_box img.show_pic {
            top: 0;
            left: 0;
        }

        .show_pic_marsker {
            flex: 6;
            background-color: rgba(0, 0, 0, .3);
        }

        .big_img {
            width: 90%;
            height: 6.25rem;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
        }

        .big_img img {
            width: 100%;
        }

        .sale_box .sale_box_content .name.username {
            width: 2.25rem;
            line-height: 0.4167rem;
            word-break: break-all;
            text-overflow: ellipsis;
            display: -webkit-box; /** 对象作为伸缩盒子模型显示 **/
            -webkit-box-orient: vertical; /** 设置或检索伸缩盒对象的子元素的排列方式 **/
            -webkit-line-clamp: 1; /** 显示的行数 **/
            overflow: hidden;  /** 隐藏超出的内容 **/
        }



    </style>
</head>

<body>
<!-- 头部 -->
<div class="hear Order_hear">
    <a href="<?php echo U('Index/myOrderSale');?>" class="jiantou"><img src="/Public/home/wap/images/jiantou2416.png" alt=""></a>
    <?php echo (L("qrdk")); ?>
    <a href="<?php echo U('index/myOrderSale');?>" class="history"><img src="/Public/home/wap/images/history_info.png" alt=""></a>
</div>

<!-- 卖出 -->
<div class="mui-content">
    <ul id="OA_task_1" class="mui-table-view">
        <li  class="mui-table-view-cell">
            <div class="mui-slider-right mui-disabled">
                <a class="mui-btn mui-btn-red"><?php echo (L("qxdd")); ?></a>
            </div>
            <div class="mui-slider-handle">
                <div class="sale_box">
                    <div class="sale_box_left fl">
                        <div class="m">
                            <img src="/Public/home/wap/images/m_info.png" alt="">
                        </div>
                        <?php echo ($arr["pay_nums"]); ?>
                    </div>
                    <div class="sale_box_content fl">
                        <p class="name username"><?php echo ($userData["username"]); ?></p>
                        <p class="num"><?php echo ($userData["userid"]); ?></p>
                        <div class="div_box">
                            <?php if($arr["pay_type"] == 1): ?><img src="/Public/home/wap/images/trading_center/yinghangke.png" alt="">
                                <?php elseif($arr["pay_type"] == 2): ?>
                                <img src="/Public/home/wap/images/trading_center/zhifubao.png" alt="">
                                <?php elseif($arr["pay_type"] == 3): ?>
                                <img src="/Public/home/wap/images/trading_center/weixin.png" alt="">
                                <?php elseif($arr["pay_type"] == 4): ?>
                                <img src="/Public/home/wap/images/trading_center/IMtoken.png" alt=""><?php endif; ?>
                        </div>
                    </div>
                    <div class="sale_box_right fr">
                        <a><?php echo L('confirm');?></a>
                    </div>
                </div>
            </div>


        </li>
    </ul>
</div>

<!--确认打款信息  -->
<div class="remit none ">
    <!-- 遮罩层 -->
    <div class="marker"></div>
    <div class="remit_box">
        <div class="remit_info">
            <?php echo (L("zzpz")); ?>
        </div>
        <!-- <div class="remit_content"> -->
            <!--<?php if($arr["pay_type"] == 1): ?>-->
            <!--<?php elseif($arr["pay_type"] == 2): ?>-->
            <!--<?php elseif($arr["pay_type"] == 3): ?>-->
            <!--<?php elseif($arr["pay_type"] == 4): ?>-->
            <!--<?php endif; ?>-->
            <!-- <p class="name"><?php echo (L("dkrxm")); ?>：<span><?php echo ($payInData["username"]); ?></span></p> -->
            <!-- <p class="phone"><?php echo (L("dkrsjh")); ?>：<span><?php echo ($payInData["mobile"]); ?></span></p> -->
            <!-- <p class="money"><?php echo (L("jyje")); ?>：<span><?php echo ($arr["pay_nums"]); ?></span></p> -->
        <!-- </div> -->
        <div class="remit_bottom">
            <div class="remit_bottom_box">
                <!--<input type="file">-->
                <img class="show_pic" style="height: 100%; width: 100%" src="<?php echo ($arr["trans_img"]); ?>" alt="">
                <!-- <img class="show_pic" style="height: 100%; width: 100%" src="/Public/home/wap/images/trading_center/yinghangke.png" alt=""> -->
            </div>
        </div>

        <p class="txt"><?php echo (L("dkpzzs")); ?></p>
        <div class="remit_footer">
            <a id="confirm" data-id="<?php echo ($arr["id"]); ?>"><?php echo (L("confirm")); ?></a>
        </div>
    </div>
    <div class="show_pic_marsker" style="display: none">
        <div class="big_img">
            <img src="<?php echo ($arr["trans_img"]); ?>" alt="">
            <!-- <img src="/Public/home/wap/images/trading_center/yinghangke.png" alt=""> -->
        </div>
    </div>
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
    $('#confirm').click(function(){

        var orderId = $(this).attr('data-id');
        console.log(orderId);
        $.ajax({
            url:'/trading/Con_Getmoney',
            type:'post',
            data:{orderId:orderId},
            success:function(msg){
                if(msg.status==0){
                    console.log(msg.message);
                    msg_alert("<?php echo (L("czsb")); ?>");
                    /*setTimeout('window.location.href="/Index/myOrderSale"',1500)*/

                }else{
                    msg_alert("<?php echo (L("cg")); ?>")
                    setTimeout('window.location.href="/user/historyOrder.html?type=acc"',1500)
                }
            }
        })
    })


    // mui.init();
    // (function($) {
    //
    //     $('#OA_task_1').on('tap', '.mui-btn', function(event) {
    //         var elem = this;
    //         var li = elem.parentNode.parentNode;
    //         mui.confirm('<div class="text"><p class="icon-information"></p><h3>确定删除此条消息？</h3><span>REMIND</span></div>', 'Hello MUI', btnArray, function(e) {
    //             if (e.index == 0) {
    //                 li.parentNode.removeChild(li);
    //             } else {
    //                 setTimeout(function() {
    //                     $.swipeoutClose(li);
    //                 }, 0);
    //             }
    //         });
    //     });
    //
    //     var btnArray = ['确认', '取消'];
    // })(mui);

    $('#OA_task_1').on('click','.sale_box_right a',function(){

    })

    $('.sale_box_right').click(function(e){
// alert(2343)
        $('.remit').show();
    });

    // 遮罩层点击关闭打款信息
    $('.marker').on('click',function(){
        $(".remit").hide();
    })

    //
    $('.remit_bottom_box').on('click',function(){
        $('.show_pic_marsker').show();
    })

    $('.show_pic_marsker').on('click',function(){
        $(this).hide();
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