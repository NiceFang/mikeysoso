<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<!--<script src="../../../../jubaozuang/jubao/Themes/Home/nc/Public/js/JdClick.js"></script>-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("addbankcard")); ?></title>

<!-- 旧的样式 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css"> -->

<!-- 新的样式 -->
<link rel="stylesheet" href="/Public/home/wap/css/base.css">
<link rel="stylesheet" href="/Public/home/wap/css/mui.min.css">
<link rel="stylesheet" href="/Public/home/wap/css/accountManage.css">
<script type="text/javascript" src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/rem.js"></script>
<script type="text/javascript" src="/Public/home/wap/js/mui.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>

<body>

    <!-- 旧的代码 -->
    <!-- <div class="header">
        <div class="header_l">
            <a href="javascript:history.go(-1)"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
        </div>
        <div class="header_c">
            <h2><?php echo (L("addbankcard")); ?></h2>
        </div>
        <div class="header_r"></div>
    </div> -->

    <!-- <div class="big_width100">
        <div class="tips">*<?php echo (L("addcard2")); ?></div>
        <div class="add_bank_add_gr">
            <div class="fill_sty add_gr_b10">
                <p><?php echo (L("cardholdername")); ?></p>
                <input type="text" name="other_account" placeholder="<?php echo (L("cardholdername")); ?>" autocomplete="off"
                    id="crkxm">
            </div>
            <div class="fill_sty add_gr_b10">
                <p><?php echo (L("bankname")); ?></p>
                <div class="demo">
                    <select class="select" isval="true" msg="<?php echo (L("addcard3")); ?>" id="khy">
                        <option value="0" selected><?php echo (L("addcard3")); ?></option>
                        <?php if(is_array($bakinfo)): foreach($bakinfo as $key=>$v): ?><option value="<?php echo ($v['pid']); ?>"><?php echo ($v['banq_genre']); ?></option><?php endforeach; endif; ?>
                    </select>
                </div>
            </div> -->
    <!--开户名-->
    <!-- <div class="fill_sty add_gr_b10">
                <p><?php echo (L("cardnum")); ?></p>
                <input type="text" name="other_account" placeholder="<?php echo (L("addcard4")); ?>" autocomplete="off" id="yhk">
            </div>
            <div class="fill_sty add_gr_b10 mababno">

                <p><?php echo (L("openbranch")); ?></p>
                <input type="text" name="other_account" placeholder="<?php echo (L("addcard5")); ?>" autocomplete="off" id="khzy">
            </div>
        </div> -->

    <!-- <label class="label_check" name="xxx" for="checkbox-01">
            <input name="sample-checkbox-01" id="checkbox-01" value="1" type="checkbox" checked=""><?php echo (L("setasdefaul")); ?>
        </label>

        <div class="buttonGeoup">
            <a href="#" class="not_next" id="confirm"><?php echo (L("termine")); ?></a>
        </div> -->
    <!-- </div> -->




    <!-- 新的代码 -->
    <!-- 头部 -->
    <div class="hear">
        <a href="<?php echo U('Growth/Cardinfos');?>"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
        <?php echo (L("addbankcard")); ?>
    </div>

    <!-- 用户信息 -->
    <div class="user_info">
        <form class="mui-input-group">
            <div class="mui-input-row user_info_lis">
                <label class="name bank_name" ><?php echo (L("cardholdername")); ?></label>

                <input type="text" class="mui-input-clear bank_input" id="crkxm" placeholder="<?php echo (L("cardholdername")); ?>" autocomplete="off">
            </div>
            <div class="mui-input-row user_info_lis select_bank">
                <label class="name bank_select" ><?php echo (L("addcard3")); ?></label>
                <input type="text" class="mui-input-clear bank_select_input"  id="khy" readonly="readonly">
                <img class="jiantou" src="/Public/home/wap/images/jiantouyou.png" alt="">
            </div>
            <!--银行卡号-->
            <div class="mui-input-row user_info_lis">
                <label class="name bank_num"> <?php echo (L("cardnum")); ?></label>
                <input type="number" id="yhk" class="mui-input-clear bank_num_input" placeholder="<?php echo (L("addcard4")); ?>" >
            </div>
            <div class="mui-input-row user_info_lis">
                <label class="name bank_num"  ><?php echo (L("openbranch")); ?></label>
                <input type="text" id="khzy" class="mui-input-clear bank_num_input" placeholder="<?php echo (L("addcard5")); ?>" >
            </div>
         <!--   <div class="mui-input-row user_info_lis">
                <label class="name">手机</label>
                <input type="text" class="mui-input-clear" placeholder="">
            </div>-->
        </form>
    </div>

    <!-- 设为默认 -->
    <div class="default">
        <div class="select_bg fl" name="xxx"></div>

        <p name="sample-checkbox-01"  id="checkbox-01" value="1" type="checkbox" checked=""> <?php echo (L("setasdefaul")); ?></p>
    </div>

    <!-- 保存按钮 -->
    <div class="save" id="confirm"><?php echo (L("termine")); ?></div>

    <!-- 银行卡选择 -->
    <div class="mui-inner-wrap box none">
        <!-- 主页面标题 -->
        <div id="offCanvasContentScroll" class="mui-content mui-scroll-wrapper">
            <div class="mui-scroll scroll_box">
                <!-- 主界面具体展示内容 -->
                <?php if(is_array($bakinfo)): foreach($bakinfo as $key=>$v): ?><li class="mui-table-view-cell bank_list">
                        <a href="#"  value="<?php echo ($v['pid']); ?>"><?php echo ($v['banq_genre']); ?></a>
                    </li><?php endforeach; endif; ?>
            </div>
        </div>
    </div>



    <!--请填写持卡人姓名-->
    <input type="hidden" id="qtxckrxm" value="<?php echo (L("qtxckrxm")); ?>">
    <!--请选择开户人行-->
    <input type="hidden" id="addcard3" value="<?php echo (L("addcard3")); ?>">
    <!--开户银行支行分行输入有误-->
    <input type="hidden" id="khyhzhsryw" value="<?php echo (L("khyhzhsryw")); ?>">
    <!-- 提示不能为空 -->
    <script type="text/javascript">
        //  初始化滚动
        mui('#offCanvasContentScroll').scroll();

        // 点击选为默认
        $(".select_bg").on('click', function () {
            $(this).toggleClass("select_red");
        })

        // 点击选择银行 出现银行卡选择框
        $(".select_bank").click(function () {
            $(".box").show();
          //  $(".save").hide();
            $("#offCanvasContentScroll").show();

        })

        // 获取选择银行
        $("#offCanvasContentScroll").on("tap", "a", function () {
            var txt = $(this).html();
            var val = $(".select_bank input").val(txt);
        //     // var data_id = $(this).attr('data-id');
        //     // var val1 = $("#khy").attr('data-id', data_id);
        //     // $(".select_bank .jiantou").attr("src", "/Public/home/wap/images/select_red.png");
        //     // $(".select_bank .jiantou").css({
        //     //     'width': '0.3333rem',
        //     //     'height': '0.3333rem',
        //     //     'top': '0.3542rem',
        //     //     'right': '0.2083rem'
        //     // });
            $("#offCanvasContentScroll").hide()
            // // 保存按钮延迟出现

            $(".save").delay(100).fadeIn(100);
            $(".box").hide();
        })

        //$('#confirm').click(function () {

        $('#confirm').on('click', function () {
            var qtxckrxm = $('#qtxckrxm').val();
            var addcard3 = $('#addcard3').val();
            var khyhzhsryw = $('#khyhzhsryw').val();
            var crkxm = $.trim($('#crkxm').val()); //姓名

            if ($('[name="xxx"]').is('.select_red')) {
                var c_on = 1;
            } else {
                var c_on = 0;
            }

            if (crkxm == '') {
                msg_alert(qtxckrxm);
                return;
            }
            var khy = $.trim($('#khy').val()); //开户行
            if (khy == 0) {
                msg_alert(addcard3);
                return;
            }
            var yhk = $.trim($('#yhk').val()); //银行卡
            // var pattern = /^([1-9]{1})(\d{14}|\d{18})$/;
            // if(!pattern.test(yhk)){
            //     msg_alert('银行卡号输入不正确');
            //     return;
            // }
            var khzy = $.trim($('#khzy').val()); //开户支行

            if (khzy == '') {
                msg_alert(khyhzhsryw);
                return;
            }

            $.post("<?php echo U('Growth/addBanks');?>", {
                crkxm: crkxm,
                khy: khy,
                yhk: yhk,
                khzy: khzy,
                c_on: c_on
            }, function (mes) {
                if (mes.status == 1) {
                    msg_alert(mes.message, mes.url);
                } else {
                    msg_alert(mes.message);
                }
            }, "json");
        });
    </script>


    <script src="/Public/home/wap/js/ansel_select.js"></script>
    <!--input  type="checkbox"  美化 -->
    <script>
        function setupLabel() {
        if ($('.label_check input').length) {
            $('.label_check').each(function(){
                $(this).removeClass('c_on');
            });
            $('.label_check input:checked').each(function(){
                $(this).parent('label').addClass('c_on');
            });
        };
        if ($('.label_radio input').length) {    /////
            $('.label_radio').each(function(){
                $(this).removeClass('r_on');
            });
            $('.label_radio input:checked').each(function(){
                $(this).parent('label').addClass('r_on');
            });
        };
    };
    $(document).ready(function(){
        $('body').addClass('has-js');
        $('.label_check, .label_radio').click(function(){
            setupLabel();
        });
        setupLabel();
    });

</script>
    <script>
        //插件初始化配置
    $('.select').anselcfg({});
</script>

    <style type="text/css">
        .ansel_search {
            border-bottom: 1px solid #ff0000;
        }

        .ansel_search input:-ms-input-placeholder {
            color: #ff0000
        }

        .ansel_searchinput:-moz-placeholder {
            color: #ff0000
        }

        .ansel_search input::-webkit-input-placeholder {
            color: #ff0000
        }

        .demo {
            margin-bottom: 0px;
        }

        .tips {
            margin: 10px 0;
        }
    </style>

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