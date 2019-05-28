<?php if (!defined('THINK_PATH')) exit();?><ul class="ul mui-table-view mui-table-view-chevron uls" id="ul">

</ul>
<!--弹框JS-->
<!--<script type="text/javascript" src="/Public/home/common/layer/layer.js"></script>-->
<script>
    //公共提示框
    function msg_alert(message,url){

        if(url){
            layer.msg(message,{time:3000},function(){
                window.location.href=url;
            });
        }else{
            layer.msg(message,{time:3000});
        }

    }

    $(function () {
       var test = window.location.pathname;
       //当页面加载完的时候 判断是不是余额和积分记录页面 若是则进行ajax获取所有记录
       if(test=="/Index/Bancerecord.html" || test=="/Index/Exchangerecords.html" || test=="/Index/feedbackInfo.html"){
           $.ajax({
               url: "/Index/ajaxinfo",
               type: 'post',
               data: {
                   'jilu': 'zhuanzhangjilu',
                   'url':test,
                   'page':"<?php echo ($page); ?>",
                   'table':"<?php echo ($table); ?>",
                   'in':"<?php echo ($in); ?>",
                   'where':"<?php echo ($where); ?>"
               },
               success: function (mes) {
                   // console.log(mes);

                   if(mes.message=='"kong"' || mes.message==null || mes.message==undefined || mes.message==''){
                       msg_alert('没有记录了哦');
                       mui('.refreshContainer').pullRefresh().endPullupToRefresh(true);
                       return;
                   }


                   var Obj = JSON.parse(mes.message);
                   var li = "";
                   for (var val in Obj) {
                       //<?php echo (L("yhfkclz")); ?>判断 若是用户反馈页面的话
                       if(test=="/Index/feedbackInfo.html"){
                          // console.log(Obj);
                           li += "<li class='lis' data-id='"+Obj[val].id+"'>";
                           li += "<h2>" + Obj[val].content.substring(0,10) + "</h2>"
                           if(Obj[val].status==2){
                               li += "<h4>"+ Obj[val].reply.substr(0,10)+ "...</h4>"
                               li +="<img src=\"<?php echo (L("yhfkycl")); ?>\" alt=\"\">"
                           }else{
                               li += "<h4>待回复</h4>"
                               li +="<img src=\"<?php echo (L("yhfkclz")); ?>\" alt=\"\">"
                           }
                           li += "<p class='mui-clearfix'>"
                           li += "<span class='fl'>Mikey钱包</span>"
                           li += "<span class='fr'>" + Obj[val].create_time + "</span></p>"
                           li += "</li>"
                       }else{

                           //若不是用户反馈页面 那么就是余额或者积分页面
                           //判断是否是属于转入或者转出记录
                           if(Obj[val].get_type ==3 || Obj[val].get_type == 4){
                               //若是则进行添加点击跳转转账详情页面 若不是则 不添加点击事件
                               li += "<li class='lis' data-tepy='liis'  data-id='"+Obj[val].id+"'>";
                           }else{
                               li += "<li class='lis' data-id='"+Obj[val].id+"'>";
                           }
                           li += "<p>" + Obj[val].type_name + "</p>";
                           if(Obj[val].get_nums>0){
                               li += "<p class='red'>+"+Obj[val].get_nums + "</p>";
                           }else{
                               li += "<p class='green'>" + Obj[val].get_nums + "</p>";
                           }
                           li += "<p>" + Obj[val].now_nums + "</p>";
                           li += "<p>" + Obj[val].get_time + "</p>";
                           li += "</li>";
                       }

                   }
                   $("#ul").append(li);
               }
           });
       }
   })
    //转账页面和积分页面触发ajax 获取记录
    $("#lijilu").on("tap", "a", function () {
        var test = window.location.pathname;
        $.ajax({
            url: "/Index/ajaxinfo",
            type: 'post',
            data: {
                'jilu': 'zhuanzhangjilu',
                'url':test,
                'page':"<?php echo ($page); ?>",
                'table':"<?php echo ($table); ?>",
                'in':"<?php echo ($in); ?>",
                'where':"<?php echo ($where); ?>"
            },
            success: function (mes) {
                if(mes.message=='"kong"' || mes.message==null || mes.message==undefined || mes.message==''){
                    msg_alert('没有记录了哦');
                    mui('.refreshContainer').pullRefresh().endPullupToRefresh(true);
                    return;
                }
                var Obj = JSON.parse(mes.message);
                var li = "";
                for (var val in Obj) {
                    if(Obj[val].get_type ==3 || Obj[val].get_type == 4){
                        li += "<li class='lis' data-tepy='liis' data-id='"+Obj[val].id+"'>";
                    }else{
                        li += "<li class='lis' data-id='"+Obj[val].id+"'>";
                    }

                    li += "<p>" + Obj[val].type_name + "</p>"
                    if(Obj[val].get_nums>0){
                        li += "<p  class='red'>+" + Obj[val].get_nums + "</p>"
                    }else{
                        li += "<p class='green'>" + Obj[val].get_nums + "</p>"
                    }
                    li += "<p>" + Obj[val].now_nums + "</p>"
                    li += "<p>" + Obj[val].get_time + "</p>"
                    li += "</li>"
                }
                $("#ul").append(li);
            }
        });
    });


   /**
    *点击转出删除所有ajax记录
    */
  $("#zhuanchu").on("tap", "a", function () {
        $("#ul").find('li').remove();
    });
//
$("#ul").on("tap","li",function () {
    var test = window.location.pathname;
    //判断是否在余额或者记录查询页面
        if($(this).data('tepy') =="liis"){
            //判断是否是转账记录
            window.location.href="mutualParticulars.html?ID="+$(this).data('id')+"&test="+test;
        }if(test=="/Index/feedbackInfo.html"){
            //跳转到用户反馈详情页面
            window.location.href="/User/revertParticulars.html?ID="+$(this).data('id')+"&test="+test;
        }else{
            return false;
        }

})

   //下拉加载
    mui.init({
        pullRefresh: {
            container: '.refreshContainer',
            up: {
                callback: function () {
                    var id = $("#ul").children("li").length;
                    var test = window.location.pathname;
                    $.ajax({
                        url: "/Index/ajaxinfo",
                        type: 'post',
                        data: {
                            'jilu': 'zhuanzhangjilu',
                            'type':'xiala',
                            'url':test,
                            'page':"<?php echo ($page); ?>",
                            'table':"<?php echo ($table); ?>",
                            'in':"<?php echo ($in); ?>",
                            'id':id,
                            'where':"<?php echo ($where); ?>"
                        },
                        success: function (mes) {
                            //console.log(3);
                            if(mes.message=='"kong"' || mes.message==null || mes.message==undefined || mes.message==''){
                                msg_alert('没有记录了哦');
                                mui('.refreshContainer').pullRefresh().endPullupToRefresh(true);
                                return;
                            }
                            var Obj = JSON.parse(mes.message);
                            var li = "";
                            var test = window.location.pathname;
                            for (var val in Obj) {
                                if(test=="/Index/feedbackInfo.html"){
                                    li += "<li class='lis' data-id='"+Obj[val].id+"'>";
                                    li += "<h2>" + Obj[val].content.substring(0,10) + "</h2>"
                                    if(Obj[val].status==2){
                                        li += "<h4>"+ Obj[val].reply.substr(0,10)+ "</h4>"
                                        li +="<img src=\"<?php echo (L("yhfkycl")); ?>\" alt=\"\">"
                                    }else{
                                        li += "<h4>待回复</h4>"
                                        li +="<img src=\"<?php echo (L("yhfkclz")); ?>\" alt=\"\">"
                                    }
                                    li += "<p class='mui-clearfix'>"
                                    li += "<span class='fl'>Mikey钱包</span>"
                                    li += "<span class='fr'>" + Obj[val].create_time + "</span></p>"
                                    li += "</li>"
                                }else{
                                    if(Obj[val].get_type ==3 || Obj[val].get_type == 4){
                                        li += "<li class='lis' data-tepy='liis'  data-id='"+Obj[val].id+"'>";
                                    }else{
                                        li += "<li class='lis' data-id='"+Obj[val].id+"'>";
                                    }
                                    li += "<p>" + Obj[val].type_name + "</p>"
                                    // li +="<p>"+Obj[val].deputy_id+"</p>"
                                    if(Obj[val].get_nums>0){
                                        li += "<p  class='red'>+" + Obj[val].get_nums + "</p>"
                                    }else{
                                        li += "<p class='green'>" + Obj[val].get_nums + "</p>"
                                    }
                                    li += "<p>" + Obj[val].now_nums + "</p>"
                                    li += "<p>" + Obj[val].get_time + "</p>"
                                    li += "</li>"
                                }

                            }
                            $("#ul").append(li);
                        }
                    });
                     mui(".refreshContainer").pullRefresh().setStopped(false)
                    mui('.refreshContainer').pullRefresh().endPullupToRefresh();
                }
            },
             down:{
                callback:function(){
                    location.reload();
                }
            },

        }
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