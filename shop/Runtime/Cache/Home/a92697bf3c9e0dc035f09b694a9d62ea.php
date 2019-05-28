<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>互转详情</title>
    <link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
    <link rel="stylesheet" href="/Public/home/wap/css/mutualParticulars.css">
    <script src="/Public/home/wap/js/rem.js"></script>
    <script src="/Public/home/wap/js/jquery1.11.1.min.js"></script>
    <!-- <script src="js/mui.min.js"></script> -->
    <script>
    </script>
</head>

<body>
    <!-- 头部 -->
    <div class="hear">
        <a href="<?php echo ($url); ?>" class="jiantou"><img src="/Public/home/wap/images/user_jiantouzuo.png" alt=""></a>
        <p><?php echo (L("zcjl")); ?></p>
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

    <div class="content">
        <?php if($record['get_nums'] >= 0): ?><div class="price"><span>+</span><?php echo ($record['get_nums']); ?></div>
            <?php else: ?>
            <div class="price green"><?php echo ($record['get_nums']); ?></div><?php endif; ?>
            <div class="info">
            <ul>
                <li>
                    <span><?php echo (L("rollOut")); echo (L("zhanghu")); ?></span>
                    <?php if($record['get_nums'] >= 0): ?><span><?php echo ($record['deputy_id']); ?></span>
                        <?php else: ?>
                        <span><?php echo ($record['deputy_id']); ?></span><?php endif; ?>
                </li>
                <li>

                    <span><?php echo (L("nickname")); ?></span>
                    <span><?php echo ($record['deputy_name']); ?></span>
                </li>
                <li>
                    <span><?php echo (L("sj")); ?></span>
                    <span><?php echo ($record['get_time']); ?></span>
                </li>
            </ul>
        </div>
    </div>

</body>

</html>


<script type="text/javascript">
    // 更改语言 先不要删掉
    // $(document).ready(function () {
    //     // 点击切换语言
    //     $(".dropdown .son").hide();
    //     $("#div_curr_lag").click(function () {
    //         $(".dropdown .son").toggle();
    //     });

    //     $(".dropdown .son div a").click(function () {
    //         var text = $(this).html();
    //         $(".dropdown .parent a span").html(text);
    //         // localStorage.setItem('key',JSON.stringify(text));
    //         $(".dropdown .son").hide();
    //     }); //选择完成以后隐藏页面

    //     var curr_lag = $("#hid_lag").val();
    //     if (curr_lag == "") {
    //         gradeOnclick("en-us");
    //     } else {
    //         var curr_html_lag = $("#div_" + curr_lag).html();
    //         $("#div_curr_lag").html(curr_html_lag);
    //     }
    // })

    // function gradeOnclick(url) {
    //     window.location.href = "?l=" + url;
    // };
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