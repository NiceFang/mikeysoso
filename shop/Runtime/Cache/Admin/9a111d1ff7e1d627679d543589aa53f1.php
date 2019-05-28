<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">

<head>
    <meta charset="utf-8">
    <title><?php echo ($meta_title); ?>｜<?php echo C('WEB_SITE_TITLE');?>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="generator" content="CoreThink">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="apple-touch-icon" type="image/x-icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/logo.png">
    <link rel="stylesheet" type="text/css" href="/Public/libs/lyui/dist/css/lyui.min.css">
    <link rel="stylesheet" type="text/css" href="/shop/Admin/View/Public/css/admin.css">
    
    <link rel="stylesheet" type="text/css" href="/Public/libs/lyui/dist/css/lyui.extend.min.css">
    <link rel="stylesheet" type="text/css" href="/shop/Admin/View/Public/css/style.css">




    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <script type="text/javascript" src="/Public/libs/jquery/1.x/jquery.min.js"></script> -->
    <script type="text/javascript" src="/Public/home/wap/js/jquery-3.3.1.min.js"></script>
     <link rel="stylesheet" href="/Public/plugin/themes/default/default.css" />
    <script charset="utf-8" src="/Public/plugin/kindeditor-min.js"></script>
    <script charset="utf-8" src="/Public/plugin/lang/zh_CN.js"></script>

    <!-- 日期 -->
    <script type="text/javascript" src="/Public/libs/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/Public/libs/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <!-- 日期js cs -->
    <link href="/Public/libs/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
    <link href="/Public/libs/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">

</head>
<!-- <body class="admin_index_index"> -->
<body class="admin_config_group" >
    <div class="clearfix full-header">
        
                <!-- 顶部导航 -->
                <div class="navbar navbar-default navbar-fixed-top main-nav" role="navigation">
                    <div class="container-fluid">
                        <div>
                            <div class="navbar-header navbar-header-inverse">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse-top">
                                    <span class="sr-only">切换导航</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" target="_blank" href="/">
                                    <span><b><span style="color: #2699ed;">后台管理</span></b></span>
                                </a>
                            </div>
                            <div class="collapse navbar-collapse navbar-collapse-top">
                                <ul class="nav navbar-nav">
                                    <!-- 主导航 -->
                                    <li <?php if (CONTROLLER_NAME=='Index') { echo "class='active'"; } ?> ><a href="<?php echo U('Admin/Index/index');?>"><i class="fa fa-home"></i> 首页</a></li>
                                    <?php if(is_array($_menu_list_g)): foreach($_menu_list_g as $key=>$g_val): ?><li <?php if ($_menu_tab['gid']==$g_val['id'] && CONTROLLER_NAME!='Index') { echo "class='active'"; } ?> >
                                    <a href="<?php if($g_val['col'] && $g_val['act']) echo U('Admin/'.$g_val['col'].'/'.$g_val['act']); ?>" target="">
                                        <i class="fa <?php echo ($g_val['icon']); ?>"></i>
                                        <span><?php echo ($g_val["name"]); ?></span>
                                    </a>
                                    </li><?php endforeach; endif; ?>                                                  
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left" class="btn ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                    <li><a target="_blank" href="/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-user"></i> <?php echo ($_user_auth["username"]); ?> <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a target="_blank" href="/"><i class="fa fa-external-link"></i> 打开前台</a></li>
                                            <li><a href="<?php echo U('Admin/Index/removeRuntime');?>" style="border: 0;text-align: left;" class="btn text-left ajax-get no-refresh"><i class="fa fa-trash"></i> 清空缓存</a></li>
                                            <li><a href="<?php echo U('Admin/Pubss/logout');?>" class="ajax-get"><i class="fa fa-sign-out"></i> 退出</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        
    </div>

    <div class="clearfix full-container" id="full-container">
        
            <input type="hidden" name="check_version_url" value="<?php echo U('Admin/Update/checkVersion');?>">
            <div class="container-fluid with-top-navbar" style="height: 100%;overflow: hidden;">
                <div class="row" style="height: 100%;">
                    <!-- 后台左侧导航 S-->
                    <div id="sidebar" class="col-xs-12 col-sm-3 sidebar tab-content">
                        <!-- 模块菜单 -->
                        <nav class="navside navside-default" role="navigation">
                            <?php if($_menu_list_p): ?>
                                <ul class="nav navside-nav navside-first">
                                    <?php if(is_array($_menu_list_p)): $fkey = 0; $__LIST__ = $_menu_list_p;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_first): $mod = ($fkey % 2 );++$fkey;?><li>
                                            <a data-toggle="collapse" href="#navside-collapse-<?php echo ($_ns_first["id"]); ?>-<?php echo ($fkey); ?>">
                                                <i class="<?php echo ($_ns_first["icon"]); ?>"></i>
                                                <span class="nav-label"><?php echo ($_ns_first["name"]); ?></span>
                                                <span class="angle fa fa-angle-down"></span>
                                                <span class="angle-collapse fa fa-angle-left"></span>
                                            </a>
                                            <?php if(!empty($_menu_list_c)): ?><ul class="nav navside-nav navside-second collapse in" id="navside-collapse-<?php echo ($_ns_first["id"]); ?>-<?php echo ($fkey); ?>">
                                                    <?php if(is_array($_menu_list_c)): $skey = 0; $__LIST__ = $_menu_list_c;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_ns_second): $mod = ($skey % 2 );++$skey; if(($_ns_first['id']) == $_ns_second['pid']): ?><li <?php  if(!empty($_select_url) && strtolower($_ns_second['col'].'-'.$_ns_second['act'])== $_select_url) echo 'class="active"'; elseif(empty($_select_url) && $_ns_second['col'] == CONTROLLER_NAME) echo 'class="active"'; ?>>
                                                            <a name="pa" href="<?php echo U($_ns_second['col'].'/'.$_ns_second['act']); ?>" >
                                                                <i class="<?php echo ($_ns_second["icon"]); ?>"></i>
                                                                <span class="nav-label"><?php echo ($_ns_second["name"]); ?></span>
                                                            </a>
                                                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                                </ul><?php endif; ?>
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <!-- 后台左侧导航 E-->

                    <!-- 右侧内容 S-->
                    
   <div id="main" class="col-xs-12 col-sm-9 main" style="overflow-y: scroll;">
        <!-- 面包屑导航 -->
        <ul class="breadcrumb">
            <li><i class="fa fa-map-marker"></i></li>
            <?php if(is_array($_menu_tab['name'])): foreach($_menu_tab['name'] as $key=>$tab_v): ?><li class="text-muted"><?php echo ($tab_v); ?></li><?php endforeach; endif; ?>
        </ul>

        <!-- 主体内容区域 -->
        <div class="tab-content ct-tab-content">
            <div class="panel-body">
                <div class="builder formbuilder-box">
                        
                        <div class="form-group"></div>

                        <!-- 顶部工具栏按钮 -->
                        <div class="builder-toolbar">
                            <div class="row">
                                <!-- 工具栏按钮 -->
                                    <!-- <div class="col-xs-12 col-sm-8 button-list clearfix">
                                        <div class="form-group">
                                            <a title="新增" class="btn btn-primary-outline btn-pill" href="<?php echo U('User/add');?>">新增</a>&nbsp;
                                        </div>
                                    </div> -->

                                <!-- 搜索框 -->
                                <div class="col-xs-12 col-sm-12 clearfix">
                                        <form class="form" method="get" action="">
                                            <div class="form-group right">

                                                <div style="float:left;width:150px;margin-right:20px" class="">
                                                    <input type="text" name="date_start" class="search-input form-control date" value="<?php echo ($_GET["date_start"]); ?>" placeholder="开始日期">
                                                </div>
                                                <div style="float:left;width:150px;margin-right:20px" class="">
                                                    <input type="text" name="date_end" class="search-input form-control date" value="<?php echo ($_GET["date_end"]); ?>" placeholder="结束日期">
                                                </div>

                                                <div style="float:left;width:120px;margin-right:20px" class="">
                                                    <select name="querytype" class="form-control lyui-select select">
                                                        <option  value="userid">ID号</option>
                                                         <option {eq name=":input('get.querytype')" value="mobile" }selected="true"{/eq}  value="mobile">手机</option>
                                                        <option {eq name=":input('get.querytype')" value="account" }selected="true"{/eq}  value="account">账号</option>
                                                        <option {eq name=":input('get.querytype')" value="status" }selected="true"{/eq}  value="status">被封账号</option>
                                                        <option {eq name=":input('get.querytype')" value="use_grade" }selected="true"{/eq}  value="use_grade">等级</option>
                                                    </select>                                            
                                                </div>

  
                                                <div style="width:250px" class="input-group search-form">
                                                    <input  type="text" name="keyword" class="search-input form-control" value="<?php echo ($_GET["keyword"]); ?>" placeholder="输入搜索内容">
                                                    <span class="input-group-btn"><a class="btn btn-default search-btn"><i class="fa fa-search"></i></a></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>



                            </div>
                        </div>
                        

                        <style type="text/css">
                            tr,td{
                               margin: 0 !important;
                               padding: 5px 5px !important;
                            }
                        </style>

                        <!-- 数据列表 -->
                        <div class="builder-container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="builder-table">
                                        <div class="panel panel-default table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                              <thead>
                                                <tr>
                                                    <th>UID</th>
                                                    <th>用户</th>
                                                    <th>财富</th>
                                                    <th>注册</th>
                                                    <th>上级</th>
                                                    <th>直推</th>
                                                    <th>上级会员</th>
                                                    <th>状态</th>
                                                    <th style="max-width:20%" >操作</th>
                                                </tr>
                                            </thead>
                                            <?php  $store=M('store'); ?>
                                                <tbody>
                                                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if(!($_SESSION["user_auth"]["uid"]<>1 && $data['yinbi']==1)){ ?>
                                                        <tr>
                                                        
                                                            <td><?php echo ($data['userid']); ?></td>
                                                            <td>
                                                                账号：<?php echo ($data['account']); ?> <br />
                                                                姓名：<?php echo ($data['username']); ?> <br />
                                                                手机：<?php echo ($data['mobile']); ?>
                                                            </td>
                                                            <!-- 财富 -->
                                                            <td style="white-space: nowrap;" >
                                                          
                                                               余额：<span style="color:#dc3300" ><?php echo ($data['cangku_num']+0); ?></span>
                                                               <br />
                                                               积分：<span style="color:#dc3300" ><?php echo ($data['fengmi_num']+0); ?></span>
                                                            </td>

                                                            <td><?php echo (date('Y-m-d H:i:s',$data['reg_date'])); ?></td>
                                                            <td>
                                                                <?php echo (get_parent_account($data["pid"])); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo M('user')->where(array('pid'=>$data['userid']))->count(1); ?>人
                                                            </td>
                                                            <!--父级会员-->
                                                            <td>
                                                                <!--<?php echo trim($data['path'],'-')?>-->
                                                                <?php echo (trim($data["path"],"-")); ?>
                                                            </td>

                                                            <td>
                                                               <?php if(($data['status']) == "1"): ?><i class="fa fa-check text-success"></i>
                                                               <?php else: ?>
                                                                    <i class="fa fa-ban text-danger"></i><?php endif; ?>
                                                            </td>
                                                            <td>
                                                                    <?php if(in_array(1,$hylb)): ?><a name="edit" title="编辑" class="<?php if(!in_array(1,$hylb)) echo "bky"; ?>   label label-primary-outline label-pill" href="<?php echo U('User/edit',array('id'=>$data['userid']));?>">编辑</a><?php endif; ?>
                                                                <?php if(($data['status']) == "1"): if(in_array(3,$hylb)): ?><a name="forbid" title="锁定" class="<?php if(!in_array(3,$hylb)) echo "bky"; ?>   label label-warning-outline label-pill ajax-get confirm" href="<?php echo U('User/setStatus',array('status'=>forbid,'ids'=>$data['userid'],'model'=>'User'));?>">锁定</a><?php endif; ?>
                                                                <?php else: ?>
                                                                    <?php if(in_array(3,$hylb)): ?><a name="forbid" title="解锁" class="<?php if(!in_array(3,$hylb)) echo "bky"; ?>   label label-success-outline label-pill ajax-get confirm" href="<?php echo U('User/setStatus',array('status'=>resume,'ids'=>$data['userid'],'model'=>'User'));?>">解锁</a><?php endif; endif; ?>
                                                                <div style="height:10px" ></div>
                                                                <?php if(in_array(2,$hylb)): ?><a name="edit" title="修改财富" class="<?php if(!in_array(2,$hylb)) echo "bky"; ?>   label label-primary-outline label-pill" href="<?php echo U('User/AddFruits',array('id'=>$data['userid']));?>">财富</a><?php endif; ?>
                                                                 <!--<?php if($_SESSION["user_auth"]["uid"]==1){ ?>
                                                                  <?php if($data['yinbi']==0): ?><a name="forbid1" title="对其它管理员隐蔽其信息" class="<?php if(!in_array(4,$hylb)) echo "bky"; ?>   label label-success-outline label-pill ajax-get confirm"  href="<?php echo U('User/setStatus1',array('id'=>1,'userid'=>$data['userid']));?>">隐蔽</a>
                                                                  <?php else: ?>
                                                                  <a name="forbid1" title="取消对其它管理员隐蔽其信息" class="<?php if(!in_array(4,$hylb)) echo "bky"; ?>   label label-success-outline label-pill ajax-get confirm"  href="<?php echo U('User/setStatus1',array('id'=>0,'userid'=>$data['userid']));?>">取消隐蔽</a><?php endif; ?>
                                                                  <?php } ?>-->


                                                                <?php if(in_array(5,$hylb)): ?><a title="登录" target="_blank" class="<?php if(!in_array(5,$hylb)) echo "bky"; ?>   label label-primary-outline label-pill" href="<?php echo U('User/userlogin',array('userid'=>$data['userid']));?>">登录</a><?php endif; ?>
                                                        </tr>
                                                        <?php } endforeach; endif; else: echo "" ;endif; ?>

                                                    <?php if(empty($list)): ?><tr class="builder-data-empty">
                                                            <td class="text-center empty-info" colspan="20">
                                                                <i class="fa fa-database"></i> 暂时没有数据<br>
                                                            </td>
                                                        </tr><?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <?php if(!empty($table_data_page)): ?><ul class="pagination"><?php echo ($table_data_page); ?></ul><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
    </div>                   
</div>

                    <!-- 右侧内容 E-->
                    
                </div>


            </div>
        

    </div>

    <div class="clearfix full-footer">
        
    </div>

    <div class="clearfix full-script">
        <div class="container-fluid">
            <input type="hidden" id="corethink_home_img" value="__HOME_IMG__">
            <script type="text/javascript" src="/Public/libs/lyui/dist/js/lyui.min.js"></script>
            <script type="text/javascript" src="/shop/Admin/View/Public/js/admin.js"></script>
            
     <script type="text/javascript">
        $('.date').datetimepicker({
            format: 'yyyy-mm-dd',
            language:"zh-CN",
            minView:2,
            autoclose:true,
            todayBtn:1, //是否显示今日按钮
        });
 


    $(document).ready(function(){
  
     $(".bky").click(function(){
      
        this.href="###";
        alert("您无权限访问");  
        return false;     

        });

    });
</script>
    <script type="text/javascript" src="/Public/libs/lyui/dist/js/lyui.extend.min.js"></script>

        </div>
    </div>
</body>
</html>
  <script>
      //回复反馈内容ajax
      $(function () {
          function isInteger(obj) {
              return obj%1 === 0
          }
          $("#reply_affirm").click(function () {
              var reply_prefix = $("#reply_prefix").val();
              var reply = $("#reply").val();
              var reply_custom_time = $("#reply_custom_time").val();
              var id = $("#reply_id").data('id')
              if(!isInteger(id)){
                  alert('参数有误，请联系管理员');
                  return;
              }
              var reg = /^[1-9]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])\s+(20|21|22|23|[0-1]\d):[0-5]\d$/;
              if(reply==''){
                  alert('回复内容不能为空');
                  return
              }
              var regExp = new RegExp(reg);
              if(reply_custom_time != ''){
                  if(!regExp.test(reply_custom_time)){
                      alert("时间格式不正确,正确格式为: 2014-01-01 12:00");
                      return;
                  }
              }
              if (confirm("回复只能回复一次，你确定提交吗")) {
                  $.ajax({
                      url:"/admin/Complaint/ajaxReply",
                      type:"POST",
                      data:{
                          'id':id,
                          'reply_prefix':reply_prefix,
                          'reply':reply,
                          'reply_custom_time':reply_custom_time
                      },
                      success:function (mes) {
                          if(mes.status){
                              alert(mes.message);
                              window.location.reload();
                          }else{
                              alert(mes.message);
                          }
                      }

                  })
              }
          })
      })
  </script>