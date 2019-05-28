<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <!-- 公共样式 -->
    <link rel="stylesheet" href="/Public/home/wap/css/style.css">
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderSale.css">
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderbase.css">
    <!-- <link rel="stylesheet" href="/Public/home/wap/css/trading_center.css"> -->
    <link rel="stylesheet" href="/Public/home/wap/css/confirm_pay.css">
    <link rel="stylesheet" href="https://cdn.bootcss.com/mui/3.7.1/css/mui.min.css">

    <script src="/Public/home/wap/js/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.bootcss.com/mui/3.7.1/js/mui.min.js"></script>
    <!-- 实现rem的适屏变化 -->
    <script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>
    <!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>

</head>

<style>
    .goodsList_box .sale_box .saleBtn{
        background-color:#E72C18;
        letter-spacing: 0.0417rem;
    }


        .mui-table-view {
            background-color: rgba(0, 0, 0, 0);
            border: 0;
        }
        .mui-table-view-cell.goods {
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
            border-radius: 5px;
        }
</style>

<body>
    <!-- 头部 start -->
    <div class="hear Order_hear">
        <a href="<?php echo U('Index/myOrderSale');?>" class="jiantou"><img src="/Public/home/wap/images/jiantou2416.png" alt=""></a>
        <?php echo ($title); ?>
        <a href="" class="history"><img src="/Public/home/wap/images/history_info.png" alt=""></a>
    </div>
    <!-- 头部 end -->


    <!-- 商品列表 start -->
    <div class="goodsList_box mui-content">
        <ul id="OA_task_1" class="mui-table-view">
                <li  class="mui-table-view-cell goods">
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
                                <p class="name" style="text-align: left"> <?php echo ($userData['username']); ?></p>
                                <p class="num" style="text-align: left"><?php echo ($userData["userid"]); ?></p>
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
                                <a><?php echo ($title); ?></a>
                            </div>
                        </div>
                    </div>
                    
                </li>
            </ul>
    </div>
    <!-- 商品列表 end -->

    <!-- 付款方式界面 -->
    <div class="confirm_pay" style="display: none;">
        <!-- 遮罩层 -->
        <div class="mask"></div>

        <!-- 付款方式 -->
        <div class="pay_way">
            <!-- 头部文字 -->
            <div class="pay_way_title"><?php echo (L("xzfkfs")); ?></div>
            <ul class="mui-table-view">
                <?php if($arr["pay_type"] == 1): ?><li class="mui-table-view-cell abc mui-collapse mui-active">
                    <a class="mui-navigate-right"  href="#"><img src="/Public/home/wap/images/trading_center/yinghangke.png" alt="">
                        <?php echo (L("yhkzf")); ?></a>
                    <div class="mui-collapse-content">
                        <div class="content_box payeeBtn">
                            <p class="title"><?php echo (L("skr")); ?></p>
                            <p class="info"><?php echo ($isDefault["hold_name"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn">
                            <p class="title"><?php echo (L("skyh")); ?></p>
                            <p class="info"><?php echo ($isDefault["open_card"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn">
                            <p class="title"><?php echo (L("cardnum")); ?></p>
                            <p class="info"><?php echo ($isDefault["card_number"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn">
                            <p class="title"><?php echo (L("openbranch")); ?></p>
                            <p class="info"><?php echo ($isDefault["open_card"]); ?><a href="#"><i></i></a></p>
                        </div>
                    <!--    <div class="content_box">
                            <p class="title">手机号码</p>
                            <p class="info"><?php echo ($isDefault["open_card"]); ?><a href="#"><i></i></a></p>
                        </div>-->
                    </div>
                </li>

                    <?php elseif($arr["pay_type"] == 2): ?>
                <li class="mui-table-view-cell mui-collapse mui-active">
                    <a class="mui-navigate-right"  href="#"><img src="/Public/home/wap/images/trading_center/zhifubao.png" alt="">
                        <?php echo (L("zfbzf")); ?></a>
                    <div class="mui-collapse-content ">
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("skr")); ?></p>
                            <p class="info"><?php echo ($isDefault["alipay_name"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box  payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("zfbzh")); ?></p>
                            <p class="info"><?php echo ($isDefault["alipay_num"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("sjhm")); ?></p>
                            <p class="info"><?php echo ($isDefault["alipay_phone"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box er_codeBtn">
                            <p class="title"><?php echo (L("qrdk")); ?></p>
                            <p class="info"><a href="#"><img class="re_code" src="<?php echo ($isDefault["alipay_imgs"]); ?>"></a></p>
                        </div>
                    </div>
                </li>
                    <?php elseif($arr["pay_type"] == 3): ?>
                <li class="mui-table-view-cell mui-collapse mui-active">
                    <a class="mui-navigate-right"   href="#"><img src="/Public/home/wap/images/trading_center/weixin.png" alt=""> <?php echo (L("wx")); echo (L("zf")); ?></a>
                    <div class="mui-collapse-content ">
                        <div class="content_box payeeBtn payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("skr")); ?></p>
                            <p class="info"><?php echo ($isDefault["weichar_name"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("wxh")); ?></p>
                            <p class="info"><?php echo ($isDefault["weichar_num"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("mobile")); ?></p>
                            <p class="info"><?php echo ($isDefault['weichar_phone']); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box er_codeBtn" >
                            <p class="title"><?php echo (L("skewm")); ?></p>
                            <p class="info">
                                <a href="#">
                                    <img class="re_code" src="<?php echo ($isDefault['weichar_imgs']); ?>" alt="">
                                </a>
                            </p>
                        </div>
                    </div>
                </li>
                    <?php elseif($arr["pay_type"] == 4): ?>
                <li class="mui-table-view-cell mui-collapse mui-active">
                    <a class="mui-navigate-right"  href="#"><img src="/Public/home/wap/images/trading_center/IMtoken.png" alt="">
                        Imtoken<?php echo (L("zf")); ?></a>
                    <div class="mui-collapse-content">
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("skr")); ?></p>
                            <p class="info"><?php echo ($isDefault["imtoken_name"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("qianbao")); ?></p>
                            <p class="info"><?php echo ($isDefault["imtoken_num"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box payeeBtn" style="margin-bottom: 13px;">
                            <p class="title"><?php echo (L("mobile")); ?></p>
                            <p class="info"><?php echo ($isDefault["imtoken_phone"]); ?><a href="#"><i></i></a></p>
                        </div>
                        <div class="content_box er_codeBtn" >
                            <p class="title"><?php echo (L("skewm")); ?></p>
                            <p class="info">
                                <a href="#">
                                    <img class="re_code" src="<?php echo ($isDefault["imtoken_imgs"]); ?>">
                                </a>
                            </p>
                        </div>
                    </div>
                </li><?php endif; ?>
            </ul>

            <!-- 上传图片 -->
            <form class="uploading_pic" enctype="multipart/form-data" method="post" id='formBox' name="form">
                <div class="info_box">
                    <input type="file" id="chooseImage" onchange="fileimg(this)" class="fileimgs">
                    <!-- 保存用户自定义的背景图片 -->
                    <img src="/Public/home/wap/images/trading_center/updatepIc.png" id="cropedBigImg"  class="imgs" alt="">
                    <p id="text"><?php echo (L("scdkjt")); ?></p>
                </div>

            </form>
        </div>

        <!-- 确认打款 -->
        <div class="footer_box">
            <div class="num_box">¥<i> <?php echo ($arr['pay_nums']); ?></i>RMB</div>
            <a id="payBtn">
                <div class="btn" data-orders="<?php echo ($arr["id"]); ?>"><?php echo ($title); ?></div>
            </a>
        </div>

        <!-- 二维码扫码 -->
        <div class="big_er_code" style="display: none;">
            <div class="big_pic">
                <?php if($arr["pay_type"] == 1): elseif($arr["pay_type"] == 2): ?>
                    <img src="<?php echo ($isDefault["alipay_imgs"]); ?>" alt="">
                    <?php elseif($arr["pay_type"] == 3): ?>
                    <img src="<?php echo ($isDefault['weichar_imgs']); ?>" alt="">
                    <?php elseif($arr["pay_type"] == 4): ?>
                    <img src="<?php echo ($isDefault["imtoken_imgs"]); ?>" alt=""><?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>
<script type="text/javascript">
    //上传图片方法
    function fileimg(obj){
            var fileType=obj.value.substr(obj.value.lastIndexOf(".")).toLowerCase();//获得文件后缀名
            if(fileType != '.gif' && fileType != '.png' && fileType != '.jpg' && fileType != '.jpeg'){
                $(obj).tips({
                    side:3,
                    msg:"<?php echo (L("qsctpgsdwj")); ?>",
                    bg:'#AE81FF',
                    time:3
                });
                $(obj).val('');
            }else{
                var reader = new FileReader();
                reader.readAsDataURL(obj.files[0]);
                reader.onload = function (e) {
                    $(".imgs").attr("src",this.result);
                }
                $("#tu").show();
            }
        }
        $('.saleBtn').on('click',function(){
            $('.confirm_pay').show()
        })
        $('.mask').on('click', function () {
            $('.confirm_pay').hide()
        })
        $('.er_codeBtn').on("click", function () {
            $('.big_er_code').show()
        })
    //确认订单 发送ajax
    $('.btn').click(function () {
        var orderid = $(this).data('orders');
        var fp = $(".fileimgs")[0].files[0];
        var formData = new FormData();
        formData.append('classIcon',fp);
        formData.append('orderid',orderid);
        $.ajax({
            type: "POST",
            url: "/index/updateOrder",
            data:formData,
            processData : false,
            contentType : false,
            async:false,
            success:function(data){
                if(data.status==1){
                    alert(data.message);
                    window.location.href="/Index/myOrderSale"
                }else{
                    alert(data.message);
                }
            },
            error:function(result){
                //请求失败之后的操作
            }
        });
    })
       //确认订单 发送ajax
       //  $('.btn').click(function () {
       //      var orderid = $(this).data('order');
       //      var fp = $(".fileimgs")[0].files[0];
       //      var formData = new FormData();
       //      formData.append('classIcon',fp);
       //      formData.append('orderid',orderid);
       //      $.ajax({
       //          type: "POST",
       //          url: "/Index/updateOrder",
       //          data:formData,
       //          processData : false,
       //          contentType : false,
       //          async:false,
       //          success:function(data){
       //              if(data.status==1){
       //                  alert(data.message);
       //                  window.location.href="Index/myOrderSale"
       //              }else{
       //                  alert(data.message);
       //              }
       //          },
       //          error:function(result){
       //              //请求失败之后的操作
       //          }
       //      });
       //  })

        $('.big_er_code').on('click',function(){
            $(this).hide();
        })

        mui.init();
        (function($) {

            $('#OA_task_1').on('tap', '.mui-btn', function(event) {
                var elem = this;
                var li = elem.parentNode.parentNode;
                mui.confirm("<div class='text'><p class='icon-information'></p><h3><?php echo (L("qdscctxx")); ?>？</h3><span>REMIND</span></div>", 'Hello MUI', btnArray, function(e) {
                    if (e.index == 0) {
                        li.parentNode.removeChild(li);
                    } else {
                        setTimeout(function() {
                            $.swipeoutClose(li);
                        }, 0);
                    }
                });


            });


            var btnArray = ["<?php echo (L("qr")); ?>", "<?php echo (L("qx")); ?>"];
        })(mui);

        $('#OA_task_1').on('click','.sale_box_right a',function(){
            $('.confirm_pay').show()

        })

        $('.payeeBtn a').on('click',function(){
            BSL.copyText($(this).parents('.info').text())
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