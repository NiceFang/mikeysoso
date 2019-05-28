<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends CommonController
{

    protected $getType = [
        0=>'转账',
        1=>'积分相关',
        2=>'积分释放',
        3=>'【余额交易】挂求购',
        4=>'购买',
        5=>'【余额交易】出售',
        6=>'取消',
        7=>'购买众筹',
        8=>'买入',
        9=>'卖出',
        10=>'取消（卖家返回余额）',
        11=>'后台操作-余额',
        12=>'系统添加',
        13=>'积分兑换',
        22=>'转入的人弹出领取红包',
        23=>'推荐积分',
        24=>'购物积分',
        31=>'积分相关',
        32=>'积分相关'
    ];

    public function index()
    {
        $userid = session('userid');
        $where['userid'] = $userid;
//        $userLevel = formatLevel($userid);
        $pic_array = $this->get_banner();
        
        $uinfo = M('user')->where($where)->field('img_head,userid,user_credit,is_reward,today_releas,quanxian,use_grade,releas_time,is_degraded')->find();
        $moneyinfo = M('store')->where(array('uid' => $userid))->field('cangku_num,fengmi_num')->find();

        if($uinfo['is_reward'] == 0 || $uinfo['releas_time'] < strtotime(date('Y-m-d'))){
            $can_get = bcmul($moneyinfo['fengmi_num'],'0.002',2);
        }else{
            $can_get = 0;
        }

        if (IS_AJAX) {
            if($can_get>0){
                $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $can_get);
                $datapay['fengmi_num'] = array('exp', 'fengmi_num - ' . $can_get);
                $res_pay_get = M('store')->where(array('uid' => $userid))->save($datapay);//每日银释放金
                //            $dataper['today_releas'] = 0;
                $dataper['is_reward'] = 1;
                $dataper['releas_time'] = time();
                $res_pay = M('user')->where(array('userid' => $userid))->save($dataper);//每日银释放金


                $get_n = M('store')->where(array('uid' => $userid))->getfield('cangku_num');
                $data['pay_id'] = $userid;
                $data['get_id'] = $userid;
                $data['get_nums'] = $can_get;
                $data['now_nums_get'] = $get_n;
                $data['now_nums'] = $get_n;
                $data['is_release'] = 1;
                $data['get_time'] = time();
                $data['get_type'] = 2;
                $res_addrs = M('tranmoney')->add($data);

                $get_ny = M('store')->where(array('uid' => $userid))->getfield('fengmi_num');
                $jifendets['pay_id'] = $userid;
                $jifendets['get_id'] = $userid;
                $jifendets['get_nums'] = -$can_get;
                $jifendets['now_nums'] = $get_ny;
                $jifendets['now_nums_get'] = $get_ny;
                $jifendets['is_release'] = 1;
                $jifendets['get_time'] = time();
                $jifendets['get_type'] = 1;
                M('tranmoney')->add($jifendets);

                //更新用户等级
                formatLevel($userid,$uinfo['use_grade'],$uinfo['is_degraded']);

                if ($res_pay) {
                    $res = $can_get . '积分释放到余额成功';
                    ajaxReturn($res, 1, '/Index/index');
                }
            }
        }
        //今日可领取收益
//        if ($uinfo['is_reward'] == 0) {
//            $basi = M('config')->where(array('name' => 'sell_fee'))->getField('value');

            //C宝里的加速释放
//            $huafei_total = M('store')->where(array('uid'=>$userid))->getField('huafei_total');
//            $plant_num = M('store')->where(array('uid'=>$userid))->getField('plant_num');
//            $total_wb =$huafei_total+$plant_num;//总资产

//            $vpay_price= D('coindets')->where("cid=1")->order('coin_addtime desc')->getField("coin_price");//vpay币的当前价格

//            $wbgrade = M('store')->where(array('uid'=>$userid))->getField('vip_grade');
//            $jingt=array(0.1,0.1,0.2,0.3);
//            $dongt=array(0,0.01,0.02,0.03);
//            $wb_jtotal=$jingt[$wbgrade]/ 100*$total_wb*$vpay_price;//静态加速要释放的银数
            
//            $tuandui_total=0;
//            $wherep["path"]= array('like',"%-".$userid."-%");
//            $team_arr=M('user')->field('userid,path')->where($wherep)->select();

            //计算伞下15代C宝总资产
//            foreach ($team_arr as $k1 => $v1) {
//
//                $path=$v1["path"]."ss";
//                $graden= $this->get_between($path,"-".$userid."-","ss");
//                $gradenum=(int)substr_count($graden,'-');
//                if($gradenum<15){
//                    $dongj = M('store')->where(array('uid'=>$v1["userid"]))->getField('huafei_total');
//                    $keyong = M('store')->where(array('uid'=>$v1["userid"]))->getField('plant_num');
//                    $totalwbs =$dongj+$keyong;
//                    $tuandui_total+=$totalwbs;
//                }
//
//            }

//            $wb_dtotal=$dongt[$wbgrade]/ 100*$tuandui_total*$vpay_price;//动态15层加速要释放的银数
//            $wbs=$wb_jtotal+$wb_dtotal;

//            $can_get = $moneyinfo['fengmi_num'] * $basi / 100 + $uinfo['today_releas']+$wbs;
//            $can_get = floor($can_get * 100000) / 100000;
//        }

        //是否存在当日转账释放红包
//        $startime = date('Y-m-d');
//        $endtime = date("Y-m-d", strtotime("+1 day"));
//        $todaystime = strtotime($startime);
//        $endtime = strtotime($endtime);
//        $whereres['get_id'] = $userid;
//        $whereres['is_release'] = 0;
//        $whereres['get_type'] = 22;
//        $whereres['get_time'] = array('between', array($todaystime, $endtime));
//        $is_setnums = M('tranmoney')->where($whereres)->sum('get_nums') + 0;



        //今日是否已经领取释放收益
//        if (IS_AJAX) {
//            if ($can_get > 0) {
//                $getnums = $can_get;
//                $nowjif=$moneyinfo['fengmi_num'];
//                if($can_get>$nowjif)$getnums=$nowjif;
//
//                $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $getnums);
//                $datapay['fengmi_num'] = array('exp', 'fengmi_num - ' . $getnums);
//                $res_pay_get = M('store')->where(array('uid' => $userid))->save($datapay);//每日银释放金
//                $res_pay_get = M('store')->where(array('uid' => $userid))->setInc('cangku_num',$getnums);//每日银释放金
//                $res_pay = M('store')->where(array('uid' => $userid))->setDec('fengmi_num',$getnums);//每日银释放金
                
//
//                  if ($res_pay_get) {
//
//                    $get_n = M('store')->where(array('uid' => $userid))->getfield('cangku_num');
//                    $data['pay_id'] = $userid;
//                    $data['get_id'] = $userid;
//                    $data['get_nums'] = $getnums;
//                    $data['now_nums_get'] = $get_n;
//                    $data['now_nums'] = $get_n;
//                    $data['is_release'] = 1;
//                    $data['get_time'] = time();
//                    $data['get_type'] = 2;
//
//
//                }
//                $res_addrs = M('tranmoney')->add($data);
//
//                $get_ny = M('store')->where(array('uid' => $userid))->getfield('fengmi_num');
//                $jifendets['pay_id'] = $userid;
//                $jifendets['get_id'] = $userid;
//                $jifendets['get_nums'] = -$getnums;
//                $jifendets['now_nums'] = $get_ny;
//                $jifendets['now_nums_get'] = $get_ny;
//                $jifendets['is_release'] = 1;
//                $jifendets['get_time'] = time();
//                $jifendets['get_type'] = 1;
//                M('tranmoney')->add($jifendets);


                
                 //C宝冻结资产释放
//                 $jshu=array(100,1000,5000,10000);
//                 $shifshu=$total_wb*0.01;
//                 $canshif=$huafei_total-$shifshu;//可以释放的冻结资产数
//
//                 if($canshif<0)$shifshu=$huafei_total;
//
//                if($shifshu>0){
//                $datawb['huafei_total'] = array('exp', 'huafei_total - ' . $shifshu);
//                $datawb['plant_num'] = array('exp', 'plant_num + ' . $shifshu);
//                M('store')->where(array('uid' => $userid))->save($datawb);
//                }


                //添加C宝交易记录
//                $wbaoss["crowds_id"]=0;
//                $wbaoss["create_time"]=time();
//                $wbaoss["num"]=$shifshu;
//                $wbaoss["uid"]=$userid;
//                $wbaoss["dprice"]=0;
//                $wbaoss["tprice"]=0;
//                $wbaoss["type"]=3;//静态
//                $wbao_ss = M('wbao_detail')->add($wbaoss);

//                $wbaossd["crowds_id"]=0;
//                $wbaossd["create_time"]=time();
//                $wbaossd["num"]=$wb_dtotal;
//                $wbaossd["uid"]=$userid;
//                $wbaossd["dprice"]=0;
//                $wbaossd["tprice"]=0;
//                $wbaossd["type"]=4;//动态
//                $wbao_ssd = M('wbao_detail')->add($wbaossd);
               
//                    $dataper['today_releas'] = 0;
//                    $dataper['is_reward'] = 1;
//                    $dataper['releas_time'] = time();
//                    $res_pay = M('user')->where(array('userid' => $userid))->save($dataper);//每日银释放金
//                    if ($res_pay) {
//                        $isgetnums = showtwo($getnums);
//                        $res = $isgetnums . '积分释放到余额成功';
//                        ajaxReturn($res, 1, '/Index/index');
//                    }
//            }
//        }
//        $uinfo['vip_grade'] = $userLevel;
        $uinfo['use_grade_name'] = $this->userLevel[$uinfo['use_grade']];
        $this->assign(array(
            'uinfo' => $uinfo,
            'moneyinfo' => $moneyinfo,
            'can_get' => $can_get,
//            'is_setnums' => $is_setnums,
            'pic_array'=>$pic_array,
        ));
        $this->display('/Index/index');
    }


  /*
  * 轮播私有方法链接数据库
  */
private function get_banner()
{
    $user_object   = M('banner');
    $data_list = $user_object->order('sort')->select();
    return $data_list;
}




   



    public function Dotrrela()
    {
        if (IS_AJAX) {
            $userid = session('userid');
            //是否存在当日转账释放红包
            $startime = date('Y-m-d');
            $endtime = date("Y-m-d", strtotime("+1 day"));
            $todaystime = strtotime($startime);
            $endtime = strtotime($endtime);
            $whereres['get_id'] = $userid;
            $whereres['is_release'] = 0;
            $whereres['get_type'] = 22;
            $whereres['get_time'] = array('between', array($todaystime, $endtime));
            $is_setnums = M('tranmoney')->where($whereres)->sum('get_nums') + 0;
            if ($is_setnums > 0) {
                $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $is_setnums);
                $datapay['fengmi_num'] = array('exp', 'fengmi_num - ' . $is_setnums);
                $res_pay = M('store')->where(array('uid' => $userid))->save($datapay);//每日银释放金

                //添加释放记录
                $jifen_nums = $is_setnums;
                $jifen_dochange['pay_id'] = $userid;
                $jifen_dochange['get_id'] = $userid;
                $jifen_dochange['get_nums'] = $jifen_nums;
                $jifen_dochange['get_time'] = time();
                $jifen_dochange['get_type'] = 2;
                $res_addres = M('tranmoney')->add($jifen_dochange);
                //改成已释放
                $savedata['is_release'] = 1;
                $savedata['get_time'] = time();
                $is_setnums = M('tranmoney')->where($whereres)->save($savedata);
                if ($is_setnums) {
                    ajaxReturn('转账积分释放成功', 1);
                } else {
                    ajaxReturn('转账积分释放失败', 0);
                }
            }
        }
    }

    //金记录
    public function Bancerecord()
    {
        $traInfo = M('tranmoney');
        $uid = session('userid');
        $where['pay_id|get_id'] = $uid;
        $where['get_type'] = array('not in', '1,11,12,22,23,31,32,24');
        //分页
        $p = getpage($traInfo, $where, 50);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();

        
        foreach ($Chan_info as $k => $v) {


            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
            //转入转出
            if ($uid == $v['pay_id']) {
                $Chan_info[$k]['trtype'] = 1;
                    if($v['get_type']==5){//当自己是求购方支付金，因挂求购单时已支付了金，故不存在
                        unset($Chan_info[$k]);

                    }

            } else {
                $Chan_info[$k]['trtype'] = 2;
            }


        }
        if (IS_AJAX) {
            if (count($Chan_info) >= 1) {
                ajaxReturn($Chan_info, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }
        $this->assign('page', $page);
        $this->assign('Chan_info', $Chan_info);
        $this->assign('uid', $uid);
        $this->display();
    }

    //转出
    public function Turnout()
    {
        if (IS_AJAX) {
            $uinfo = trim(I('uinfo'));
            //手机号码或者用户id
            $map['userid|mobile'] = $uinfo;

           // dump($map);die;
            $issetU = M('user')->where($map)->field('userid,username')->find();
            $userid = session('userid');

            if ($userid == $issetU['userid']) {
                ajaxReturn(L('bnzgzj'), 0);
            }
            if ($issetU) {
                $url = '/Index/Changeout/sid/' . $issetU['userid'];
                ajaxReturn($url, 1);
            } else {
                ajaxReturn(L('bbczgyh'), 0);
            }
        }
      	$userid = session('userid');
      	$moneyinfo = M('store')->where(array('uid' => $userid))->field('cangku_num,fengmi_num')->find();
      	$coindets=array();
        for($i=1;$i<=5;$i++){
        $coindets[]= D('coindets')->where("cid=".$i)->order('coin_addtime desc')->find();

        }
        $this->assign('coindets',$coindets);
		$this->assign('moneyinfo', $moneyinfo);
        $this->display();
    }


    public function Changeout()
    {
        $sid = trim(I('sid'));
        $uinfo = M('user as us')->JOIN('ysk_store as ms')->where(array('us.userid' => $sid))->field('us.mobile,us.userid,us.img_head,us.username,ms.cangku_num')->find();
        if (IS_AJAX) {
            $data = $_POST['post_data'];
            $trid = trim($data['zuid']);
            $paytype = trim($data['paytype']);
            $paynums = $data['paynums'];
            $mobila = trim($data['mobila']);
            $pwd = trim(I('pwd'));
            $uid = session('userid');
        
            $info2=$paynums%100;

            if($paynums<100){

                ajaxReturn('不得小于100',0);

              }

            if($info2){

                 ajaxReturn('请输入100的倍数',0);
            
                }


            //验证交易密码
            $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt,use_grade,is_degraded')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //验证手机号码后四位
            $is_setm['userid|mobile'] = $trid;
//            $tmobile = M('user')->where($is_setm)->getfield('mobile');
//            $tmobile = substr($tmobile, -4);
//            if ($tmobile != $mobila) {
//                ajaxReturn('您输入的手机号码后四位有误', 0);
//            }
            if ($paynums <= 0) {
                ajaxReturn('您输入的转账金额有误哦~', 0);
            }
            if ($uid == $trid) {
                ajaxReturn('您不能给自己转账哦~', 0);
            }
            $mine_money = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
            if ($mine_money < $paynums) {
                ajaxReturn('您积分暂无这么多哦~', 0);
            }
            $tper = $paynums * 20 / 100;
            $eper = $paynums * 80 / 100;
            $datapay['cangku_num'] = array('exp', 'cangku_num - ' . $paynums);
            $datapay['fengmi_num'] = array('exp', 'fengmi_num + ' . $eper);
            $res_pay = M('store')->where(array('uid' => $uid))->save($datapay);//转出的人+80%银
            formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
            //添加释放记录
            userAward($uid,'zhuandj1',3,$paynums);

            $dataget['cangku_num'] = array('exp', "cangku_num + $eper");
            $dataget['fengmi_num'] = array('exp', 'fengmi_num + ' . $tper);
            $res_get = M('store')->where(array('uid' => $trid))->save($dataget);//转入的人+20%银
            $trUserInfo = M('user')->where(array('userid' => $trid))->Field('use_grade,is_degraded')->find();
            formatLevel($trid,$trUserInfo['use_grade'],$trUserInfo['is_degraded']);

             $pay_ny = M('store')->where(array('uid' => $uid))->getfield('fengmi_num');
             $get_ny = M('store')->where(array('uid' => $trid))->getfield('fengmi_num');

            //转入的人+20%银记录SSS
            $changenums['pay_id'] = $uid;
            $changenums['get_id'] = $trid;
            $changenums['now_nums'] = $pay_ny;
            $changenums['now_nums_get'] = $pay_ny;
            $changenums['get_nums'] = $eper;
            $changenums['is_release'] = 1;
            $changenums['get_time'] = time();
            $changenums['get_type'] = 1;
            M('tranmoney')->add($changenums);

            //转出的人+80%积分记录SSS
            $changenums['pay_id'] = $uid;
            $changenums['get_id'] = 0;
            $changenums['now_nums'] = $pay_ny;
            $changenums['now_nums_get'] = $pay_ny;
            $changenums['get_nums'] = $eper;
            $changenums['is_release'] = 1;
            $changenums['get_time'] = time();
            $changenums['get_type'] = 31;
            M('tranmoney')->add($changenums);

            //转入的人+20%积分记录SSS
            $changenums['pay_id'] = 0;
            $changenums['get_id'] = $trid;
            $changenums['now_nums'] = $get_ny;
            $changenums['now_nums_get'] = $get_ny;
            $changenums['get_nums'] = $tper;
            $changenums['is_release'] = 1;
            $changenums['get_time'] = time();
            $changenums['get_type'] = 32;
            M('tranmoney')->add($changenums);
            //转入的人+20%银记录EEE
//            $jifen_nums = $tper * 2 / 1000;
//            $jifen_dochange['pay_id'] = $trid;
//            $jifen_dochange['get_id'] = $trid;
//            $jifen_dochange['get_nums'] = $jifen_nums;
//            $jifen_dochange['get_time'] = time();
//            $jifen_dochange['get_type'] = 22;
//            M('tranmoney')->add($jifen_dochange);
            //对应20%银释放到金SSS
//            $jifen_donums['cangku_num'] = array('exp', "cangku_num + $jifen_nums");
//            $jifen_donums['fengmi_num'] = array('exp', 'fengmi_num - ' . $jifen_nums);
//            $res_get = M('store')->where(array('uid' => $trid))->save($jifen_donums);//转入的人+20%银


                //金转动奖---没有触发
                $this->zhuand15($uid,$paynums);//转出方15层得到转动奖
                

//                $this->zhuand15($trid,$eper);//转入方15层得到转动奖

            //判断用户等级
//            $uChanlev = D('Home/index');
//            $uChanlev->Checklevel($trid);
            //执行转账
             $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
             $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');

            if ($res_pay && $res_get) {
                $data['pay_id'] = $uid;
                $data['get_id'] = $trid;
                $data['get_nums'] = $paynums;
                $data['now_nums'] = $pay_n;                
                $data['now_nums_get'] =$get_n;                
                $data['is_release'] =1;                
                $data['get_time'] = time();
            }
            
            $add_Dets = M('tranmoney')->add($data);
            if ($add_Dets) {
                ajaxReturn('转账成功哦~', 1, '/Index/index');
            }
        }
        $this->assign('uinfo', $uinfo);
        $this->display();
    }

    //金转银

    public function test()
    {
          $userid = session('userid');

       

    }


 public function get_between($input, $start, $end) {
    $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
    return $substr;

}


    //管理奖和直推奖， 管理拿2-4代
    private function Manage_reward($uid,$paynums){

    $Lasts = D('Home/index');
    $Lastinfo = $Lasts->Getlasts($uid, 15, 'path');  
    if (count($Lastinfo) > 0) {

        $Manage_b = M('config')->where(array('group' => 6, 'status' => 1))->order('id asc')->select();//分享奖比例
        $Manage_a = M('config')->where(array('group' => 7, 'status' => 1))->order('id asc')->select();//管理奖比例
   
        foreach ($Lastinfo as $k => $v) {
  
            if (!empty($v)) {//当前会员信息
              

                    if($k==0) {//第一代，即为直推奖 

                        $u_Grade = M('user')->where(array('userid' => $v))->getfield('use_grade');
                        $direct_fee=0;
                        if($u_Grade>0)$direct_fee=(float)$Manage_b[$u_Grade-1]["value"];//判断是什么比例

                        $zhitui_reward = $direct_fee / 100 * $paynums;//直推的人所得分享奖
                        M('user')->where(array('userid' => $v))->setInc('releas_rate', $zhitui_reward);
                    }

                    if ($k>0&&$k<=3) {//2-4代,拿直推的人的分享奖*相应比例，即为管理奖
                         $t=$k-1; 
                         $zhitui_num = M('user')->where(array('pid' => $v))->count(1);//计算直推人数
                         $suoxu_num=(int)$Manage_a[$t]["tip"];
                        if($zhitui_num>=$suoxu_num){//直推人数满足条件

                            $My_reward=$Manage_a[$t]["value"]/100*$zhitui_reward;                          
                            $res_Incrate = M('user')->where(array('userid' => $v))->setInc('releas_rate', $My_reward);
                               
                        }
                    }                  
                   
                
            }//if
        }//foreach

    }
  }

    //区块奖和VIP奖   区块拿15层
    private function Addreas15($uid,$paynums){


    //区块奖1代,确认等级



    $Lasts = D('Home/index');
    $Lastinfo = $Lasts->Getlasts($uid, 15, 'path');
    if (count($Lastinfo) > 0) {
        $add_relinfo = M('config')->where(array('group' => 9, 'status' => 1))->order('id asc')->select();
        $vips = M('config')->where(array('group' => 10, 'status' => 1))->order('id asc')->select();
        $i = 0;
        $n = 0;
        foreach ($Lastinfo as $k => $v) {
            //查询当前自己等级
            if (!empty($v)) {

                    $zhitui_num = M('user')->where(array('pid' => $v))->count(1);//计算直推人数
                    $t=$k+1;
                    $tkey =0;
                    $daishu=array(3,6,9,12,15);
                    foreach ($daishu as $key1 => $value1) {
                     if($t>$value1)$tkey=$key1+1;
                    }
                    
                    $suoxu_num=(int)$add_relinfo[$tkey]["tip"];
                    if($zhitui_num>=$suoxu_num){//直推人数满足条件 得区块奖

                                $Lastone = $My_reward=$add_relinfo[$tkey]["value"]/100*$paynums; 
                                $res_Incrate = M('user')->where(array('userid' => $v))->setInc('releas_rate', $Lastone);

                                
                    }

                    //VIP奖，有集差，加速释放
                    $v_Grade = M('user')->where(array('userid' => $v))->getfield('vip_grade');

                    if(($v_Grade == 1 && $i == 0)||($v_Grade == 2 && $i == 0)){//VIP1奖

                            $u_get_money = $vips[0]['value'] / 100 * $paynums;
                            $res_Add = M('user')->where(array('userid' => $v))->setInc('releas_rate', $u_get_money);
                            $i++;
                            
                            
                    }elseif($v_Grade==2 && $i!=0 &&$n==0){//VIP2奖
                         $u_get_money = $vips[1]['value'] / 100 * $paynums;
                         $res_Add = M('user')->where(array('userid' => $v))->setInc('releas_rate', $u_get_money);
                         $n++;

                    }



               
            }//if
        }//foreach

     }
}



    //金转动奖  拿15层
    public function zhuand15($uid,$paynums)
    {
            $Lasts = D('Home/index');
            $Lastinfo = $Lasts->Getlasts($uid, 15, 'path');  
            if (count($Lastinfo) > 0) {
                    
                    $Manage_b = M('config')->where(array('group' => 8, 'status' => 1))->order('id asc')->select();//金转动奖比例
                    foreach ($Lastinfo as $k => $v) {
              
                        if (!empty($v)) {//当前会员信息

                                    $u_Grade = M('user')->where(array('userid' => $v))->getfield('use_grade');
                                    $direct_fee=0;
                                    if($u_Grade>0)$direct_fee=(float)$Manage_b[$u_Grade-1]["value"];//判断是什么比例

                                    $zhuand_reward = $direct_fee / 100 * $paynums;//我得到转动奖的加速
                                    M('user')->where(array('userid' => $v))->setInc('releas_rate', $zhuand_reward);
                        }
                    }

            }


    }


    public function Turncords()
    {
        $traInfo = M('tranmoney');
        $uid = session('userid');
        $where['pay_id'] = $uid;
        $where['get_type'] = 0;
        //分页
        $p = getpage($traInfo, $where, 20);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
        foreach ($Chan_info as $k => $v) {
            $getinfos = M('user')->where(array('userid' => $v['get_id']))->Field('img_head,username')->find();
            $Chan_info[$k]['imghead'] = $getinfos['img_head'];
            $Chan_info[$k]['guname'] = $getinfos['username'];

        }
        if (IS_AJAX) {
            if (count($Chan_info) >= 1) {
                ajaxReturn($Chan_info, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }
        $this->assign('page', $page);
        $this->assign('Chan_info', $Chan_info);
        $this->assign('uid', $uid);

        $this->display();
    }


    //根据关系进行分销
    public function Doprofit($uid, $paynums, $type)
    {
        $Lasts = D('Home/index');
        $Lastinfo = $Lasts->Getlasts($uid, 15, 'path');
        //数量的多少
        if($type == 1){
            $paynums = $paynums * 20/100;
        }else{
            $paynums = $paynums;

        }
        if (count($Lastinfo) > 0) {
            $this->Addreas($uid,$Lastinfo,$paynums,$type);//加速银释放
        }
    }

    //加速银释放【银基础释放， 1代银加速释放，2-15代，2代vip ，2-15代vip银】
    private function Addreas($uid,$Lastinfo,$paynums,$type){
        //银加速释放率
        $add_relinfo = M('config')->where(array('group' => 4, 'status' => 1))->order('id asc')->select();
        $i = 0;
        foreach ($Lastinfo as $k => $v) {
            $k = $k + 1;
            //查询当前自己等级
            if (!empty($v)) {
                //当前会员信息 等级字段
                $u_Grade = M('user')->where(array('userid' => $v))->getfield('use_grade');

                if ($u_Grade >= 1) {
                    if ($k == 1) {
                        $release_bili = $add_relinfo[1]['value'];
                    } else {
                        $release_bili = $add_relinfo[2]['value'];
                    }
                    $Lastone = $release_bili / 100 * $paynums;
                    //加速银释放
                    $res_Incrate = M('user')->where(array('userid' => $v))->setInc('releas_rate', $Lastone);

                    //增加银
                        $u_get_money = $add_relinfo[3]['value'] / 100 * $paynums;
                        if($u_Grade == 3 && $i == 0){
                            $res_Add = M('store')->where(array('uid' => $v))->setInc('fengmi_num', $u_get_money);//给上级会员加银
                            if ($res_Add) {
                                $earns['pay_id'] = $uid;
                                $earns['get_id'] = $v;
                                $earns['get_nums'] = $u_get_money;
                                $earns['get_level'] = $k;
                                $earns['get_types'] = $type;
                                $earns['get_time'] = time();
                                $res_Earn = M('moneyils')->add($earns);

                                // $jifendets['pay_id'] = $uid;
                                // $jifendets['get_id'] = $v;
                                // $jifendets['get_nums'] = $u_get_money;
                                // $jifendets['get_time'] = time();
                                // $jifendets['get_type'] = 1;
                                // M('tranmoney')->add($jifendets);
                                $i++;
                            }
                    }
                }
            }//if
        }//foreach
    }


    //转出记录
    public function Outrecords()
    {
        $traInfo = M('tranmoney');
        $uid = session('userid');
        $where['pay_id|get_id'] = $uid;
        $where['get_type'] = 0;
        //分页
        $p = getpage($traInfo, $where, 50);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
        foreach ($Chan_info as $k => $v) {
            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
            //转入转出
            if ($uid == $v['pay_id']) {
                $Chan_info[$k]['trtype'] = 1;
            } else {
                $Chan_info[$k]['trtype'] = 2;
            }
        }
        if (IS_AJAX) {
            if (count($Chan_info) >= 1) {
                ajaxReturn($Chan_info, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }
        $this->assign('page', $page);
        $this->assign('Chan_info', $Chan_info);
        $this->assign('uid', $uid);
        $this->display();
    }

   


//兑换银
    public function Exehange()
    {
        $uid = session('userid');
        $minems = M('store')->where(array('uid' => $uid))->find();
        if (IS_AJAX) {
            $dhnums = I('dhnums');
            $pwd = I('pwd');
            if ($dhnums < 100) {
                $this->ajaxReturn(L('dhjebnxy'), 0);
            }
            if ($dhnums % 100 != 0) {
                $this->ajaxReturn(L('dhjebsbs'), 0);
            }
            if ($dhnums > $minems['cangku_num']) {
                $this->ajaxReturn(L('dhjebz'), 0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt,use_grade,is_degraded')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            $canget = $dhnums * 6;
            $dataget['cangku_num'] = array('exp', "cangku_num - $dhnums");
            $dataget['fengmi_num'] = array('exp', 'fengmi_num + ' . $canget);

            $res_get = M('store')->where(array('uid' => $uid))->save($dataget);//金转入银

            //添加释放记录
            userAward($uid,'qukuaij',2,$dhnums);

            //查找当前账户金
            $is_yue = M('store')->where(array('uid' => $uid))->getField('cangku_num');

           //执行兑换
            if ($res_get) {
                $datac['pay_id'] = $uid;
                $datac['get_id'] = $uid;
                $datac['now_nums'] = $is_yue;
                $datac['now_nums_get'] = $is_yue;
                $datac['is_release'] = 1;                
                $datac['get_nums'] = $dhnums;
                $datac['get_time'] = time();
                $datac['get_type'] = 13;

                $pay_n = M('store')->where(array('uid' => $uid))->getfield('fengmi_num');
                $data['pay_id'] = $uid;
                $data['get_id'] = $uid;
                $data['now_nums'] = $pay_n;
                $data['now_nums_get'] = $pay_n;
                $data['is_release'] = 1;                
                $data['get_nums'] = $canget;
                $data['get_time'] = time();
                $data['get_type'] = 1;
            }

            $add_Detsc = M('tranmoney')->add($datac);

            $add_Dets = M('tranmoney')->add($data);

            if ($add_Dets) {
//              $this->Manage_reward($uid,$dhnums); //产生管理奖和分享奖
                   $this->Addreas15($uid,$dhnums);//产生区块奖和VIP奖
             
            
                //更新用户等级
                formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
//                $uChanlev = D('Home/index');
//                $uChanlev->Checklevel($uid);
                ajaxReturn(L('yedhjfcg'), 1, '/Index/exehange');
            }
        }
            $moneyinfo = M('store')->where(array('uid' => $uid))->field('cangku_num,fengmi_num')->find();
		$this->assign('moneyinfo', $moneyinfo);
        $this->assign('minems', $minems);
        $this->display();
    }
  
    //银记录
    public function Exchangerecords()
    {
        $uid = session('userid');
        $where['get_id|pay_id'] = $uid;
        $where['get_type'] = array('in', '1,12,23,24,31,32');
        // $where['get_type'] = 1;
        $traInfo = M('tranmoney');
        //分页
        $p = getpage($traInfo, $where, 50);
        $page = $p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
//        foreach ($Chan_info as $k => $v) {
//            $Chan_info[$k]['get_nums'] = $v['get_nums'];
//            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
//            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
//            if ($uid == $v['pay_id']) {
//                $Chan_info[$k]['trtype'] = 1;
//            } else {
//                $Chan_info[$k]['trtype'] = 2;
//            }
//        }
        $getType = $this->getType;
//        foreach ($Chan_info as $k => $v) {
//            $Chan_info[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
//            $Chan_info[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
//            if($v['get_type'] == 1 && $v['pay_id']==$v['get_id']){
//                if($v['get_nums'] > 0){
//                    $Chan_info[$k]['get_nums'] = '+'.$v['get_nums'];
//                    $Chan_info[$k]['typename'] = '兑换积分';
//                }else{
//                    $Chan_info[$k]['typename'] = '积分释放';
//                }
//            }else{
//                $Chan_info[$k]['typename'] = $getType[$v['get_type']];
//                $Chan_info[$k]['get_nums'] = '+'.$v['get_nums'];
//            }
//        }
        $NoteData = array();
        foreach ($Chan_info as $k => $v) {
            if ($v['get_type'] == 1 && $v['pay_id'] == $v['get_id']) {
                if ($v['get_nums'] > 0) {
                    $NoteData[$k]['get_nums'] = '+' . $v['get_nums'];
                    $NoteData[$k]['typename'] = '兑换积分';
                } else {
                    $NoteData[$k]['typename'] = '积分释放';
                }
                $NoteData[$k]['get_nums'] = $v['get_nums'];
                $NoteData[$k]['now_nums'] = $v['now_nums'];
                $NoteData[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
                $NoteData[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
            }elseif ($v['get_type'] == 1 && $v['pay_id'] != $v['get_id']) {

            }
//            elseif ($v['get_type'] == 31 && $v['pay_id'] == $uid) {
//                $NoteData[$k]['typename'] = $getType[$v['get_type']];
//                $NoteData[$k]['get_nums'] = '+' . $v['get_nums'];
//                $NoteData[$k]['now_nums'] = $v['now_nums'];
//            } elseif ($v['get_type'] == 32 && $v['get_id'] == $uid){
//                $NoteData[$k]['typename'] = $getType[$v['get_type']];
//                $NoteData[$k]['get_nums'] = '+' . $v['get_nums'];
//                $NoteData[$k]['now_nums'] = $v['now_nums'];
//            }
            else{
                $NoteData[$k]['typename'] = $getType[$v['get_type']];
                $NoteData[$k]['get_nums'] = '+' . $v['get_nums'];
                $NoteData[$k]['now_nums'] = $v['now_nums'];
                $NoteData[$k]['get_timeymd'] = date('Y-m-d', $v['get_time']);
                $NoteData[$k]['get_timedate'] = date('H:i:s', $v['get_time']);
            }
//            else{
//                $Chan_info[$k]['typename'] = $getType[$v['get_type']];
//                $Chan_info[$k]['get_nums'] = '+'.$v['get_nums'];
//            }
        }
        if (IS_AJAX) {
            if (count($NoteData) >= 1) {
                ajaxReturn($NoteData, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }
        $this->assign('uid', $uid);
        $this->assign('Chan_info', $NoteData);
        $this->assign('page', $page);
        $this->display();
    }


    //获取仓库数据
    public function StoreData()
    {
        if (!IS_AJAX) {
            return false;
        }
        $store = D('Store');
        $userid = get_userid();
        $where['uid'] = $userid;
        $s_info = $store->field('cangku_num,fengmi_num,plant_num,huafei_total')->where($where)->find();

        $data['cangku'] = $s_info['cangku_num'] + 0;
        // $data['fengmi']=$s_info['fengmi_num']+0;
        $data['plant'] = $s_info['plant_num'] + 0;
        // $data['huafei_total']=$s_info['huafei_total']+0;
        // $data['total']=$s_info['cangku_num']+$s_info['plant_num'];
        $this->ajaxReturn($data);
    }

    //果树数据
    public function landdata()
    {
        if (!IS_AJAX) {
            return false;
        }
        $table = M('nzusfarm');
        $uid = session('userid');
        $where['uid'] = $uid;
        $where['status'] = array('gt', 0);
        $info = $table->field('id,seeds+fruits as num,farm_type type,status')->where($where)->order('id')->select();
        if ($info) {
            $this->ajaxReturn($info);
        }

    }


    public function tooldata()
    {
        if (!IS_AJAX) {
            return false;
        }

        $tree = M('config')->where(array('id' => array('in', array(8, 10, 12, 36))))->order('id asc')->field('value as price,id')->select();
        $tool = M('tool')->field('t_num as price,id')->order('id asc')->select();
        $data = array_merge($tree, $tool);
        if (empty($data)) {
            ajaxReturn('数据加载失败');
        } else {
            ajaxReturn('数据加载成功', 1, '', $data);
        }
    }

    //一键采蜜和狗粮
    public function onefooddata()
    {
        if (!IS_AJAX) {
            return false;
        }

        $where['uid'] = session('userid');
        $data = M('user_tool_month')->field('oneclick one,end_oneclick_time endo,dogfood food,end_dogfood_time endf')->where($where)->find();

        if (empty($data)) {
            ajaxReturn(null);
        } else {
            $time = time();
            if ($data['one'] > 0) {
                if ($time > $data['endo'])
                    $data['one_status'] = '已过期';
                else
                    $data['one_status'] = '使用中';

                $data['endo1'] = date('Y-m-d', $data['endo']);
            }
            if ($data['food'] > 0) {
                if ($time > $data['endf'])
                    $data['food_status'] = '已过期';
                else
                    $data['food_status'] = '使用中';

                $data['endf1'] = date('Y-m-d', $data['endf']);
            }
            ajaxReturn('数据加载成功', 1, '', $data);
        }
    }

    /**
     * 站内信
     */
    public function znx()
    {
        if (IS_AJAX) {
            $db_letter = M('nzletter');
            $userid = session('userid');

            $userInfo = session('user_login');

            $data['recipient_id'] = 0;
            $data['send_id'] = $userid;
            $data['title'] = trim(I('post.title'));
            $data['content'] = trim(I('post.content'));
            $data['username'] = $userInfo['username'];
            $data['account'] = $userInfo['account'];

            if (empty($data['title']) || empty($data['content'])) {
                ajaxReturn('标题或内容不能为空');
                return;
            }

            $data['time'] = time();
            $res = $db_letter->data($data)->add();
            if ($res) {
                ajaxReturn('我们已收到，会尽快处理您的问题', 1);
            } else {
                ajaxReturn('提交失败');
            }
        }

    }


    //购买道具
    public function buytool()
    {
        if (!IS_AJAX) {
            return false;
        }

        $id = I('post.id', 0, 'intval');
        $num = I('post.num', 1, 'intval');
        $typetree = I('post.type');
        if (empty($id)) {
            ajaxReturn('参数错误');
        }

        $uid = session('userid');
        if ($typetree == 'tree') {

            if ($id == 8 || $id == 36) {
                $type = 1;
            } elseif ($id == 10) {
                $type = 2;
            } elseif ($id == 12) {
                $type = 3;
            } else {
                ajaxReturn("操作失败");
            }
            //农田里最低的果子数
            $config = D('config');
            $min_guozi = $config->where(array('id' => $id))->getField('value');

            $des_num = $min_guozi;
            $is_land = no_land();
            if ($is_land && $id != 36) {
                $des_num = $des_num + 30;
            }

            $t_info['t_num'] = $des_num;
            $t_info['t_name'] = '树';
            $t_info['t_img'] = '';
            $num = 1;
            $order_type = 1; //树
        } else {

            $t_info = M('tool')->find($id);
            if (empty($t_info)) {
                ajaxReturn('参数错误');
            }

            //判断是否已拥有此道具，如果已拥有，不在购买
            $type = $t_info['t_type'];
            if ($type == 2) {
                $field = $t_info['t_fieldname'];
                $isbuytool = M('user_level')->where(array('uid' => $uid))->getField($field);
                if ($isbuytool > 0) {
                    ajaxReturn('您已经拥有该宠物了哦！');
                }
            }
            $order_type = 0; //道具
        }


        $data['tool_id'] = $id;
        $data['tool_name'] = $t_info['t_name'];
        $data['tool_price'] = $t_info['t_num'];
        $data['tool_img'] = $t_info['t_img'];
        $data['order_status'] = 0;
        $data['order_no'] = date('YmdHis');
        $data['tool_num'] = $num;
        $data['total_price'] = $num * $t_info['t_num'];
        $data['uid'] = $uid;
        $data['order_type'] = $order_type;


        $order = M('order');
        $order->startTrans();
        $res = $order->add($data);
        if ($res) {
            $url = U('Index/orderdetail', array('order_no' => $data['order_no']));
            ajaxReturn('购买成功', 1, $url);
        } else {
            ajaxReturn('购买失败');
            $order->startTrans();
        }
    }


    //选择支付
    public function orderdetail()
    {
        $order_no = I('order_no');
        $order_no = safe_replace($order_no);
        if (empty($order_no)) {
            return false;
        }
        $where['order_no'] = $order_no;
        $where['order_status'] = 0;
        $order = M('order');
        $o_info = $order->where($where)->find();
        if (empty($o_info)) {
            return false;
        }
        $uid = session('userid');
        $cangku_num = M('store')->where(array('uid' => $uid))->getField('cangku_num');
        $this->assign('o_info', $o_info)->assign('cangku_num', $cangku_num)->display();

    }

    public function gopay()
    {
        if (!IS_POST) {
            return false;
        }

        $order_paytype = I('post.paytype');
        $type_arr = array(1, 2, 3);
        if (!in_array($order_paytype, $type_arr)) {
            ajaxReturn('请选择支付方式');
        }
        $order_no = I('post.order_no');
        $order_no = safe_replace($order_no);
        if (empty($order_no)) {
            ajaxReturn('订单不存在');
        }
        $where['order_no'] = $order_no;
        $where['order_status'] = 0;
        $order = M('order');
        $count = $order->where($where)->count(1);
        if ($count == 0) {
            ajaxReturn('该订单已失效，请重新下单');
        }

        $arr = array(1 => '微信支付', 2 => '支付宝支付', 3 => '果子支付');
        $res = $order->where($where)->setField('order_paytype', $arr[$order_paytype]);
        $wxurl = 'http://yxgsgy.com/wxPay/example/jsapi.php?order_no=' . $order_no;
        $arr_url = array(1 => $wxurl, 2 => '', 3 => U('Ajaxdz/kaiken'));
        if ($res === false) {
            ajaxReturn('下单失败');
        } else {
            ajaxReturn('', 1, $arr_url[$order_paytype]);
        }
    }

    public function DogEat()
    {

        $uid = session('userid');

        $eat = M('user_dogeat');
        $pcount = $eat->where(array('uid' => $uid, 'datestr' => date('Ymd')))->count(1);
        if ($pcount > 0) {
            ajaxReturn('今天已经喂食过了哦');
        }

        $where['uid'] = $uid;
        $dog = M('user_level')->where($where)->getField('zangao_num');
        if ($dog) {
            //判断是否过期
            $table = M('user_tool_month');
            $where['dogfood'] = array('gt', 0);
            $info = $table->where($where)->field('dogfood,end_dogfood_time')->find();
            if (empty($info)) {
                ajaxReturn('您还没狗粮哦，赶紧去购买吧');
            }
            $time = time();
            if ($info['end_dogfood_time'] < $time) {
                ajaxReturn('狗粮没有了，赶紧去购买吧');
            }

            $eat = M('user_dogeat');
            $count = $eat->where(array('uid' => $uid))->count(1);
            $data['uid'] = $uid;
            if ($count == 0) {
                $eat->add($data);
            }
            $data['datestr'] = date('Ymd');
            $data['create_time'] = time();
            $res = $eat->where(array('uid' => $uid))->save($data);
            if ($res)
                ajaxReturn('喂食成功！', 1);
            else
                ajaxReturn('喂食失败！');
        }
    }

    /*public  function lasdfjlasdkjfladfjldasjlfasldfla(){
        $userInfo = M('user')->Field('userid,use_grade,is_degraded')->select();
        foreach ($userInfo as $value){
            formatLevel($value['userid'],$value['use_grade'],$value['is_degraded']);
        }
        echo 12112;
    }*/
}