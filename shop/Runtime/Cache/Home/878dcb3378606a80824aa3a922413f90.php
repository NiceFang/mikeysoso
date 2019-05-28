<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ($title); ?></title>
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderSale.css">
    <link rel="stylesheet" href="/Public/home/wap/css/myOrderbase.css">
    <link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
    <!--<link rel="stylesheet" href="/Public/home/wap/css/style.css">-->
    <link rel="stylesheet" href="/Public/home/wap/css/meCen-K.css">
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
    <script src="/Public/home/wap/js/rem.js"></script>
    <script src="/Public/home/wap/js/mui.min.js"></script>
    <!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>
    <script>
    </script>

    <style>
        .zhifu_price {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 0.0833rem;
        }
    </style>
</head>

<body>
<!-- 头部 -->
<div class="buy_hear">
    <div class="buy_hear_top">
        <a href="<?php echo U('index/trading_center');?>" class="fanhui">
            <img src="/Public/home/wap/images/jiantou2416.png" alt="">
        </a>
        <?php echo ($title); ?>
    </div>
    <div class="buy_hear_buttom">
        <div class="buy_hear_buttom_left">
            <p class="balance_txt"><?php echo (L("yue")); ?></p>
            <div class="balance_box">
                <div class="balance_box_img fl">
                    <img src="/Public/home/wap/images/balance3030.png" alt="">
                </div>
                <p class="balance_num fl"><?php echo ($my["cangku_num"]); ?></p>
            </div>
        </div>
        <div class="buy_hear_buttom_left">
            <p class="balance_txt"><?php echo (L("jifen")); ?></p>
            <div class="balance_box">
                <div class="balance_box_img fl">
                    <img src="/Public/home/wap/images/balance3030.png" alt="">
                </div>
                <p class="balance_num fl"><?php echo ($my["fengmi_num"]); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- 买入金额 -->
<div class="buy_money">
    <div class="buy_money_top"><?php echo (L("qxzmrje")); ?></div>
    <div class="buy_money_box">
        <div class="select_money" data-val="500">500</div>
        <div data-val="1000">1000</div>
        <div data-val="3000">3000</div>
        <div data-val="5000">5000</div>
        <div data-val="10000">10000</div>
        <div data-val="30000">30000</div>
    </div>
</div>
<!-- 收款方式 -->
<div class="gathering">
    <div class="gathering_top"><?php echo (L("qxzsfkfs")); ?></div>
    <div class="gathering_box">
        <ul>
            <li>
                <div class="div_img fl">
                    <img src="/Public/home/wap/images/yinghangka.png" alt="">
                </div>
                <?php echo (L("yhk")); ?>
                <div class="div_bg fr select" data-tx="1">

                </div>
            </li>
            <li>
                <div class="div_img fl">
                    <img src="/Public/home/wap/images/zhifubao.png" alt="">
                </div>
                <?php echo (L("zfb")); ?>
                <div class="div_bg fr"  data-tx="2">

                </div>
            </li>
            <li>
                <div class="div_img fl">
                    <img src="/Public/home/wap/images/weixin.png" alt="">
                </div>
                <?php echo (L("wx")); ?>
                <div class="div_bg fr"  data-tx="3">

                </div>
            </li>
            <li>
                <div class="div_img fl">
                    <img src="/Public/home/wap/images/imtoken.png?v=15544" alt="">
                </div>
                ImToken
                <div class="div_bg fr "  data-tx="4">

                </div>
            </li>
        </ul>
    </div>
</div>
<!-- 底部 -->
<div class="buy_footer">
    <a class="createBtn"><?php echo (L("createorder")); ?></a>
</div>

<!--浮动层-->
<div class="ftc_wzsf" >
    <div class="srzfmm_box">
        <div class="qsrzfmm_bt clear_wl">
            <img src="/Public/home/wap/images/xx_03.jpg" class="tx close fl">
            <span class="fl"><?php echo (L("input_pwd")); ?></span></div>
        <div class="zfmmxx_shop">
            <div class="mz"><?php echo (L("sjhd")); ?></div>
            <div class="zhifu_price"><img src="/Public/home/wap/images/integraimages/Mhei.png" alt=""><div></div></div></div>
        <ul class="mm_box">
            <li></li><li></li><li></li><li></li><li></li><li></li>
        </ul>
    </div>
    <div class="numb_box">
        <div class="xiaq_tb">
            <img src="/Public/home/wap/images/jftc_14.jpg" height="10"></div>
        <ul class="nub_ggg">
            <li><a href="javascript:void(0);" class="zf_num">1</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">2</a></li>
            <li><a href="javascript:void(0);" class="zf_num">3</a></li>
            <li><a href="javascript:void(0);" class="zf_num">4</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">5</a></li>
            <li><a href="javascript:void(0);" class="zf_num">6</a></li>
            <li><a href="javascript:void(0);" class="zf_num">7</a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">8</a></li>
            <li><a href="javascript:void(0);" class="zf_num">9</a></li>
            <li><a href="javascript:void(0);" class="zf_empty"><?php echo (L("emptya")); ?></a></li>
            <li><a href="javascript:void(0);" class="zj_x zf_num">0</a></li>
            <li><a href="javascript:void(0);" class="zf_del"><?php echo (L("deleteo")); ?></a></li>
        </ul>
    </div>
    <div class="hbbj"></div>
</div>

<!--请选择买入金额-->
<input type="hidden" value="<?php echo (L("qxzmrje1")); ?>" id="qxzmrje">
<!--请添加银行卡-->
<input type="hidden" value="<?php echo (L("addcard")); ?>" id="addcard">
<!--请选择银行卡-->
<input type="hidden" value="<?php echo (L("qxzyhk")); ?>" id="qxzyhk">
</body>

</html>

<script>
    $('.buy_money_box>div').click(function () {
        $(this).addClass('select_money').siblings().removeClass('select_money')
    })

    $('.gathering_box li').on('click',function () {
        $(this).children('.div_bg').addClass('select').parents('li').siblings().children('.div_bg').removeClass('select')

    })
</script>

<!--输入密码-->

<script type="text/javascript">
    // var dhjebnxy = $('#dhjebnxy').val();
    // var dhjebz  = $('#dhjebz').val();
    // var dhjebsbs = $('#dhjebsbs').val();
    function msg_alert(message,url){

        if(url){
            layer.msg(message,{time:3000},function(){
                window.location.href=url;
            });
        }else{
            layer.msg(message,{time:3000});
        }

    }
    var qxzmrje = $('#qxzmrje').val();
    var addcard = $('#addcard').val();
    var qxzyhk = $("#qxzyhk").val();
    $('.createBtn').on('click', function(){

        var maxe=$('#money').text();//余额
        var maxe=Number(maxe);//余额
        var dhnums =$('.select_money').data('val'); //要兑换的数量
        var dhnums =Number(dhnums); //要兑换的数量

        // if(dhnums<100){
        //     msg_alert(dhjebnxy);
        //     return;
        // }
        // if(maxe<dhnums){
        //     msg_alert(dhjebz);
        //     return;
        // }else{
        //     var yuee = dhnums % 100;
        //     if(yuee!=0){
        //         msg_alert(dhjebsbs);
        //         return;
        //     }
        // }
        var getjifens = dhnums;
        $('.zhifu_price div').text(getjifens+'.00');
        $(".ftc_wzsf").show();

        $('html,body').css('height','100%');
        // $('body').css('margin-top','1rem');

        $('.w-header').css('position','fixed');
        $('.header .w-header').css('top','0');
        $('.header .w-header').css('left','0');
    });
    // $(function(){
    //     //关闭浮动
    //     $(".close").click(function(){
    //         $(".ftc_wzsf").hide();
    //         $(".mm_box li").removeClass("mmdd");
    //         $(".mm_box li").attr("data","");
    //         i = 0;
    //         $('.w-header').css('position','static');
    //         $('.header .w-header').css('top','0');
    //         $('.header .w-header').css('left','0');
    //
    //         $('html,body').css('height','');
    //         $('body').css('margin-top','0');
    //
    //     });
    //     //数字显示隐藏
    //     $(".xiaq_tb").click(function(){
    //         $(".numb_box").slideUp(500);
    //     });
    //     $(".mm_box").click(function(){
    //         $(".numb_box").slideDown(500);
    //     });
    //     //----
    //     var i = 0;
    //     $(".nub_ggg li .zf_num").click(function(){
    //         var type = $('.select').data('tx');
    //         var money = $('.select_money').data('val');
    //         if(i<6){
    //             $(".mm_box li").eq(i).addClass("mmdd");
    //             $(".mm_box li").eq(i).attr("data",$(this).text());
    //             i++
    //             if (i==6) {
    //                 // setTimeout(
    //                 //     function(){
    //                     var pwd = "";
    //                     $(".mm_box li").each(function(){
    //                         pwd += $(this).attr("data");
    //                     });
    //
    //
    //                     //ajax提交密码以及参数
    //                     var dhnums =$('.select_money').data('val'); //要兑换的数量
    //                     $.ajax({
    //                         url:'/Index/SellCentr',
    //                         type:'post',
    //                         data:{'paySelect:type,sellnums:dhnums,pwd':pwd},
    //                         datatype:'json',
    //                         success:function (mes) {
                                // if(mes.status == 1){
                                //     $(".ftc_wzsf").hide();
                                //     $(".mm_box li").removeClass("mmdd");
                                //     $(".mm_box li").attr("data","");
                                //     i = 0;
                                //
                                //     $.ajax({
                                //         url:"<?php echo U('index/sale');?>",
                                //         type:'post',
                                //         data:{paySelect:type,sellnums:money},
                                //         success:function (mes) {
                                //             console.log(mes)
                                //             if(mes.status==0){
                                //                 alert(mes.message);
                                //             }else{
                                //                 // alert('成功');
                                //                 window.location.href='/index/trading_center';
                                //             }
                                //
                                //         }
                                //
                                //     })
                                //
                                //
                                //
                                // }else{
                                //     // msg_alert(mes.message);
                                //     $(".mm_box li").removeClass("mmdd");
                                //     $(".mm_box li").attr("data","");
                                //     i = 0;
                                // }
        //                         if(mes.status==0){
        //                             alert(mes.message);
        //                         }else{
        //                             // alert('成功');
        //                             window.location.href='/index/trading_center';
        //                         }
        //                     }
        //                 })
        //             };
        //             // ,100);
        //         };
        //     // }
        // });
    $(function () {
        //关闭浮动
        $(".close").click(function () {
            $(".ftc_wzsf").hide();
            $(".mm_box li").removeClass("mmdd");
            $(".mm_box li").attr("data", "");
            i = 0;
        });
        //数字显示隐藏
        $(".xiaq_tb").click(function () {
            $(".numb_box").slideUp(0);
        });
        $(".mm_box").click(function () {
            $(".numb_box").slideDown(0);
        });
        //----
        var i = 0;
        $(".nub_ggg li .zf_num").click(function () {
            if (i < 6) {
                $(".mm_box li").eq(i).addClass("mmdd");
                $(".mm_box li").eq(i).attr("data", $(this).text());
                i++
                if (i == 6) {
                    setTimeout(function () {
                        var pwd = "";
                        $(".mm_box li").each(function(){
                            pwd += $(this).attr("data");
                        });
                        //AJAX提交数据
                        var sellnums = $.trim($('.select_money').text()); //账号  //.trim() 去空格判断
                        var cardid = $('.carnumber').val();//银行卡id
                        var type = $('.select').data('tx');
                        var exg = /^[1-9]\d*|0$/;
                        if (!exg.test(sellnums)) {
                            msg_alert(qxzmrje);
                            return;
                        }
                        if (cardid == '') {
                            msg_alert(q);
                            return;
                        }
                        $.ajax({
                            url:'/Index/SellCentr',
                            type:'post',
                            data:{'paySelect':type,'sellnums':sellnums,'pwd':pwd,'cardid':cardid},
                            datatype:'json',
                            success:function (mes) {
                                if(mes.status == 1){
                                   msg_alert(mes.message);
                                    $(".ftc_wzsf").hide();
                                    $(".mm_box li").removeClass("mmdd");
                                    $(".mm_box li").attr("data","");
                                    i = 0;
                                    setTimeout("window.location.href='/Index/myOrderSale.html?type=1'",1000)
                                }else{
                                    msg_alert(mes.message);
                                    $(".mm_box li").removeClass("mmdd");
                                    $(".mm_box li").attr("data","");
                                    i = 0;
                                    //setTimeout("window.location.href='/index/trading_center'",1000)
                                }
                            }
                        })
                    }, 100);
                };
            }
        });
        $(".nub_ggg li .zf_del").click(function(){
            if(i>0){
                i--
                $(".mm_box li").eq(i).removeClass("mmdd");
                $(".mm_box li").eq(i).attr("data","");
            }
        });

        $(".nub_ggg li .zf_empty").click(function(){
            $(".mm_box li").removeClass("mmdd");
            $(".mm_box li").attr("data","");
            i = 0;
        });

    });
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