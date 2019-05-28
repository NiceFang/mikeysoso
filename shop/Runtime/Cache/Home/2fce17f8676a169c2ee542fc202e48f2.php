<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html lang="zh-CN">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title><?php echo (L("complins")); ?></title>

<!-- 旧的代码 -->
<!-- <link rel="stylesheet" href="/Public/home/wap/css/style.css">-->
<link rel="stylesheet" href="/Public/home/wap/css/meCen.css">

<!-- 新的代码 -->
<link rel="stylesheet" href="/Public/home/wap/css/integralbase.css">
<link rel="stylesheet" href="/Public/home/wap/css/complaint.css">

<script type="text/javascript" src="/Public/home/common/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>
<script type="text/javascript" src="/Public/home/common/js/index.js"></script>
<script src="/Public/home/wap/js/rem.js"></script>
<!-- 获取头部的颜色 -->
<script type="text/javascript" src="/Public/home/wap/js/color.js"></script>


<body>

    <!-- 旧的代码 -->
    <!-- <div class="header">
	    <div class="header_l">
	    <a href="<?php echo U('User/Personal');?>"><img src="/Public/home/wap/images/jiant.png" alt=""></a>
	    </div>
	    <div class="header_c"><h2><?php echo (L("complins")); ?></h2></div>
	    <div class="header_r"></div>
	</div>

     <div class="big_width100">
        <div class="opiniontop_d">
	        <div class="opiniontop">
			    <p><?php echo (L("sryj")); ?></p>
			</div>
			<div class="opinion">
			    <textarea name="introduce" id="introducebb" rows="8" placeholder="<?php echo (L("qsr")); ?>..."></textarea>
			</div>
			    <div class="container">
        <div class="z_photo">
            <div class="z_file">
                <input type="file" name="file" id="file" value="" accept="image/*" multiple onchange="imgChange('z_photo','z_file');" />
            </div>
        </div> -->
    <!-- <div class="z_mask">
            <div class="z_alert">
                <p><?php echo (L("nqrysczztm")); ?></p>
                <p>
                    <span class="z_cancel"><?php echo (L("qux")); ?></span>
                    <span class="z_sure"><?php echo (L("termine")); ?></span>
                </p>
            </div>
        </div>
    </div>
		</div>
		 <div class="buttonGeoup">
	       	<a href="javascript:void(0);"  class="not_next" id="cuanjdd"><?php echo (L("tijiao")); ?></a>
        </div>
    </div> -->


    <!-- 新的代码 -->

    <input type="hidden" name="TOKEN" value="<?php echo ($TOKEN); ?>">
    <!-- 头部 -->
    <div class="hear">
        <a href="<?php echo U('User/Personal');?>" class="jiantou"><img src="/Public/home/wap/images/integraimages/jiantouzuo.png" alt=""></a>
        <p><?php echo (L("complins")); ?></p>
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

    <!-- 反馈建议 -->
    <div class="suggest_box">
        <textarea name="introduce" id="introducebb" rows="8" placeholder="<?php echo (L("qzxfsrndbgyj")); ?>"></textarea>
    </div>
    <!-- 上传照片 -->
 <!--   <div class="z_photo">
        <div class="z_file">
            <img src="/Public/home/wap/images/camera.png" alt="">
            <p>上传照片</p>
            <input type="file" name="file" id="file" value="" accept="image/*" multiple onchange="imgChange('z_photo','z_file');" />
        </div>
    </div>-->

    <div class="z_mask">
        <div class="z_alert">
            <p><?php echo (L("nqrysczztm")); ?></p>
            <p>
                <span class="z_cancel"><?php echo (L("qux")); ?></span>
                <span class="z_sure"><?php echo (L("termine")); ?></span>
            </p>
        </div>
    </div>

    <!-- 手机号码 -->
    <div class="mobile_box">
        <p class="txt" ></p>
        <input type="text" name="mobile" id="mobile" placeholder="<?php echo (L("sjhm")); ?>">
    </div>
    <!-- 发生时间 -->
   <!-- <div class="time_box">
        <p class="txt">发生时间</p>
        <input type="text">
    </div>-->

    <!-- 提交按钮 -->
    <div class="buttonGeoup">
        <a class="not_next" id="cuanjdd"><?php echo (L("termine")); ?></a>
    </div>


    <input type="hidden" id="qtxnr" value="<?php echo (L("qtxnr")); ?>">
    <script type="text/javascript">
         $('#introducebb').blur(function(){
            if ($('#introducebb').val().trim() != '') {
                $('#cuanjdd').addClass('active')
                
            }else {
                $('#cuanjdd').removeClass('active')
            }
        })


        function imgChange(obj1, obj2) {
            //获取点击的文本框
            var file = document.getElementById("file");
            //存放图片的父级元素
            var imgContainer = document.getElementsByClassName(obj1)[0];
            //获取的图片文件
            var fileList = file.files;
            //文本框的父级元素
            var input = document.getElementsByClassName(obj2)[0];
            var imgArr = [];
            //遍历获取到得图片文件
            for (var i = 0; i < fileList.length; i++) {
                var imgUrl = window.URL.createObjectURL(file.files[i]);
                imgArr.push(imgUrl);
                var img = document.createElement("img");
                img.setAttribute("src", imgArr[i]);
                var imgAdd = document.createElement("div");
                imgAdd.setAttribute("class", "z_addImg");
                imgAdd.appendChild(img);
                imgContainer.appendChild(imgAdd);
            };
            imgRemove();
        };

        function imgRemove() {
            var imgList = document.getElementsByClassName("z_addImg");
            var mask = document.getElementsByClassName("z_mask")[0];
            var cancel = document.getElementsByClassName("z_cancel")[0];
            var sure = document.getElementsByClassName("z_sure")[0];
            for (var j = 0; j < imgList.length; j++) {
                imgList[j].index = j;
                imgList[j].onclick = function () {
                    var t = this;
                    mask.style.display = "block";
                    cancel.onclick = function () {
                        mask.style.display = "none";
                    };
                    sure.onclick = function () {
                        mask.style.display = "none";
                        t.style.display = "none";
                    };

                }
            };
        };
    </script>

    <style>
        .z_alert {
            color: #333;
        }

        .z_alert span {
            color: #0da8f5;
        }
    </style>


    <script>
        $('#cuanjdd').click(function () {
            var token = $("[name='TOKEN']").val();
            console.log(token);
            var qtxnr = $('#qtxnr').val();
            var content = $('#introducebb').val();
            if (content == '') {
                msg_alert(qtxnr);
                return false;

            }else if($('#introducebb').val().length>300){
                msg_alert("投诉建议不能超过300字");
                return false;
            }
            var imglist = [];
            $(".z_photo>.z_addImg>img").each(function () {
                srcurl = $(this).attr('src');
                imglist.push($(this).attr('src'));
            });
            $.ajax({
                url: '/User/Complaint',
                type: 'post',
                data: {
                    'content': content,
                    'token':token,
                    'imgs': imglist
                },
                datatype: 'json',
                success: function (mes) {
                    if (mes.status == 1) {
                        msg_alert(mes.message, mes.url);
                    } else {
                        msg_alert(mes.message);
                    }
                }
            })
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