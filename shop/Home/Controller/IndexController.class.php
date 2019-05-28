<?php

namespace Home\Controller;

use lib\PHPMailer\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;


class IndexController extends CommonController
{

    protected $getType = [
        0=>'zz',
        1=>'jfxg',
        2=>'yjfsf',
        3=>'yejyqg',
        4=>'goumai',
        5=>'yejycs',
        6=>'qux',
        7=>'gmzc',
        8=>'purchase',
        9=>'sellout',
        10=>'quxmj',
        11=>'htczye',
        12=>'xttj',
        13=>'exchange',
        22=>'zrdrtclq',
        23=>'tjjf',
        24=>'gwjf',
        31=>'jfxg',
        32=>'jfxg'
    ];

    public function index()
    {
        $userid = session('userid');
        $where['userid'] = $userid;
        $pic_array = $this->get_banner();

        $uinfo = M('user')->where($where)
            ->field('img_head,userid,username,user_credit,is_reward,today_releas,quanxian,use_grade,releas_time,is_degraded,is_auto')
            ->find();
        $filesize = @getimagesize("./Public/home/wap/heads/".$uinfo['img_head']);
        if(!$filesize){
            $uinfo['img_head']='toux-icon.png';
        }
        $TOKEN = creatToken();
        $moneyinfo = M('store')->where(array('uid' => $userid))->field('cangku_num,fengmi_num')->find();
        //判断每日红包是否释放
        if($uinfo['is_reward'] == 0 || $uinfo['releas_time'] < strtotime(date('Y-m-d'))){
            //每日释放的金额
            $can_get = bcmul($moneyinfo['fengmi_num'],'0.002',2);
            //$can_get总金额
            if($uinfo['is_auto']){
                M()->startTrans();
                try{
                    $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $can_get);
                    $datapay['fengmi_num'] = array('exp', 'fengmi_num - ' . $can_get);
                    $res_pay_get = M('store')->where(array('uid' => $userid))->save($datapay);//每日银释放金
                    //            $dataper['today_releas'] = 0;
                    $dataper['is_reward'] = 1;
                    $dataper['releas_time'] = time();
                    $res_pay = M('user')->where(array('userid' => $userid))->save($dataper);//每日银释放金
                    $account = M('store')->where(array('uid' => $userid))->find();

                    //添加积分记录
                   $One =  addAccountRecords($userid,$userid,-$can_get,1,$account['fengmi_num'],'scores');
                    //添加余额记录
                    $Two = addAccountRecords($userid,$userid,+$can_get,1,$account['cangku_num'],$type = 'money');
                    $get_n = M('store')->where(array('uid' => $userid))->getfield('cangku_num');
                    //更新用户等级
                    if(!$res_pay_get || !$res_pay || !$One || !$Two){
                        M()->rollback();
                    }
                     formatLevel($userid,$uinfo['use_grade'],$uinfo['is_degraded']);
                    //提交事务
                    M()->commit();
                    $can_get = 0;
                }catch (\Exception $e) {
                    // 回滚事务
                    M()->rollback();
                }
            }
        }else{
            //若释放了每日释放的金额
            $can_get = 0;
        }
        $moneyinfo['cangku_num'] = bcadd($moneyinfo['cangku_num'],'0.00',2);
        $moneyinfo['fengmi_num'] = bcadd($moneyinfo['fengmi_num'],'0.00',2);

        //需要判断哪个的语言
        $level = $this->userLevel[$uinfo['use_grade']];

        $uinfo['use_grade_name'] = L($level);


        //首页气泡浮动
        $away_execute_where = array(
            'user_id' => $userid,
            'is_success' => 1
        );



        //$time =  date('y-m-d').' 00:00:00';
        $time = date('Y-m-d H:i:s',time()-60*60*24);
        $away_execute_where['create_time'] = array('egt',$time);//小于等于
        if($uinfo['is_auto']){
            $away_execute = M('user_award_execute')
                ->where($away_execute_where)
                ->field('id,scores,get_type,is_release,is_success,origin_id,award_id')
                ->select();
        }else{
            //产生8个气泡
            $away_execute = M('user_award_execute')
                ->where($away_execute_where)
                ->field('id,scores,get_type,is_release,is_success,origin_id,award_id')
                ->limit(8)
                ->select();
        }

        foreach ($away_execute as $key => $value) {
            if($value['get_type'] == 51){
                $away_execute[$key]['explain'] = L('ztjl');//语言转换
                $away_execute[$key]['account'] = L('yezj').$value['scores'];//余额增加点击的泡泡
            }else if($value['get_type'] == 52){
                $away_execute[$key]['explain'] = L('qkjl');
                $away_execute[$key]['account'] = L('yezj').$value['scores'];
            }else if($value['get_type'] == 53){
                $away_execute[$key]['explain'] = L('ltjl');
                if($value['is_release'] == 1){
                    $away_execute[$key]['account'] = L('yezj').$value['scores'];
                }else if($value['is_release'] == 2){
                    $away_execute[$key]['account'] = L('jfzj').$value['scores'];
                }
            }else if($value['get_type'] == 54){
                $away_execute[$key]['explain'] = L('gjhyjf');
                $away_execute[$key]['account'] = L('jfzj').$value['scores'];
            }else if($value['get_type'] == 55){
                $away_execute[$key]['explain'] = L('djhyjf');
                $away_execute[$key]['account'] = L('jfzj').$value['scores'];
            }

            if($value['scores'] > 0 && $value['scores'] < 10){
                $away_execute[$key]['size'] = '1.0278rem';
            }elseif ($value['scores'] > 10 && $value['scores'] < 20) {
                $away_execute[$key]['size'] = '1.1667rem';
            }else{
                $away_execute[$key]['size'] = '1.3056rem';
            }
            $away_execute[$key]['top'] = (rand(1000,3900)/1000).'rem';
            $away_execute[$key]['right'] = (rand(0,5400)/1000).'rem';
        }


        //判断登录的用户是否设置了自动收款
        $ar =0;
        if($uinfo['is_auto']==1){
            $taM= M();
            $taM ->startTrans();//开启事务
            try{

                //查询当前用户的所有积分和余额
                $storeData = M('store')->where("uid=$userid")->field('cangku_num,fengmi_num')->find();
                $storeWhere = array('uid'=>$userid,'user_id'=>$userid);

                foreach($away_execute as $val){
                    //是否领取
                    if($val['is_success']==1){
                        //加余额减积分
                        if($val['is_release']==1){
                            if($storeData['fengmi_num'] >= $val['scores']){
                                //若用户积分大于等于需要释放的积分
                                //那么 用户里面的积分减去 需要释放的积分
                                $One = M('store')->where($storeWhere)->setDec('fengmi_num',$val['scores']);
                                file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode(M('store')->_sql()).PHP_EOL,FILE_APPEND);
                                $Two =  M('store')->where($storeWhere)->setInc('cangku_num',$val['scores']);
                                file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode(M('store')->_sql()).PHP_EOL,FILE_APPEND);
                                $arr =  M('store')->where($storeWhere)->field('cangku_num,fengmi_num')->find();
                                //添加余额增加记录
                                $addOne = addAccountRecords($userid,$val['user_id'],+$val['scores'],$val['get_type'],$arr['cangku_num'],'money',$val['award_id'],$val['origin_id']);
                                //添加积分记录
                                $addtow = addAccountRecords($userid,$val['user_id'],-$val['scores'],$val['get_type'],$arr['fengmi_num'],'scores',$val['award_id'],$val['origin_id']);
                                //添加释放记录
                                // addAccountRecords($userid,$val['user_id'],$val['scores'],$val['get_type'],$fengmiState['fengmi_num'],$type = 'scores');
                            }else if($storeData['fengmi_num'] == 0){//若用户的积分为零
                                $fengmiState = M('store')->where($storeWhere)->field('fengmi_num')->find();
                                $arr = M("user")->where("userid=".$userid)->save(['is_auto'=>0]);
                                if ($arr){
                                    return "自动领取失败已改为手动领取，积分为零";
                                }else{
                                    return "自动领取失败，积分为零,修改为手动领取失败请联系管理员";
                                }
                                // addAccountRecords($userid,$val['user_id'],$val['scores'],$val['get_type'],$fengmiState['fengmi_num'],$type = 'scores');
                            }else{
                                //释放量大于总积分的情况，由于积分不够是否，只释放了一部分，则需要做备注
                                $One =  M('store')->where($storeWhere)->setDec('fengmi_num',$storeData['fengmi_num']);
                                file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode('1'.M('store')->_sql()).PHP_EOL,FILE_APPEND);
                                $Two = M('store')->where($storeWhere)->setInc('cangku_num',$storeData['fengmi_num']);
                                file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode('2'.M('store')->_sql()).PHP_EOL,FILE_APPEND);
                                $arr =  M('store')->where($storeWhere)->field('cangku_num,fengmi_num')->find();
                                //添加余额增加记录
                                $addOne = addAccountRecords($userid,$val['user_id'],+$storeData['fengmi_num'],$val['get_type'],$arr['cangku_num'],'money',$val['award_id'],$val['origin_id']);
                                //添加积分记录
                                $addtow = addAccountRecords($userid,$val['user_id'],-$storeData['fengmi_num'],$val['get_type'],$arr['fengmi_num'], 'scores',$val['award_id'],$val['origin_id']);
                            }
                            if(!$One || !$Two || !$addOne || !$addtow){
                                $arr=['One'=>$One,'Two'=>$Two,'addOne'=>$addOne,'addtow'=>$addtow];
                                //事务回滚
                                $taM->rollback();
                            }

                        }else{//若是积分增加 则加积分余额不变
                            $Oneadd = M('store')->where($storeWhere)->setInc('fengmi_num',$val['scores']);
                            if($Oneadd){
                               // M('user_award_execute')->where($storeWhere)->save(["is_success"=>2]);
                               //file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode('3'.M('user_award_execute')->_sql()).PHP_EOL,FILE_APPEND);
                               // file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode($storeWhere).PHP_EOL,FILE_APPEND);
                                $array =  M('store')->where($storeWhere)->field('cangku_num,fengmi_num')->find();
                                $use_grade = M('user')->where('userid='.$userid)->field('use_grade')->find();
                            }else{
                                // 回滚事务
                                $taM->rollback();
                            }
                            //添加积分释放记录
                            if($use_grade['use_grade']==4){
                                $two = addAccountRecords($userid,$val['user_id'],+$val['scores'],54,$array['fengmi_num'], 'scores',$val['award_id'],$val['origin_id']);
                            }else if($use_grade['use_grade']==5){
                                $two = addAccountRecords($userid,$val['user_id'],+$val['scores'],55,$array['fengmi_num'],'scores',$val['award_id'],$val['origin_id']);
                            }else{
                                $two = addAccountRecords($userid,$val['user_id'],+$val['scores'],$val['get_type'],$array['fengmi_num'],'scores',$val['award_id'],$val['origin_id']);
                            }
                            if(!$two){
                                // 回滚事务
                                $taM->rollback();
                            }
                        }
                        //将所有的状态改为 2 说明已使用过
                        $staus = M('user_award_execute')->where("id=".$val['id'])->save(["is_success"=>2]);
                        file_put_contents('xxx.log',date("Y-m-d H:i:s").json_encode('4'.M('user_award_execute')->_sql()).PHP_EOL,FILE_APPEND);
                        //更新用户等级
                        $statusGrade = formatLevel($userid,$uinfo['use_grade'],$uinfo['is_degraded']);
                        if(!$staus || !$statusGrade){
                            // 回滚事务
                            $taM->rollback();
                        }
                    }

                }
           //     $awardState = M('user_award_execute')->where("id=$userid")->save(["is_success"=>2]);
               /* if(!$awardState){
                    // 回滚事务
                    M()->rollback();
                }*/
                //提交事务

                $taM->commit();
                $away_execute = [];
            } catch (\Exception $e) {
                // 回滚事务
                $taM->rollback();
            }
        }
        $this->assign('away_execute', $away_execute);
        $position = array(
            'top' => (rand(1000,3900)/1000).'rem',
            'right' => (rand(0,5400)/1000).'rem',
            'size' => '1.1667rem'
        );
        $this->assign(array(
            'uinfo' => $uinfo,
            'moneyinfo' => $moneyinfo,
            'can_get' => $can_get,
//            'is_setnums' => $is_setnums,
            'pic_array'=>$pic_array,
            // 'lang'=>$lang,
            'position' => $position


        ));
        $this->assign('TOKEN',$TOKEN);
        $this->display('/Index/index');
    }
    public function Lang(){
        //用户语言判断
        if(IS_AJAX){
            if($_POST['url']){
                $lang = $_POST['url'];
                cookie('think_language',$lang,60*60*24*360);
                ajaxReturn(cookie('think_language'),1);
            }
        }
    }
    /**
     * [killQQ description]获取直推，区块，流通奖励
     *
     * @return [type] [description]
     */
    public function updateJF()
    {
        $uid = session('userid');
        $uinfo = M('user')->where("userid=".$uid)
            ->field('img_head,userid,username,user_credit,is_reward,today_releas,quanxian,use_grade,releas_time,is_degraded,is_auto')
            ->find();

        if(!checkToken($_POST['token'])){
            $newArr['status']=0;
            $newArr['message']='服务器内部错误';
            $newArr['token']=creatToken();
            echo json_encode($newArr);
            return;
        }
        $newArr['token']=creatToken();
        $userIdWhere = array('uid'=>$uid);
        if ($_POST['type'] == 'award' ){
            $awardId = I('post.id',0,'intval');
            $Model = M();
            $Model->startTrans();//开启事务
            $awardWhere = array('id' => $awardId,'user_id'=>$uid);
            // $time = date('y-m-d').' 00:00:00';//判断时间 只生效当天的
            $time = date('Y-m-d H:i:s',time()-60*60*24);
            $awardWhere['create_time'] = array('egt',$time);
            $storeData = M('store')->where($userIdWhere)->field('cangku_num,fengmi_num')->find();
            if($storeData['fengmi_num']<=0){
                $newArr['status']=0;
                $newArr['message']='积分不足领取失败';
                $newArr['token']=creatToken();
                echo json_encode($newArr);
                return;
            }
            //$newArr = [];

            $awardData = $Model->table('ysk_user_award_execute')->field('scores,get_type,is_release,is_success,award_id,origin_id')->where($awardWhere)->find();
            try{
                if($awardData['is_success'] == 1){
                    if($awardData['is_release'] == 1){ //若是加速释放 则减积分加余额
                        if($storeData['fengmi_num'] >= $awardData['scores']){
                            //若用户积分余额大于或者等于需要释放的积分 那么减去用户余额 里面的积分
                            $One =M('store')->where($userIdWhere)->setDec('fengmi_num',$awardData['scores']);
                            $two  =  M('store')->where($userIdWhere)->setInc('cangku_num',$awardData['scores']);
                            $arr =  M('store')->where($userIdWhere)->field('cangku_num,fengmi_num')->find();
                            //添加余额记录
                            $statusOne =  addAccountRecords($uid,$awardData['user_id'],+$awardData['scores'],$awardData['get_type'],$arr['cangku_num'],$type = 'money',$awardData['award_id'],$awardData['origin_id']);
                            //添加释放记录
                            $statusTwo = addAccountRecords($uid,$awardData['user_id'],-$awardData['scores'],$awardData['get_type'],$arr['fengmi_num'],$type = 'scores',$awardData['award_id'],$awardData['origin_id']);
                            if(!$statusOne || !$statusTwo){
                                $newArr['status']=0;
                                $newArr['message']='领取失败';
                                echo json_encode($newArr);
                                $Model->rollback();//事务回滚
                                return;

                            }
                            $newArr['val']=$arr['cangku_num'];
                            $newArr['integrals']=$arr['fengmi_num'];
                            $newArr['status']=1;
                        }else{
                            //若用户积分余额小于需要释放的积分 那么就释放全部积分
                            $One = M('store')->where($userIdWhere)->setDec('fengmi_num',$storeData['fengmi_num']);
                            $two = M('store')->where($userIdWhere)->setInc('cangku_num',$storeData['fengmi_num']);
                            $arr =  M('store')->where($userIdWhere)->field('cangku_num,fengmi_num')->find();
                            //添加余额记录
                            $statusOne = addAccountRecords($uid,$awardData['user_id'],+$storeData['fengmi_num'],$awardData['get_type'],$arr['cangku_num'],$type = 'money',$awardData['award_id'],$awardData['origin_id']);
                            //添加释放记录
                            $statusTwo = addAccountRecords($uid,$awardData['user_id'],-$storeData['fengmi_num'],$awardData['get_type'],$arr['fengmi_num'],$type = 'scores',$awardData['award_id'],$awardData['origin_id']);
                            if(!$statusOne || !$statusTwo){
                                $Model->rollback();//事务回滚
                                $newArr['status']=0;
                                $newArr['message']='领取失败';
                                echo json_encode($newArr);
                                return;

                            }
                            $newArr['val']=$arr['cangku_num'];
                            $newArr['integrals']=$arr['fengmi_num'];
                            $newArr['status']=1;
                        }
                        if($statusOne && $statusTwo && $One && $two){
                            //将释放了的记录状态改为 2 说明已使用过
                            M('user_award_execute')->where($awardWhere)->save(["is_success"=>2]);
                            //更新用户等级
                            formatLevel($uid,$uinfo['use_grade'],$uinfo['is_degraded']);
                        }else{
                            $newArr['status']=0;
                            $newArr['message']='领取失败';
                            echo json_encode($newArr);
                            $Model->rollback();//事务回滚
                            return;

                        }
                    }else{
                        //若是积分增加 则加积分余额不变
                        // M('store')->where($userIdWhere)->setInc('fengmi_num',$awardData['scores']);
                        $userIdFen =M('store')->where($userIdWhere)->field('fengmi_num')->find();
                        $gross = (float)$userIdFen['fengmi_num']+(float)$awardData['scores'];
                        $data = [
                            'fengmi_num'=>$gross
                        ];
                        $One = M('store')->where($userIdWhere)->save($data);
                        $oneOne= M('user_award_execute')->where($awardWhere)->save(["is_success"=>2]);
                        $arr =  M('store')->where($userIdWhere)->field('cangku_num,fengmi_num')->find();
                        if($One && $oneOne){
                            //添加积分释放记录
                            $use_grade = M('user')->where('userid='.$uid)->field('use_grade')->find();
                            if($use_grade['use_grade']==4){
                                $addOne = addAccountRecords($uid,$awardData['user_id'],+$awardData['scores'],54,$arr['fengmi_num'],$type = 'scores',$awardData['award_id'],$awardData['origin_id']);
                            }else if($use_grade['use_grade']==5){
                                $addOne =  addAccountRecords($uid,$awardData['user_id'],+$awardData['scores'],55,$arr['fengmi_num'],$type = 'scores',$awardData['award_id'],$awardData['origin_id']);
                            }else{
                                $addOne =  addAccountRecords($uid,$awardData['user_id'],+$awardData['scores'],$awardData['get_type'],$arr['fengmi_num'],$type = 'scores',$awardData['award_id'],$awardData['origin_id']);
                            }
                            if($addOne && $One && $oneOne){
                                //更新用户等级
                                formatLevel($uid,$uinfo['use_grade'],$uinfo['is_degraded']);
                                $newArr['val']=$arr['cangku_num'];
                                $newArr['integrals']=$arr['fengmi_num'];
                                $newArr['status']=1;
                            }else{
                                $newArr['status']=0;
                                $newArr['message']='领取失败';
                                echo json_encode($newArr);
                                $Model->rollback();//事务回滚
                                return;

                            }
                        }else{
                            $Model->rollback();//事务回滚
                            $newArr['status']=0;
                            $newArr['message']='领取失败';
                            echo json_encode($newArr);
                            return;
                        }
                    }
                }
                M()->commit();
                echo json_encode($newArr);
            }catch(Exception $e){
                $Model->rollback();//事务回滚
                $newArr['status']=0;
                $newArr['message']='领取失败';
                echo json_encode($newArr);
            }
        }else{
           if($uinfo['releas_time'] >= strtotime(date('Y-m-d'))){
                $newArr['status']=0;
                $newArr['message']='今日已领取';
                echo json_encode($newArr);
                return;
            }
            $Model = M();
            $Model->startTrans();//开启事务
            try{

                $can_get = $_POST['days'];
                $userid = session('userid');
                $One = $datapay['cangku_num'] = array('exp', 'cangku_num + ' . $can_get);
                $Two = $datapay['fengmi_num'] = array('exp', 'fengmi_num - ' . $can_get);
                $res_pay_get =$Model->table('ysk_store')->where(array('uid' => $userid))->save($datapay);//每日银释放金
                //            $dataper['today_releas'] = 0;
                $dataper['is_reward'] = 1;
                $dataper['releas_time'] = time();
                $res_pay =$Model->table('ysk_user')->where(array('userid' => $userid))->save($dataper);//每日银释放金

                $Model->table('ysk_store')->where(array('uid' => $userid))->find();
                $arr =  M('store')->where($userIdWhere)->field('cangku_num,fengmi_num')->find();
                if($One && $Two && $res_pay_get){
                    //添加积分记录
                    $jilu = addAccountRecords($userid,$userid,-$can_get,1,$arr['fengmi_num'],'scores');
                    //添加余额记录
                    $jilutwo =addAccountRecords($userid,$userid,+$can_get,1,$arr['cangku_num'],$type = 'money');
                    $get_n = M('store')->where(array('uid' => $userid))->getfield('cangku_num');

                    if(!$jilu || !$jilutwo || !$res_pay){
                        $Model->rollback();//事务回滚
                        $newArr['status']=0;
                        $newArr['message']='领取失败';
                        echo json_encode($newArr);
                        return;
                    }
                }else{
                    $Model->rollback();//事务回滚
                    $newArr['status']=0;
                    $newArr['message']='领取失败';
                    echo json_encode($newArr);
                    return;
                }
                $newArr['status']=1;
                $newArr['val']=$arr['cangku_num'];
                $newArr['integrals']=$arr['fengmi_num'];
                M()->commit();
                //更新用户等级
                formatLevel($userid,$uinfo['use_grade'],$uinfo['is_degraded']);
                echo json_encode($newArr);
            }catch(Exception $e){
                $Model->rollback();//事务回滚
                $newArr['status']=0;
                $newArr['message']='领取失败';
                echo json_encode($newArr);
            }

        }
    }

    public function test(){
        echo $this->zyz;
    }
    /**
     *
    判断公告是否显示ajax
     ***/
    public function pdajax()
    {
        if ( !empty($_POST) && $_POST['ac']=="index") {
            $userid = session('userid');
            if (!cookie($userid)){//若cookie不存在的话 
                $news = D('news');
                $thisTime = strtotime(date('Y-m-d 00:00:00',time()));//获取当天0点的时间戳
                $arr = $news->where('create_time>='.$thisTime)->order('id desc')->select();
                if (empty($arr)) {
                    //若没有数据则返回0 不进行公告弹层提示
                    echo "0";
                    return;
                }
                cookie($userid,$arr[0]['id']);
                $arr[0]['create_time']=date("Y-m-d H:i",$arr[0]['create_time']);
                $arr[0]['content'] = html_entity_decode($arr[0]['content'],ENT_QUOTES, 'UTF-8');
//                echo $arr[0]['content'];
                echo json_encode($arr[0],JSON_UNESCAPED_UNICODE);
                return;
            }
            echo "0";
            return;
        }
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
                    ajaxReturn(L('zzjfsfcg'), 1);
                } else {
                    ajaxReturn(L('zzjfsfsb'), 0);
                }
            }
        }
    }

    //矿晶记录
    public function Bancerecord()
    {
        $uid = session('userid');
        $where = [
            'master_id' => $uid
        ];
        $money = M('usermoney_record');
        $moneyDate = $money->field('master_id,deputy_id,get_nums,get_type,now_nums,get_time')->where($where)->order('id desc')->select();

        $getMoneyType = $this->moneyType;
        foreach ($moneyDate as $key => $val){
            if($val['get_type'] == 3 || $val['get_type'] == 4){
                $moneyDate[$key]['type_name'] = L($getMoneyType[$val['get_type']]).'('.$val['deputy_id'].')';
            }else{
                $moneyDate[$key]['type_name'] = L($getMoneyType[$val['get_type']]);
            }
            if($val['get_nums']>0){
                $moneyDate[$key]['get_nums'] = '+'.$val['get_nums'];
            }
        }
        $page = getpage($money, $where, 50);
        $pages = $page->show();

        if (IS_AJAX) {
            if (count($moneyDate) >= 1) {
                ajaxReturn($moneyDate, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }

        $this->assign('page', $pages);
        $this->assign('moneyDate', $moneyDate);
        $this->assign('uid', $uid);
        $this->display();

    }

    //转出
    public function Turnout()
    {
        $uid = session('userid');
        $arr = D('user')->where("userid=$uid")->field('quanxian,team')->find();
        $arrOne = explode('-',$arr['quanxian']);
        $team = explode('-',$arr['team']);

        if(in_array(2,$arrOne)){
            $this->error('您的账号无法进行转账操作，请联系管理员','/Index/index.html');
        }
        if(in_array(2,$team)){
            $this->error('您的账号无法进行转账操作，请联系管理员','/Index/index.html');
        }

        /* $date = D('user')->where("userid=$uid")->field('team')->find();
         $date = explode('-',$date['team']);
         if(in_array(2,$date)){
             ajaxReturn('您的账号无法给团队里的人转账，请联系管理员',0);
         }*/
        if (IS_AJAX) {
            $uinfo = (int)trim(I('uinfo'));
            //手机号码或者用户id
            $map['userid|mobile'] = $uinfo;
            $arr = D('user')->where("userid=$uinfo")->field('quanxian,team')->find();
            $array = explode('-',$arr['quanxian']);
            $team = explode('-',$arr['team']);
            if(in_array(1,$array)){
                ajaxReturn('对方的账号无法进行转账操作，请联系管理员',0);
            }
            if(in_array(1,$team)){
                ajaxReturn('对方的账号无法进行转账操作，请联系管理员',0);
            }
            $IsStatus = (int)D('user')->where("userid=$uinfo")->field('is_states')->find()['is_states'];
            $UserIdStatus = (int)D('user')->where("userid=$uid")->field('is_states')->find()['is_states'];
            if($IsStatus != $UserIdStatus){
                ajaxReturn(L('无效交易'),0);
            }

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
        $coindets=array();
        for($i=1;$i<=5;$i++){
            $coindets[]= D('coindets')->where("cid=".$i)->order('coin_addtime desc')->find();

        }
        $usrInfo = D('user')->where("userid=$userid")->find();
        // $this->assign('scoresDate',$scoresDate);
        $this->assign('usrInfo',$usrInfo);
        $this->assign('coindets',$coindets);
        $this->display();
    }

    /**
     * 小物件页面发送至获取数据的ajax请求
     */
    public function ajaxinfo()
    {
        if($_POST['jilu'] == 'zhuanzhangjilu'){
            $uid = session('userid');

            if(empty($_POST['in'])){
                //判断in参数是否有传递 若无传递则默认显示所有类型的转账记录
                $in = '1,2,3,4,5,6,31,32,42,51,52,53,54,55';
            }else{
                $in=trim($_POST['in']);
            }
            if(empty($_POST['page'])){
                //判断默认条数参数 是否传递 若无传递则默认显示十条
                $page = 10;
            }else{
                $page =trim($_POST['page']);
            }
            if(empty($_POST['table'])){
                //判断表名是否传入 若无则默认查询用户余额表
                $table = 'usermoney_record';
            }else{
                $table = trim($_POST['table']);
            }
            if($_POST['where']){
                //判断where条件是否为1 若为1则说明是用户反馈页面  若不为1则说明是余额或者积分查询页面
                $where = [
                    'user_id'=>$uid
                ];
            }else{
                $where = [
                    'master_id' => $uid,
                    'get_type'=>['in',$in]
                ];
            }
            if(!empty($_POST['type']) && !empty($_POST['id'])){
                //判断 post参数是否有type 和 id参数若有 则说明是用户下拉发送的ajax请求 若无则说明是第一次发送的ajax请求
                $scoresDate = M($table)->where($where)->limit($_POST['id'],$page)->order('id desc')->select();
                if(empty($scoresDate)){
                    ajaxReturn(json_encode('kong'),1);
                }
            }else{
                $scoresDate = M($table)->where($where)->limit($page)->order('id desc')->select();
                if(empty($scoresDate)){
                    ajaxReturn(json_encode('kong'),1);
                }
            }
            //$moneyType
            if($_POST['url']=="/Index/Bancerecord.html" || $_POST['url']=="/Index/Turnout.html" ){
                $getScoresType = $this->moneyType;
            }else{
                $getScoresType = $this->scoresType;
            }
            if($_POST['where']){
                //判断where条件是否为1 若为1则说明是用户反馈页面  若不为1则说明是余额或者积分查询页面
                foreach ($scoresDate as $key => $val){
                    //循环处理一下时间
                    $scoresDate[$key]['create_time'] = date("Y-m-d H:i:s",$scoresDate[$key]['create_time']);
                }
            }else{
                foreach ($scoresDate as $key => $val){
                    //循环处理显示内容条件
                    if($val['get_type'] == 3 || $val['get_type'] == 4){
                        //那么就在返回之前进行处理一下
                        $scoresDate[$key]['type_name'] = L($getScoresType[$val['get_type']]).'('.$val['deputy_id'].')';
                    }else{
                        //若get_type的值不等于3和4
                        $scoresDate[$key]['type_name'] = L($getScoresType[$val['get_type']]);
                    }
                }
            }

            ajaxReturn(json_encode($scoresDate),1);
        }
    }


    public function Changeout()
    {
        $sid = trim(I('sid'));

        $uinfo = M('user as us')->JOIN('ysk_store as ms')->where(array('us.userid' => $sid))->field('us.mobile,us.userid,us.img_head,us.username,ms.cangku_num,us.use_grade')->find();
        $filesize = @getimagesize("./Public/home/wap/heads/".$uinfo['img_head']);
        if(!$filesize){
            $uinfo['img_head']='toux-icon.png';
        }
        if (IS_AJAX) {
            $data = $_POST['post_data'];
            $trid = trim($data['zuid']);

            $paytype = trim($data['paytype']);
            $paynums = $data['paynums'];
            $mobila = trim($data['mobila']);
            $pwd = trim(I('pwd'));
            if(empty(session('userid'))){
                ajaxReturn(L('请先登录'), 0,"/Login/login/l/".cookie('think_language').'html');
            }
            $uid = session('userid');
            $info2=$paynums%100;
            if($paynums<100){
                ajaxReturn(L('bdxy100'),0);
            }
            if($info2){
                ajaxReturn(L('qsr100dbs'),0);
            }

            //验证交易密码
            $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt,use_grade,is_degraded,is_center')->find();

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
                ajaxReturn(L('nsrdzzjeyw'), 0);
            }
            if ($uid == $trid) {
                ajaxReturn(L('nbngzjzz'), 0);
            }
            $mine_money = M('store')->where(array('uid' => $uid))->getfield('cangku_num');

            if ($mine_money < $paynums) {
                ajaxReturn(L('您的余额不足'), 0);
            }
            //查出转入用户信息$trUserInfo
            $trUserInfo = M('user')->where(array('userid' => $trid))->Field('use_grade,is_degraded,is_center,userid')->find();
            $arr = D('user')->where("userid=".$trUserInfo['userid'])->field('quanxian,team')->find();
            $array = explode('-',$arr['quanxian']);
            $team = explode('-',$arr['team']);
            if(in_array(1,$array)){
                ajaxReturn('对方的账号无法进行转账操作，请联系管理员',0);
            }
            if(in_array(1,$team)){
                ajaxReturn('对方的账号无法进行转账操作，请联系管理员',0);
            }
            $Model = M();
            $Model->startTrans();
            try{
                //$store = M('store');
                //判断是否为中心用户
                if($trUserInfo['is_center'] == 1 || $minepwd['is_center'] == 1){
                    //转出用户减少余额，转入添加余额
                    $datapay['cangku_num'] = array('exp', 'cangku_num - ' . $paynums);
                    $res_pay = $Model->table('ysk_store')->where(array('uid' => $uid))->save($datapay);//转出的人+80%银
                    $dataget['cangku_num'] = array('exp', "cangku_num + $paynums");
                    $res_get = $Model->table('ysk_store')->where(array('uid' => $trid))->save($dataget);
                    //  $url = $_SERVER['SERVER_NAME'].":8082?type=publish&content=收到转账：".$paynums."&to=".$trid;
                    //$this->carriedApi($url);
                    //添加余额记录
                    $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    $arrOne = addAccountRecords($uid,$trid,-$paynums,4,$pay_n,$type = 'money');
                    $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');
                    $arrTwo = addAccountRecords($trid,$uid,+$paynums,3,$get_n,$type = 'money');
                    if(!$res_pay || !$res_get || !$arrOne || !$arrTwo){
                        $Model->rollback();//回滚
                        ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                    }
                }else if($trUserInfo['is_center'] == 3 && $minepwd['is_center'] == 3){
                    //若双方都为韩国中心账户
                    $data = [
                        'cangku_num'=>['exp','cangku_num -'.$paynums],
                    ];
                    $dataTurn = [
                        'cangku_num'=>['exp','cangku_num +'.$paynums],
                    ];
                    $res_pay = M('store')->where("uid =$uid" )->save($data);
                    $res_get = M('store')->where("uid=$trid")->save($dataTurn);
                    //添加余额记录
                    $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');
                   $arrOne = addAccountRecords($uid,$trid,-$paynums,4,$pay_n,$type = 'money');
                    $arrTwo = addAccountRecords($trid,$uid,+$paynums,3,$get_n,$type = 'money');
                    //更新用户等级
                    if(!$res_pay || !$res_get || !$arrTwo || !$arrOne){
                        $Model->rollback();//回滚
                        ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                    }
                }else if($trUserInfo['is_center'] == 3){
                    //若转入方为韩国中心账户
                    $tper = $paynums * 80 / 100;//转钱方的百分之80积分
                    //  $eper = $paynums * 80 / 100;//金额
                    //那么转出方获取百分之八积分奖励
                    $data=[
                        'cangku_num'=>['exp','cangku_num -'.$paynums],
                        'fengmi_num' =>['exp','fengmi_num +'.$tper]
                    ];
                    $res_pay = M('store')->where("uid =$uid" )->save($data);
                    //那么转入方获得所有余额
                    $dataTurn=[
                        'cangku_num'=>['exp','cangku_num +'.$paynums]
                    ];
                    $res_get = M('store')->where("uid=$trid")->save($dataTurn);
                    $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');
                    //更新会员等级 只要积分有变化就调用
                   // formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
                    //添加余额记录
                  $arrOne = addAccountRecords($uid,$trid,-$paynums,4,$pay_n,$type = 'money');
                    $arrTwo = addAccountRecords($trid,$uid,+$paynums,3,$get_n,$type = 'money');
                    //添加积分记录
                    $pay_ny = M('store')->where(array('uid' => $uid))->getfield('fengmi_num');
                    $jilu = addAccountRecords($uid,$trid,+$tper,4,$pay_ny,$type = 'scores');
                    if(!$res_pay || !$res_get || !$arrOne || !$arrTwo || !$jilu ){
                        $Model->rollback();//回滚
                        ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                    }
                }else if($minepwd['is_center'] == 3){
                    //若转出方为韩国中心账户 1111111111111111111111111111111111111111111
                    $tper = $paynums * 20 / 100;//百分之20积分
                    $eper = $paynums * 80 / 100;//百分之80金额
                    //  $eper = $paynums * 80 / 100;//金额
                    //那么转出方扣除转出余额 不加积分
                    $data=[
                        'cangku_num'=>['exp','cangku_num -'.$paynums],
                    ];
                    //     $datapay['cangku_num'] = array('exp', "cangku_num - $paynums");
                    $res_pay = M('store')->where("uid =$uid" )->save($data);
                    ////添加释放记录
                    // userAward($uid,'zhuandj1',3,$paynums);
                    //更新会员等级 只要积分有变化就调用
                   // formatLevel($trid,$minepwd['use_grade'],$minepwd['is_degraded']);
                    //那么收款方获得百分之八十余额 百分之20积分
                    $dataTurn=[
                        'cangku_num'=>['exp','cangku_num +'.$eper],
                        'fengmi_num' =>['exp','fengmi_num +'.$tper]
                    ];
                    $res_get = M('store')->where("uid=$trid")->save($dataTurn);
                    $get_ny = M('store')->where(array('uid' => $trid))->getfield('fengmi_num');

                    $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');
                    //添加余额记录
                    $arrOne = addAccountRecords($uid,$trid,-$paynums,4,$pay_n,$type = 'money');
                    $arrTwo = addAccountRecords($trid,$uid,+$eper,3,$get_n,$type = 'money');
                    //添加积分记录
                    $jilu = addAccountRecords($trid,$uid,+$tper,3,$get_ny,$type = 'scores');
                    if(!$res_pay || !$res_get || !$arrOne || !$arrTwo || !$jilu){
                        $arr = ['a'=>$res_pay,'b'=>$res_get,'c'=>$arrOne,'d'=>$arrTwo,'e'=>$jilu];
                        ajaxReturn('转账失败，请联系管理员', 1, '/Index/index');
                    }
                }else{
                    $tper = $paynums * 20 / 100;//积分
                    $eper = $paynums * 80 / 100;//金额

                    $datapay['cangku_num'] = array('exp', 'cangku_num - ' . $paynums);
                    $datapay['fengmi_num'] = array('exp', 'fengmi_num + ' . $eper);
                    $res_pay = $Model->table('ysk_store')->where(array('uid' => $uid))->save($datapay);//转出的人+80%银
                    //formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
                    //添加释放记录


                    $dataget['cangku_num'] = array('exp', "cangku_num + $eper");
                    $dataget['fengmi_num'] = array('exp', 'fengmi_num + ' . $tper);
                    $res_get = $Model->table('ysk_store')->where(array('uid' => $trid))->save($dataget);//转入的人+20%银
                    //   $url = $_SERVER['SERVER_NAME'].":8082?type=publish&content=收到转账金额:+".$eper."积分:+".$tper."&to=".$trid;
                    //   $this->carriedApi($url);
                   // formatLevel($trid,$trUserInfo['use_grade'],$trUserInfo['is_degraded']);

                    $pay_ny = M('store')->where(array('uid' => $uid))->getfield('fengmi_num');
                    $get_ny = M('store')->where(array('uid' => $trid))->getfield('fengmi_num');

                    $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');
                    //添加余额记录
                    $One = addAccountRecords($uid,$trid,-$paynums,4,$pay_n,$type = 'money');
                    $two =  addAccountRecords($trid,$uid,+$eper,3,$get_n,$type = 'money');
                    //添加积分记录
                    $OneArr = addAccountRecords($uid,$trid,+$eper,4,$pay_ny,$type = 'scores');
                    $twoArr = addAccountRecords($trid,$uid,+$tper,3,$get_ny,$type = 'scores');
                    // $Model->rollback();
                    if(!$res_pay || !$res_get || !$One || !$two || !$OneArr || !$twoArr){
                        $Model->rollback();//回滚
                        ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                    }
                }


                if ($res_pay && $res_get) {
                    //ajaxReturn('成功', 1, '/Index/index');
                    //提交
                    if($trUserInfo['is_center'] != 1 && $trUserInfo['is_center'] != 3 && $minepwd['is_center'] != 1 && $minepwd['is_center'] != 3){
                        $name = userAward($uid,'zhuandj1',3,$paynums);
                        if(!$name){
                            $Model->rollback();//回滚
                            $arr = ['name'=>$name];
                            ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                        }
                    }
                    $gradeOne = formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
                    $grade = formatLevel($trid,$trUserInfo['use_grade'],$trUserInfo['is_degraded']);
                    if(!$gradeOne || !$grade){
                        $Model->rollback();//回滚
                        $arr = ['gradeOne'=>$gradeOne,'grade'=>$grade];

                        ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                    }
                    $Model->commit();//事务提交

                    ajaxReturn(L('cg'), 1, '/Index/index');
                }else{
                    $Model->rollback();//回滚
                    ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
                }

            }catch (Exception $e){
                $Model->rollback();//回滚
                ajaxReturn(L('转账失败，请联系管理员'), 1, '/Index/index');
            }

        }
        /**
         * 'zyz'=>'志愿者',
        'hbws'=>'环保卫士',
        'hbkw'=>'环保顾问',
        'hbdr'=>'环保达人',
        'hbds'=>'环保大使',
         */
        if($uinfo['use_grade']=="1"){
            $uinfo['grade_name']=L('zyz');
        }else if($uinfo['use_grade']=="2"){
            $uinfo['grade_name']=L('hbws');
        }else if($uinfo['use_grade']=="3"){
            $uinfo['grade_name']=L('hbkw');
        }else if($uinfo['use_grade']=="4"){
            $uinfo['grade_name']=L('hbdr');
        }else if($uinfo['use_grade']=="5"){
            $uinfo['grade_name']=L('hbds');
        }
        $this->assign('uinfo', $uinfo);
        $this->display();
    }
    public function carriedApi($url,$data=null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $output = json_decode($output,true);
        return $output;
    }

    public function Changeoutbak()
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
                ajaxReturn(L('bdxy100'),0);
            }
            if($info2){
                ajaxReturn(L('qsr100dbs'),0);

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
                ajaxReturn(L('nsrdzzjeyw'), 0);
            }
            if ($uid == $trid) {
                ajaxReturn(L('nbngzjzz'), 0);
            }
            $mine_money = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
            if ($mine_money < $paynums) {
                ajaxReturn(L('njfzwzmd'), 0);
            }
            $tper = $paynums * 20 / 100;
            $eper = $paynums * 80 / 100;
            $datapay['cangku_num'] = array('exp', 'cangku_num - ' . $paynums);
            $datapay['fengmi_num'] = array('exp', 'fengmi_num + ' . $eper);
            $res_pay = M('store')->where(array('uid' => $uid))->save($datapay);//转出的人+80%银
            formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
//            //添加释放记录
            userAward($uid,'zhuandj1',3,$paynums);

            $dataget['cangku_num'] = array('exp', "cangku_num + $eper");
            $dataget['fengmi_num'] = array('exp', 'fengmi_num + ' . $tper);
            $res_get = M('store')->where(array('uid' => $trid))->save($dataget);//转入的人+20%银
            $trUserInfo = M('user')->where(array('userid' => $trid))->Field('use_grade,is_degraded')->find();
            formatLevel($trid,$trUserInfo['use_grade'],$trUserInfo['is_degraded']);

            $pay_ny = M('store')->where(array('uid' => $uid))->getfield('fengmi_num');
            $get_ny = M('store')->where(array('uid' => $trid))->getfield('fengmi_num');

            $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
            $get_n = M('store')->where(array('uid' => $trid))->getfield('cangku_num');

            //添加余额记录
            addAccountRecords($uid,$trid,-$paynums,4,$pay_n,$type = 'money');
            addAccountRecords($trid,$uid,+$eper,3,$get_n,$type = 'money');
            //添加积分记录
            addAccountRecords($uid,$trid,+$eper,4,$pay_ny,$type = 'scores');
            addAccountRecords($trid,$uid,+$tper,3,$get_ny,$type = 'scores');
            //转入的人+20%银记录SSS
//            $changenums['pay_id'] = $uid;
//            $changenums['get_id'] = $trid;
//            $changenums['now_nums'] = $pay_ny;
//            $changenums['now_nums_get'] = $pay_ny;
//            $changenums['get_nums'] = $eper;
//            $changenums['is_release'] = 1;
//            $changenums['get_time'] = time();
//            $changenums['get_type'] = 1;
//            M('tranmoney')->add($changenums);
//
//            //转出的人+80%积分记录SSS
//            $changenums['pay_id'] = $uid;
//            $changenums['get_id'] = 0;
//            $changenums['now_nums'] = $pay_ny;
//            $changenums['now_nums_get'] = $pay_ny;
//            $changenums['get_nums'] = $eper;
//            $changenums['is_release'] = 1;
//            $changenums['get_time'] = time();
//            $changenums['get_type'] = 31;
//            M('tranmoney')->add($changenums);
//
//            //转入的人+20%积分记录SSS
//            $changenums['pay_id'] = 0;
//            $changenums['get_id'] = $trid;
//            $changenums['now_nums'] = $get_ny;
//            $changenums['now_nums_get'] = $get_ny;
//            $changenums['get_nums'] = $tper;
//            $changenums['is_release'] = 1;
//            $changenums['get_time'] = time();
//            $changenums['get_type'] = 32;
//            M('tranmoney')->add($changenums);
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
                ajaxReturn(L('cg'), 1, '/Index/index');
            }
        }
        $this->assign('uinfo', $uinfo);
        $this->display();
    }

    //金转银




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
                        if(!$res_Add){
                            return 0;
                        }

                    }elseif($v_Grade==2 && $i!=0 &&$n==0){//VIP2奖
                        $u_get_money = $vips[1]['value'] / 100 * $paynums;
                        $res_Add = M('user')->where(array('userid' => $v))->setInc('releas_rate', $u_get_money);
                        $n++;
                        if(!$res_Add){
                            return 0;
                        }
                    }

                }
            }
            return 1;
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
        $uid = session('userid');
        $where = [
            'master_id' => $uid
        ];
        $mab['get_type']  = array('in','3,4');
        $time = date('Y-m-d',time()-24*60*60*7);
        $money = M('usermoney_record');
        $Chan_info = $money
            ->field('id,master_id,deputy_id,get_nums,get_type,now_nums,get_time')
            ->where($where)
            ->where($mab)
            ->where('get_time>'.$time)
            ->order('get_time desc')
            ->select();

        $getMoneyType = $this->moneyType;
        foreach ($Chan_info as $key => $val){
            if($val['get_type'] == 3 || $val['get_type'] == 4){
                $Chan_info[$key]['type_name'] = L($getMoneyType[$val['get_type']]).'('.$val['deputy_id'].')';
            }
        }
        $page = getpage($money, $where, 50);
        $pages = $page->show();

        if (IS_AJAX) {
            if (count($Chan_info) >= 1) {
                ajaxReturn($Chan_info, 1);
            } else {
                ajaxReturn('暂无记录', 0);
            }
        }

        $this->assign('page', $pages);
        $this->assign('xuid',$uid);
        $this->assign('Chan_info', $Chan_info);//记录数据
        $this->assign('uid', $uid);
        $this->display();

    }
    //记录详情
    public function recordDetail(){
        $id = I('id');
        $detail = M('usermoney_record')->where(['id'=>$id])->select();
        $this->assign('detail',$detail);
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
                ajaxReturn(L('zwjl1'), 0);
            }
        }
        $this->assign('page', $page);
        $this->assign('Chan_info', $Chan_info);
        $this->assign('uid', $uid);
        $this->display();
    }




    //兑换积分
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
            M()->startTrans();
            try{
                $minepwd = M('user')->where(array('userid' => $uid))->Field('account,mobile,safety_pwd,safety_salt,use_grade,is_degraded')->find();
                $user_object = D('Home/User');
                $user_object->Trans($minepwd['account'], $pwd);
                $canget = $dhnums * 6;
                $dataget['cangku_num'] = array('exp', "cangku_num - $dhnums");
                $dataget['fengmi_num'] = array('exp', 'fengmi_num + ' . $canget);
                //金转入银
                $res_get = M('store')->where(array('uid' => $uid))->save($dataget);
                $allAccount = M('store')->field('cangku_num,fengmi_num')->where(array('uid' => $uid))->find();
                //执行兑换
                if (!$res_get) {
                    M()->rollback();//事务回滚
                    return 0;
                }
                //添加余额记录
                $One = addAccountRecords($uid,0,-$dhnums,2,$allAccount['cangku_num'],$type = 'money');
                //添加积分记录
                $Two = addAccountRecords($uid,0,+$canget,2,$allAccount['fengmi_num'],$type = 'scores');
                //产生管理奖和分享奖
                $jiangli = $this->Addreas15($uid,$dhnums);
                //更新用户等级
                $status = formatLevel($uid,$minepwd['use_grade'],$minepwd['is_degraded']);
                $update = userAward($uid,'qukuaij',2,$dhnums);
                if(!$One || !$Two || !$jiangli || !$status || !$update){
                    M()->rollback();//事务回滚
                    $arr = ['One'=>$One,'Two'=>$Two,'jiangli'=>$jiangli,'status'=>$status,'update'=>$update];
                    ajaxReturn(L('czsb'), 0, '/Index/exehange');
                }
                M()->commit();
                ajaxReturn(L('yedhjfcg'), 1, '/Index/exehange');
            }catch(Exception $e){
                M()->rollback();//事务回滚
                ajaxReturn(L('czsb'), 0, '/Index/exehange');
            }
        }
        $where =["userid"=>$uid];
        $uinfo = M('user')->where($where)
            ->field('img_head,userid,username,user_credit,is_reward,today_releas,quanxian,use_grade,releas_time,is_degraded,is_auto')
            ->find();
        $level = $this->userLevel[$uinfo['use_grade']];
        $lang = L('l');
        $uinfo['use_grade_name'] = L($level);
        $moneyinfo = M('store')->where(array('uid' => $uid))->field('cangku_num,fengmi_num')->find();
        $moneyinfo['cangku_num'] =(float) $moneyinfo['cangku_num'];
        $moneyinfo['fengmi_num'] =(float) $moneyinfo['fengmi_num'];
        $this->assign('moneyinfo', $moneyinfo);
        $this->assign('minems', $minems);
        $this->assign('uinfo', $uinfo);
        $this->display();
    }

    //矿池记录
    public function Exchangerecords()
    {
        $uid = session('userid');
        $where = [
            'master_id' => $uid
        ];
        $scoresDate = M('userscores_record')->field('master_id,deputy_id,get_nums,get_type,now_nums,get_time')->where($where)->order('id desc')->select();

        $getScoresType = $this->scoresType;
        foreach ($scoresDate as $key => $val){
            if($val['get_type'] != 3 && $val['get_type'] != 4){
                $scoresDate[$key]['type_name'] = L($getScoresType[$val['get_type']]);
            }else{
                $scoresDate[$key]['type_name'] = L($getScoresType[$val['get_type']]).'('.$val['deputy_id'].')';
            }
        }
        $this->assign('scoresDate', $scoresDate);
        $this->assign('uid', $uid);
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
            ajaxReturn(L('sjjzsb'));
        } else {
            ajaxReturn(L('sjjzsg'), 1, '', $data);
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
                    $data['one_status'] = L('ygq');
                else
                    $data['one_status'] = L('syz');

                $data['endo1'] = date('Y-m-d', $data['endo']);
            }
            if ($data['food'] > 0) {
                if ($time > $data['endf'])
                    $data['food_status'] = L('ygq');
                else
                    $data['food_status'] = L('syz');

                $data['endf1'] = date('Y-m-d', $data['endf']);
            }
            ajaxReturn(L('sjjzsg'), 1, '', $data);
        }
    }
    public function xxx(){
        echo 1;
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
//买入
    public function trading_buy(){
        $uid = session('userid');
        $arr = D('user')->where("userid=$uid")->field('quanxian,team')->find();
        $arrOne = explode('-',$arr['quanxian']);
        $team = explode('-',$arr['team']);
        if(in_array(3,$arrOne)){
            $this->error('您的账号无法进行买入操作，请联系管理员','/index/index.html');
        }
        if(in_array(3,$team)){
            $this->error('您的账号无法进行买入操作，请联系管理员','/index/index.html');
        }
        $order_info = M('trans as tr')
            ->join('LEFT JOIN  ysk_user as us on tr.payout_id = us.userid')
            ->where(array('tr.pay_state'=>0,'tr.trans_type'=>1,'us.status'=>1,'tr.payout_id'=>array('not in',$uid.',0')))
            ->order('id desc')
            ->select();
        foreach($order_info as $k => $v){
            $order_info[$k]['cardinfo'] = M('bank_name')->where(array('q_id'=>$v['card_id']))->getfield('banq_genre');
//                $order_info[$k]['spay'] = $v['pay_nums'] * 0.85;
        }
        // dump($order_info);exit;
        $isEmpty = L('mzdxgjl');
        if(count($order_info) <= 0){
            $this -> assign('kong',$isEmpty);
        }else{
            $this -> assign('data',$order_info);
        }


        $this -> display();
    }
    //卖出

    /**
     * 进入交易中心页面方法
     */
    public function trading_center(){
        $uid = session('userid');
        $order_info = M('trans as tr')
            ->join('LEFT JOIN  ysk_user as us on tr.payin_id = us.userid')
            ->where(array('tr.pay_state'=>0,'tr.trans_type'=>0,'us.status'=>1,'tr.payin_id'=>array('not in',$uid.',0')))
            ->order('pay_nums desc,pay_time asc')
            ->select();
        //是否只显示一条
        foreach($order_info as $key => $val){

            if($order_info[$key]['pay_nums'] == $order_info[$key+1]['pay_nums']){
                unset($order_info[$key+1]);
            }
        }

        $isEmpty = L('mzdxgjl');
        if(count($order_info) <= 0){
            $this -> assign('kong',$isEmpty);
        }else{

            $this -> assign('data',$order_info);
        }
        $this -> display();

    }
    //我的订单
    public function myOrderSale(){
      /*  if(IS_AJAX){
            //开启事务
            M()->startTrans();
            $uid = session('userid');
            $trid = I('trid',1,'intval');
            $pwd = trim(I('pwd'));
            $sellnums = M('trans')->where(array('id'=>$trid))->field('pay_nums,payin_id,pay_state')->find();
            $sellAll = array(500,1000,3000,5000,10000,30000);
            if (!in_array($sellnums['pay_nums'], $sellAll)) {
                ajaxReturn(L('nxzgmdjebzq'),0);
            }
            if($sellnums['payin_id'] == $uid){
                ajaxReturn(L('nbnzjgmo'),0);
            }
            if($sellnums['pay_state'] != 0){
                ajaxReturn(L('gddczyc'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            $verifyDate = M("verify_list")->where(array('uid'=>$uid))->order('id desc')->field('type,status')->find();
//            var_dump($verifyDate);
            if(empty($verifyDate)){
                //判断用户是否在商城开店铺 若开了 则扣百分之十手续费 若没开 则扣百分之十五
                $lilv = '0.15';
            }else{
                if($verifyDate['status'] ==1 && $verifyDate['type'] == 2){
                    $lilv = '0.10';
                }else{
                    $lilv = '0.15';
                }
            }
            $shouldpay = $sellnums['pay_nums'];
            $shouxufei = bcmul($shouldpay,$lilv,2);
            $allNum = bcadd($shouxufei,$shouldpay,2);
            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid'=>$uid))->getField('cangku_num');

            if($allNum > $is_enough){
                ajaxReturn(L('ndqzhzwzmdye'),0);
            }
            //是否绑定银行卡
           /* $id_setcards = M('ubanks')->where(array('user_id'=>$uid,'is_default'=>1))->count('1');
            if($id_setcards < 1){
                $id_setcards = M('ubanks')->where(array('user_id'=>$uid))->limit(1)->find();
            }
            if(empty($id_setcards)){
                ajaxReturn(L('mbdyhk'),0);
            }
            $doDec = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',$allNum);
            $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
            //记录买入会员
            $res_Buy = M('trans')->where(array('id'=>$trid))->setField(array('payout_id'=>$uid,'pay_state'=>1,'card_id'=>$id_setcards['id'],'fee_nums'=>$shouxufei));
            if($res_Buy){//卖出成功
                ajaxReturn(L('mccg'),1);
            }
        }*/
        //ajax 发送完成
        $type = trim(I('type'));
        $uid = session('userid');
        $traInfo = M('trans as tr');
        if($type==0){
            //买入
            $outOrin = 'tr.payin_id';
        }else{
            //卖出
            $outOrin = 'tr.payout_id';
        }

        $whereOrder = array(
            $outOrin => $uid,
            'pay_state' => array('in','0,1,2')
        );
        $orders = $traInfo
            ->join('LEFT JOIN ysk_user as u ON '.$outOrin.'= u.userid')
            ->field('tr.payout_id,tr.payin_id,u.userid,u.username,tr.pay_nums,tr.pay_type,tr.pay_state,tr.id,tr.trans_type')
            ->where($whereOrder)
            ->select();
        $userTabel =D('user') ;
        foreach ($orders as $key => $val){
            $orders[$key]['pay_nums'] = bcadd($val['pay_nums'],0,0);
            if($val['trans_type'] == '1' ){
                $id = $val['payout_id'];
                $arr  = $userTabel->where("userid=$id")->field('username')->find();
                $orders[$key]['username'] = $arr['username'];
            }else{
                $idx = $val['payin_id'];
                $arr  = $userTabel->where("userid=$idx")->field('username')->find();
                $orders[$key]['username'] = $arr['username'];
            }
        }
        $this->assign('userid',$uid);
        $this->assign('orders',$orders);
        $this->display();
    }
    public function  mutualParticulars()
    {
        if(!empty($_GET['ID'])){
            $ID = $_GET['ID'];
            $url = $_GET['test'];
            if($url=="/Index/exehange.html" | $url=="/Index/Exchangerecords.html" ){
                //积分查询页面过来的
                $str = D('userscores_record')->where("id=$ID")->find();
                $userInfoArr = D('user')->where('userid='.$str['deputy_id'])->field('username')->find()['username'];
                $str['deputy_name']=$userInfoArr;
                if(!$str){
                    $this->error('参数错误,请联系管理员','index/index');
                }
            }else if($url=="/Index/Turnout.html" | $url=="/Index/Bancerecord.html" | $url=="/Growth/Introrecords.html"){
                //转账查询页面过来的
                $str = D('usermoney_record')->where("id=$ID")->find();
                $userInfoArr = D('user')->where('userid='.$str['deputy_id'])->field('username')->find()['username'];
                $str['deputy_name']=$userInfoArr;
                if(!$str){
                    $this->error('参数错误,请联系管理员','index/index');
                }
            }else{
                $this->error('系统错误','index/index');
            }
            $this->assign('url',$url);
            $this->assign('record',$str);
            $this->display();
        }else{
            $this->error('系统错误','index/index');
        }


    }
    public function huoqu()
    {
        if(IS_AJAX){
            $id = (int)$_POST['orderid'];
            $trans = D('trans');
            $arr =  $trans->where("id=$id")->find();
            echo $arr['pay_type'];
        }
    }
    /**
     * 判断买入用户有没有默认支付方式
     * 账号是否被禁止买入卖出
     * 账号是否只可以和团队交易
     *
     */
    public function panduanzhifu()
    {
        if(IS_AJAX){
            $uid = session('userid');

            $arr = D('user')->where("userid=$uid")->field('quanxian,team,selltime')->find();
            $saleTime = $arr['selltime']+60*60*24 ;
            if($saleTime>time()){
                ajaxReturn('您今天已经交易过了',0);
            }
            $arrOne = explode('-',$arr['quanxian']);
            $team = explode('-',$arr['team']);
            if(in_array(4,$arrOne)){
                ajaxReturn('您的账号无法进行卖出操作，请联系管理员',0);
            }
            if(in_array(4,$team)){
                ajaxReturn('您的账号无法进行卖出操作，请联系管理员',0);
            }
            $payinId= (int)D('trans')->where("id=".$_POST['orderid'])->find()['payin_id'];
            $IsStatus = (int)D('user')->where("userid=$payinId")->field('is_states')->find()['is_states'];
            $UserIdStatus = (int)D('user')->where("userid=$uid")->field('is_states')->find()['is_states'];
            if($IsStatus != $UserIdStatus){
                ajaxReturn(L('无效交易'),0);
            }
            $arr = explode("-",$this->off()['options']);
            $startTime = strtotime(date("Y-m-d ".$arr[0].":00"));
            $endTime = strtotime(date("Y-m-d ".$arr[1].":00"));
            if(time()<$startTime |  time()>$endTime){
                ajaxReturn(L('bzjysjn'),0);
            }
            $uid = session('userid');
            $orderid = I('orderid');//支付id
            $arr = D('trans')->where("id=$orderid")->find();
            $paySelect = $arr['pay_type'];
            $userColumn = 'userid';
            if($paySelect == 1){
                $payTable = M('ubanks');
                $userColumn = 'user_id';
                $bankDefault = 'is_default';
            }else if($paySelect == 2){
                $payTable = M('alipay');
                $bankDefault = 'alipay_default';
            }else if($paySelect == 3){
                $payTable = M('weichar');
                $bankDefault = 'weichar_default';
            }else{
                $payTable = M('imtoken');
                $bankDefault = 'imtoken_default';
            }
            //获取付款方式下的默认
            $isDefault = $payTable->where([$userColumn=>$uid,$bankDefault=>'1'])->find();
            if(!$isDefault){
                ajaxReturn('没有默认账号',0);
            }
            ajaxReturn('可以支付',1);
        }
    }
    /**
     * 判断买入ajax
     *   $this->error('您的账号无法进行买入操作，请联系管理员','/index/trading_buy.html');
     */
    //创建买单
    public function buy(){
        $uid = session('userid');
        $arr = D('user')->where("userid=$uid")->field('quanxian,team')->find();
        $arrOne = explode('-',$arr['quanxian']);
        $team = explode('-',$arr['team']);
        if(in_array(3,$arrOne)){
            $this->error('您的账号无法进行买入操作，请联系管理员','/index/trading_buy.html');
        }
        if(in_array(3,$team)){
            $this->error('您的账号无法进行买入操作，请联系管理员','/index/trading_buy.html');
        }
        //生成订单
        if(IS_AJAX){

            $pwd = trim(I('password'));
            $sellnums = trim(I('money'));//出售数量
            $paySelect = I('type');//支付id
            $sellAll = array(500,1000,3000,5000,10000,30000);
            if (!in_array($sellnums, $sellAll)) {
                ajaxReturn(L('nxzmrdjebcz'),0);
            }
            $trans = D('trans');
            $arrAy = [
                'payin_id'=>$uid,
                'pay_state'=>['neq',3]
            ];
            $zhi = $trans->where($arrAy)->select();
            if($zhi){
                ajaxReturn('有未完成买入订单',0);
            }
            $Array = [
                'payout_id'=>$uid,
                'pay_state'=>['neq',3]
            ];
            $zhi = $trans->where($Array)->select();
            if($zhi){
                ajaxReturn('有未完成卖出订单',0);
            }
            //判断有没有选择付款方式
            //判断有没有审核通过
            $verifyDate = M("verify_list")->where(array('uid'=>$uid))->order('id desc')->field('type,status')->find();
            if(empty($paySelect)){
                ajaxReturn('未选择支付方式',0);
            }
            //不同默认支付
            $userColumn = 'userid';
            if($paySelect == 1){
                $payTable = M('ubanks');
                $userColumn = 'user_id';
                $bankDefault = 'is_default';
            }else if($paySelect == 2){
                $payTable = M('alipay');
                $bankDefault = 'alipay_default';
            }else if($paySelect == 3){
                $payTable = M('weichar');
                $bankDefault = 'weichar_default';
            }else{
                $payTable = M('imtoken');
                $bankDefault = 'imtoken_default';
            }
            //获取付款方式下的默认
            $isDefault = $payTable->where([$userColumn=>$uid,$bankDefault=>'1'])->find();
            if(!$isDefault){
                ajaxReturn('没有默认账号',$isDefault);
            }
            $cardid = $isDefault['id'];
            //手续费
            if(empty($verifyDate)){
                $lilv = '0.15';
            }else{
                if($verifyDate['status'] ==1 && $verifyDate['type'] == 2){
                    $lilv = '0.10';
                }else{
                    $lilv = '0.15';
                }
            }
            $shouxufei = bcmul($sellnums,$lilv,2);
            $allNum = bcadd($shouxufei,$sellnums,2);
            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
            if($allNum > $is_enough){
                ajaxReturn(L('ndyebz'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //生成订单
            $data['pay_no'] = build_order_no();
            $data['payin_id'] = $uid;
            $data['card_id'] = $cardid;         //对应支付账号id
            $data['pay_nums'] = $sellnums;      //支付金额
            $data['fee_nums'] = $shouxufei;     //手续费
            $data['trans_type'] = 0;            //买入
            $data['pay_time'] = time();          //创建时间
            $data['pay_type'] = $paySelect;    //支付类型
            $res_Add = M('trans')->add($data);

            //添加卖出余额记录 扣余额及100手续费

//                $jifen_nums = $sellnums+100;


            //给自己减少这么多余额
            if($res_Add){
//                $sellnums = $sellnums + 100;
                $doDec = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',$allNum);

                //增加自己的余额记录
                $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
//                //添加余额记录
//                addAccountRecords($uid,0,$shouxufei,23,$pay_n,$type = 'money');
//                //增加自己的余额记录
//                $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
//                //添加余额记录
//                addAccountRecords($uid,0,$sellnums,11,$pay_n,$type = 'money');
//                ajaxReturn(L('ddcjcg'),1);
            }
        }
        $type = I('type');//1为卖出2为买入
        $uid = session('userid');
        $my = M('store')
            ->where(['uid'=>$uid])
            ->find();
        if($type == 1){
            $title = L('sellout');
        }else{
            $title = L('purchase');
        }
        $my['cangku_num'] = bcadd($my['cangku_num'],0,2);
        $my['fengmi_num'] = bcadd($my['fengmi_num'],0,2);
        $this -> assign('my',$my);
        $this -> assign('title',$title);
        $this -> display();
    }

    //买入订单页面
    public function myOrderBuy()
    {
        $userId = intval(session('userid'));
        $transData = $this->selectOrder($userId,'trans');
        $username = D('user')->field('username')->find($userId);

        $this -> assign('transData',$transData);
        $this -> assign('username',$username);
        $this -> display('myOrderBuy');

    }
    //查询买入订单方法
    public function selectOrder($uid,$table)
    {
        $model = D($table);
//        $usrname = D('user')->field('username')->find($uid);
        $arr = $model->where(["payin_id=$uid"])->select();
//        $arr['pay_nums'] = str_replace('.00','',$arr['pay_nums']);
//        $arr['username'] = $usrname['username'];
        return $arr;
    }
    //确认打款界面
    public function confirm_pay()
    {
        $userId = session('userid');
        $tranId = I('get.id');
        $type = I('get.type');
        $userModel = M('user');
        $tranWhere = array(
            'id' => $tranId
        );
        $transData = M('trans')->where($tranWhere)->find();
//        echo M('trans')->getLastSql();
//        $arr = $this->selectOrder($uid,'trans');
//        var_dump($arr);
//        var_dump($transData);
        $transData['pay_nums'] = intval($transData['pay_nums']);
        $this->assign('arr', $transData);
        $userData = $userModel->where("userid=$userId")->find();
        $this->assign('userData', $userData);
        $zhifu = $transData['pay_type'];
        //不同默认支付
        $userColumn = 'userid';
        if ($zhifu == 1) {
            $payTable = M('ubanks');
            $userColumn = 'user_id';
            $bankDefault = 'is_default';
        } else if ($zhifu == 2) {
            $payTable = M('alipay');
            $bankDefault = 'alipay_default';
        } else if ($zhifu == 3) {
            $payTable = M('weichar');
            $bankDefault = 'weichar_default';
        } else {
            $payTable = M('imtoken');
            $bankDefault = 'imtoken_default';
        }
        //获取付款方式下的默认
        if($userId == $transData['payin_id']){
            $userId = $transData['payout_id'];
        }
        //if($userId == $transData['payin_id'] && $transData['trans_type'] == 1){
        //    $userId = $transData['payout_id'];
        //}
        $isDefault = $payTable->where("$userColumn=$userId and $bankDefault='1'")->find();
//        echo $payTable->getLastSql();
        $this->assign('isDefault', $isDefault);
        if ($type == 0 || $type == 1) {
            $this->assign('title', L('qrdk'));
            $this->display('confirm_pay');
        }else{
//            $this->assign('title',L('confirm'));
//            $this -> display('confirmCollection');
            $name = $transData['payin_id'];
            $payInData = $userModel->field('username,mobile')->where("userid=$name")->find();
            $this->assign('payInData',$payInData);
            $this->assign('title',L('confirm'));
            $this -> display('confirmCollection');
        }
    }

    /**
     * 买入订单确认打款ajax
     */
    public function updateOrderbak()
    {
        if($_POST['orderId']){
            $orderId = $_POST['orderid'];
            $orderTable =  D('trans');
            $arr = $orderTable->find($orderId);
            $fileName = $arr['pay_no'];
            $fileName = "./Uploads/orderimgs/$fileName.png";
            if (!$arr){
                ajaxReturn(L('ddbcz'),0);
            }
            if(!$_FILES['classIcon']){
                ajaxReturn(L('qsczzcgtp'),0);
            }
            $state = move_uploaded_file($_FILES['classIcon']['tmp_name'],$fileName);
            if (!$state){
                ajaxReturn(L('jtscsblx'),0);
            }
            $upArr =[
                'pay_state'=>2,
                'trans_img'=>ltrim($fileName,'.')
            ];
            $condition = $orderTable->where('pay_state=1')->where("id=$orderId")->save($upArr);
            if(!$condition){
                ajaxReturn(L('czsb'),0);
            }
            ajaxReturn(L('ydk'),1);
        }else{
            ajaxReturn(L('fwcw'),0);
        }

    }
    /**
     * 买入订单确认打款ajax
     */
    public function updateOrder()
    {
        if($_POST['orderid']){
            $orderId = $_POST['orderid'];
            $orderTable =  D('trans');
            $arr = $orderTable->find($orderId);
            if($arr['pay_state']==2){
                ajaxReturn(L('ydk'),0);
            }else if($arr['pay_state']!=1){
                ajaxReturn(L('gddztbzq'),0);
            }
            $fileName = $arr['pay_no'];
            $fileName = "./Uploads/orderimgs/$fileName.png";
            if (!$arr){
                ajaxReturn(L('ddbcz'),0);
            }
            if(!$_FILES['classIcon']){
                ajaxReturn(L('qsczzcgtp'),0);
            }
            $state = move_uploaded_file($_FILES['classIcon']['tmp_name'],$fileName);
            if (!$state){
                ajaxReturn(L('jtscsblx'),0);
            }
            $upArr =[
                'pay_state'=>2,
                'trans_img'=>ltrim($fileName,'.')
            ];
            $condition = $orderTable->where('pay_state=1')->where("id=$orderId")->save($upArr);
            if(!$condition){
                ajaxReturn(L('czsb'),0);
            }
            ajaxReturn(L('ydk'),1);
        }else{
            ajaxReturn(L('fwcw'),0);
        }

    }

    public function sale(){
        $uid = session('userid');
        $arr = D('user')->where("userid=$uid")->field('quanxian,team')->find();
        $arrOne = explode('-',$arr['quanxian']);
        $team = explode('-',$arr['team']);

        if(in_array(4,$arrOne)){
            $this->error('您的账号无法进行卖出操作，请联系管理员','/index/trading_center.html');
        }
        if(in_array(4,$team)){
            $this->error('您的账号无法进行卖出操作，请联系管理员','/index/trading_center.html');
        }
        //生成订单
        if(IS_AJAX){
            $pwd = trim(I('pwd'));
            $sellnums = trim(I('sellnums'));//出售数量
            //$cardid = trim(I('cardid'));    //对应支付账号
            $paySelect = I('paySelect');    //选择支付方式
            $sellAll = array(500,1000,3000,5000,10000,30000);
            if (!in_array($sellnums, $sellAll)) {
                ajaxReturn(L('nxzmrdjebcz'),0);
            }

            //判断有没有选择付款方式
            //判断有没有审核通过
            $verifyDate = M("verify_list")->where(array('uid'=>$uid))->order('id desc')->field('type,status')->find();
            if(empty($paySelect)){
                ajaxReturn(L('wxzzffs'),0);
            }
            //判断有没有完成的订单
            $trans = D('trans');
            $arrAy = [
                'payin_id'=>$uid,
                'pay_state'=>['neq',3]
            ];
            $Array = [
                'payout_id'=>$uid,
                'pay_state'=>['neq',3]
            ];
            $zhiOne = $trans->where($Array)->select();
            $zhiTwo =$trans->where($arrAy)->select();
            if($zhiOne || $zhiTwo){
                ajaxReturn(L('cldd'),0);
            }
            //不同默认支付
            $userColumn = 'userid';
            if($paySelect == 1){
                $payTable = M('ubanks');
                $userColumn = 'user_id';
                $bankDefault = 'is_default';
            }else if($paySelect == 2){
                $payTable = M('alipay');
                $bankDefault = 'alipay_default';
            }else if($paySelect == 3){
                $payTable = M('weichar');
                $bankDefault = 'weichar_default';
            }else{
                $payTable = M('imtoken');
                $bankDefault = 'imtoken_default';
            }
            //获取付款方式下的默认
            $isDefault = $payTable
                ->where([$userColumn=>$uid,$bankDefault=>'1'])
                ->find();
            if(!$isDefault){
                ajaxReturn(L('mymrskfs'),0);
            }
            $cardid = $isDefault['id'];
            //手续费
            if(empty($verifyDate)){
                $lilv = '0.15';
            }else{
                if($verifyDate['status'] ==1 && $verifyDate['type'] == 2){
                    $lilv = '0.10';
                }else{
                    $lilv = '0.15';
                }
            }
            $shouxufei = bcmul($sellnums,$lilv,2);
            $allNum = bcadd($shouxufei,$sellnums,2);
            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
            if($allNum > $is_enough){
                ajaxReturn(L('ndyebz'),0);
            }
            //验证银行卡是否是自己
            $id_Uid = $payTable->where(array('id'=>$cardid))->getField($userColumn);
//            $payTable -> getLastSql();
//            ajaxReturn($payTable -> getLastSql());
//            echo M('ubanks')->getLastSql();
//            var_dump($id_Uid);
//            var_dump($uid);
            if($id_Uid != $uid){
                ajaxReturn(L('yhkbsnd'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            // $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //生成订单
            $data['pay_no'] = build_order_no();
            $data['payout_id'] = $uid;
            $data['card_id'] = $cardid;         //对应支付账号id
            $data['pay_nums'] = $sellnums;      //支付金额
            $data['fee_nums'] = $shouxufei;     //手续费
            $data['trans_type'] = 1;            //卖出
            $data['pay_time'] = time();
            $data['pay_type'] = $paySelect;
            $res_Add = M('trans')->add($data);

            //添加卖出余额记录 扣余额及100手续费

//                $jifen_nums = $sellnums+100;


            //给自己减少这么多余额
            if($res_Add){
//                $sellnums = $sellnums + 100;
                $doDec = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',$allNum);


                $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                $jifen_dochange['now_nums'] = $pay_n;
                $jifen_dochange['now_nums_get'] = $pay_n;
                $jifen_dochange['is_release'] = 1;
                $jifen_dochange['pay_id'] = $uid;
                $jifen_dochange['get_id'] = 0;
                $jifen_dochange['get_nums'] = $allNum;
                $jifen_dochange['get_time'] = time();
                $jifen_dochange['get_type'] = 9;
                // $res_addres = M('tranmoney')->add($jifen_dochange);


                ajaxReturn(L('ddcjcg'),1);
            }
        }




        $type = I('type');//1为卖出2为买入
        $uid = session('userid');
        $my = M('store')
            ->where(['uid'=>$uid])
            ->find();
        if($type == 1){
            $title = L('sellout');
        }else{
            $title = L('purchase');
        }
        $my['cangku_num'] = bcadd($my['cangku_num'],0,2);
        $my['fengmi_num'] = bcadd($my['fengmi_num'],0,2);
        $this -> assign('my',$my);
        $this -> assign('title',$title);
        $this -> display();
    }
    //
    public function affirmGatheringbak(){
        $order = I('order');
        $trans = M('trans as tr');
        $data = $trans
            ->join('LEFT JOIN ysk_user as u ON tr.payout_id = u.userid')
            -> where(['id'=>$order])
            ->find();

        //dump($traInfo->getLastSql());exit;
        $this->assign('data',$data);
        $this->display();

    }
    public function confirmOrder(){
        $orderId = I('orderId');

        if(!$orderId){
            ajaxReturn(L('qxzqrdd'),0);
        }
        $data['pay_state'] = 3;
        $whereTrans = array(
            'id' => $orderId
        );
        $arr = M('trans')->where($whereTrans)->save($data);
        if($arr){
            ajaxReturn(L('cg'),1,U('Index/historyOrder'));
        }else{
            ajaxReturn(L('czsb'),0);
        }


    }
    public function off()
    {//查询配置表里的数据时间
        return M('config')->where('id=77')->find();
    }
    public function SellCentr(){
        //是否有设置默认银行卡
        $uid = session('userid');
        $arr = D('user')->where("userid=$uid")->field('quanxian,team,selltime')->find();
        $saleTime = $arr['selltime']+60*60*24 ;
        if($saleTime>time()){
            ajaxReturn('您今天已经交易过了',0);
        }
        $cid = trim(I('cid'));
        //判断交易时间
        $arr = explode("-",$this->off()['options']);
        $startTime = strtotime(date("Y-m-d ".$arr[0].":00"));
        $endTime = strtotime(date("Y-m-d ".$arr[1].":00"));

        if(time()<$startTime |  time()>$endTime){
            ajaxReturn(L('bzjysjn'),0);
        }
        if(empty($cid)){
            $mapcas['user_id&is_default'] =array($uid,1,'_multi'=>true);
            $carinfo = M('ubanks')->where($mapcas)->count(1);
            if($carinfo < 1){
                $morecars = M('ubanks as u')->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid' )->where(array('u.user_id'=>$uid))->limit(1)->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')->find();
            }else{
                $morecars = M('ubanks as u')->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid' )->where(array('u.user_id'=>$uid,'is_default'=>1))->limit(1)->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')->find();
            }
        }else{
            $morecars = M('ubanks as u')->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid' )->where(array('u.id'=>$cid))->limit(1)->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')->find();
        }

        //生成出售订单
        if(IS_AJAX){
            $pwd = trim(I('pwd'));
            $sellnums = trim(I('sellnums'));//出售数量
//            $cardid = trim(I('cardid'));//银行卡id
            $sellAll = array(500,1000,3000,5000,10000,30000);
            $paySelect = I('paySelect');    //选择支付方式
            //判断是否有未处理订单==yuan==
            $statusOrder = M('trans')->where(array('pay_state'=>['in',[0,1,2]],'payin_id'=>$uid))->select();
//            echo M('trans')->getLastSql();
            $statusOrder1 = M('trans')->where(array('pay_state'=>['in',[0,1,2]],'payout_id'=>$uid))->select();
//            echo M('trans')->getLastSql();exit;
            if($statusOrder || $statusOrder1){
                ajaxReturn(L('cldd'),0);
            }

            if (!in_array($sellnums, $sellAll)) {
                ajaxReturn(L('nxzmrdjebcz'),0);
            }
            $verifyDate = M("verify_list")->where(array('uid'=>$uid))->order('id desc')->field('type,status')->find();
//            var_dump($verifyDate);
            if(empty($verifyDate)){
                $lilv = '0.15';
            }else{
                if($verifyDate['status'] ==1 && $verifyDate['type'] == 2){
                    $lilv = '0.10';
                }else{
                    $lilv = '0.15';
                }
            }
            $shouxufei = bcmul($sellnums,$lilv,2);
            $allNum = bcadd($shouxufei,$sellnums,2);
            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
            if($allNum > $is_enough){
                ajaxReturn(L('ndyebz'),0);
            }
            //不同默认支付
            $userColumn = 'userid';
            if($paySelect == 1){
                $payTable = M('ubanks');
                $userColumn = 'user_id';
                $bankDefault = 'is_default';
            }else if($paySelect == 2){
                $payTable = M('alipay');
                $bankDefault = 'alipay_default';
            }else if($paySelect == 3){
                $payTable = M('weichar');
                $bankDefault = 'weichar_default';
            }else{
                $payTable = M('imtoken');
                $bankDefault = 'imtoken_default';
            }
            //获取付款方式下的默认
            $isDefault = $payTable
                ->where([$userColumn=>$uid,$bankDefault=>'1'])
                ->find();
            if(!$isDefault){
                //没有默认收款方式
                ajaxReturn(L('mymrskfs'),0);
            }
            $cardid = $isDefault['id'];
            //验证银行卡是否是自己
            $id_Uid = $payTable->where(array('id'=>$cardid))->getField($userColumn);
//            echo $payTable->getLastSql();exit;
            //验证银行卡是否是自己
//            $id_Uid = M('ubanks')->where(array('id'=>$cardid))->getField('user_id');
//            echo M('ubanks')->getLastSql();
//            var_dump($id_Uid);
//            var_dump($uid);//开启事务
//           M()->startTrans();
            if($id_Uid != $uid){
                ajaxReturn(L('系统错误，请联系管理员'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //生成订单

            $data['pay_no'] = build_order_no();//订单编号
            $data['payout_id'] = $uid;//转出会员id
            $data['card_id'] = $cardid;//转入会员id
            $data['pay_nums'] = $sellnums;//转出数量
            $data['fee_nums'] = $shouxufei;//手续费
            $data['trans_type'] = 1;//买入2卖出
            $data['pay_time'] = time();
            $data['pay_type'] = $paySelect;


            //添加卖出余额记录 扣余额及100手续费

//                $jifen_nums = $sellnums+100;


            //给自己减少这么多余额
            //开启事务
            M()->startTrans();
            try{
                $res_Add = M('trans')->add($data);
                if($res_Add){
//                $sellnums = $sellnums + 100;
                    $doDecOne = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',$shouxufei);
                    $pay_nOne = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    //添加余额记录
                    $One = addAccountRecords($uid,0,-$shouxufei,23,$pay_nOne,$type = 'money');
                    $doDecTwo = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',$sellnums);
                    $pay_nTwo = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                    //添加余额记录
                    $Two =addAccountRecords($uid,0,-$sellnums,12,$pay_nTwo,$type = 'money');
                    if($doDecOne && $One && $doDecTwo && $Two){
                        M()->commit();
                        //提交事务
                        ajaxReturn(L('ddcjcg'),1);
                        return;
                    }else{
                        // 回滚事务
                        M()->rollback();
                        ajaxReturn('订单创建失败',0);
                        return;
                    }
                }else{
                    // 回滚事务
                    M()->rollback();
                    ajaxReturn('订单创建失败',0);
                    return;
                }
            }catch (\Exception $e) {
                // 回滚事务
                M()->rollback();
                ajaxReturn('订单创建失败',0);
                return;
            }

        }
        $this->assign('morecars',$morecars);
        $this->display();
    }
//买入创建订单
    public function Purchase(){
        //判断交易时间
        $arr = explode("-",$this->off()['options']);
        $startTime = strtotime(date("Y-m-d ".$arr[0].":00"));
        $endTime = strtotime(date("Y-m-d ".$arr[1].":00"));

        if(time()<$startTime |  time()>$endTime){
            ajaxReturn(L('bzjysjn'),0);
        }
        $uid = session('userid');
        $cid = trim(I('cid'));
        if(empty($cid)){
            $mapcas['user_id&is_default'] = array($uid,1,'_multi'=>true);
            $carinfo = M('ubanks')->where($mapcas)->count(1);
            if($carinfo < 1){
                $morecars = M('ubanks as u')
                    ->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid' )
                    ->where(array('u.user_id'=>$uid))
                    ->limit(1)
                    ->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')
                    ->find();
            }else{
                $morecars = M('ubanks as u')
                    ->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid' )
                    ->where(array('u.user_id'=>$uid,'is_default'=>1))
                    ->limit(1)
                    ->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')
                    ->find();
            }
        }else{
            $morecars = M('ubanks as u')
                ->join('RIGHT JOIN ysk_bank_name as banks ON u.card_id = banks.pid' )
                ->where(array('u.id'=>$cid))
                ->limit(1)
                ->field('u.hold_name,u.id,u.card_number,u.user_id,banks.banq_genre')
                ->find();
        }

        //生成买入订单
        if(IS_AJAX){
            $pwd = trim(I('pwd'));
            $sellnums = trim(I('sellnums'));//出售数量
//            $cardid = trim(I('cardid'));//银行卡id
            //   $messge = trim(I('messge'));//留言
            $paySelect = I('paySelect');//选择支付id
            $sellAll = array(500,1000,3000,5000,10000,30000);

            //判断是否有未处理订单==yuan==
            $statusOrder = M('trans')->where(array('pay_state'=>['in',[0,1,2]],'payin_id'=>$uid,
            ))->select();
            $statusOrder1 = M('trans')->where(array('pay_state'=>['in',[0,1,2]],'payout_id'=>$uid,
            ))->select();
            //dump($statusOrder);exit;
            if($statusOrder || $statusOrder1){
                ajaxReturn(L('cldd'),0);
            }

            if (!in_array($sellnums, $sellAll)) {
                ajaxReturn(L('nxzmrdjebcz'),0);
            }
//            //自己是否有足够余额
            $is_enough = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
            if(100 > $is_enough){
                ajaxReturn(L('ndyebz'),0);
            }
            //不同默认支付
            $userColumn = 'userid';
            if($paySelect == 1){
                $payTable = M('ubanks');
                $userColumn = 'user_id';
                $bankDefault = 'is_default';
            }else if($paySelect == 2){
                $payTable = M('alipay');
                $bankDefault = 'alipay_default';
            }else if($paySelect == 3){
                $payTable = M('weichar');
                $bankDefault = 'weichar_default';
            }else{
                $payTable = M('imtoken');
                $bankDefault = 'imtoken_default';
            }
            //获取付款方式下的默认
            $isDefault = $payTable
                ->where([$userColumn=>$uid,$bankDefault=>'1'])
                ->find();
            if(!$isDefault){
                ajaxReturn(L('mymrskfs'),0);
            }
            $cardid = $isDefault['id'];
            //验证银行卡是否是自己
            $id_Uid = $payTable->where(array('id'=>$cardid))->getField($userColumn);
            //验证银行卡是否是自己
//            $id_Uid = M('ubanks')->where(array('id'=>$cardid))->getField('user_id');
            if($id_Uid != $uid){
                ajaxReturn(L('yhkbsnd'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_info = $user_object->Trans($minepwd['account'], $pwd);
            //生成订单
            $data['pay_no'] = build_order_no();
            $data['payin_id'] = $uid;
            $data['out_card'] = $cardid;
            $data['pay_nums'] = $sellnums;
            $data['pay_type'] = $paySelect;
            //  $data['trade_notes'] = $messge;
            $data['pay_time'] = time();
            $data['trans_type'] = 0;
            //开启事务
            M()->startTrans();
            try{
                $res_Add = M('trans')->add($data);

                if($res_Add){
                  /*  //扣除保证金
                    $doDec = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',100);
                    $cangkuNum = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
                    //添加余额记录
                    $One= addAccountRecords($uid,0,-100,21,$cangkuNum,$type = 'money');
                    if($doDec && $One){
                        //提交订单
                        M()->commit();
                        ajaxReturn(L('mrddcjcg'),1);
                        return;
                    }else{
                        // 回滚事务
                        M()->rollback();
                        ajaxReturn(L('czsb'),0);
                        return;
                    }*/
                    //提交订单
                    M()->commit();
                    ajaxReturn(L('mrddcjcg'),1);
                    return;
                }else{
                    // 回滚事务
                    M()->rollback();
                    ajaxReturn(L('czsb'),0);
                    return;
                }
            }catch (\Exception $e) {
                // 回滚事务
                M()->rollback();
                ajaxReturn(L('czsb'),0);
                return;
            }

        }
        $coindets=array();
        for($i=1;$i<=5;$i++){
            $coindets[]= D('coindets')->where("cid=".$i)->order('coin_addtime desc')->find();

        }
        //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$uid,'cid'=>array("neq",0)))->order('cid asc')->select();
        $this->assign('minecoins',$minecoins);
        $this->assign('coindets',$coindets);
        $moneyinfo = M('store')->where(array('uid' => $uid))->field('cangku_num,fengmi_num')->find();
        $this->assign('moneyinfo', $moneyinfo);
        $this->assign('morecars',$morecars);
        $this->display();

    }

    /**
     * 投诉详情页面
     */
    public function  feedbackInfo()
    {
        $this->display();
    }
    //确认收到款
    public function Con_Getmoney(){
        $trid = I('orderId','intval',0);
        $traninfo = M('trans');
        if($trid < 1){
            ajaxReturn(L('qxzzqddd'),0);
        }
        $order_info = $traninfo->where(array('id'=>$trid))->find();
        if($order_info['pay_state'] != 2){
            ajaxReturn(L('gddztbzq'),0);
        }


        //给用户加余额
        $paynums = $order_info['pay_nums'];
        $datapay['cangku_num'] = array('exp','cangku_num + '.$paynums);
        $res_pay = M('store')->where(array('uid'=>$order_info['payin_id']))->save($datapay);//转入的人+80%
        $pay_n = M('store')->where(array('uid' => $order_info["payin_id"]))->getfield('cangku_num');
        addAccountRecords($order_info['payin_id'],+$order_info['payout_id'],$paynums,11,$pay_n,$type = 'money');
        if($order_info['trans_type'] == 0){
            //退换保证金
            $backnums = 100;
            $backinfo['cangku_num'] = array('exp','cangku_num + '.$backnums);
            $res_back = M('store')->where(array('uid'=>$order_info['payin_id']))->save($backinfo);
            //添加余额记录
            $pay_n = M('store')->where(array('uid' => $order_info["payin_id"]))->getfield('cangku_num');
//            $pay_ns = M('store')->where(array('uid' => $order_info["payout_id"]))->getfield('cangku_num');
//            addAccountRecords($order_info['payout_id'],$order_info['payin_id'],$paynums,12,$pay_ns,$type = 'money');
            addAccountRecords($order_info['payin_id'],+$order_info['payout_id'],$backnums,22,$pay_n,$type = 'money');
        }
        //退换保证金
//        $backnums = $order_info['fee_nums'];
//        $backinfo['cangku_num'] = array('exp','cangku_num + '.$backnums);
//        $res_back = M('store')->where(array('uid'=>$order_info['payout_id']))->save($backinfo);//转出的人退手续费

        $tramsg['pay_state'] = 3;
        $tramsg['get_moneytime'] = time();
        $res_suc = $traninfo->where(array('id'=>$trid))->save($tramsg);



        if($res_suc && $res_pay){
            //添加释放记录
            userAward($order_info['payin_id'],'zhitui',1,$paynums);
            //直推释放（一级），加一条余额记录
            ajaxReturn(L('qrskcg'),1);
        }else{
            ajaxReturn(L('qrsksb'),0);
        }
    }
    //取消订单
    public function quxiao_order(){

        $id = (int)I('id','intval',0);
        $uid = session('userid');
        $mydeal = M('trans')->where(array("id"=>$id,"payin_id|payout_id"=>$uid,"pay_state"=>array("lt",2)))->find();

        if(!$mydeal)ajaxReturn(L('ddbcz'),0);

        $type=$mydeal["trans_type"];
        M('trans_quxiao')->add($mydeal);//把记录复制到另一个表


        if($type==1){//卖出单，删除订单


            //var_dump($res1);die;

            $res1 = M('trans')->delete($id);


            if($res1){
                $sellnums = $mydeal["pay_nums"];
                $shouxufei = $mydeal["fee_nums"];
                $allNum = bcadd($shouxufei,$sellnums,2);
                $doDec = M('store')->where(array('uid'=>$uid))->setInc('cangku_num',$sellnums);
                //增加自己的余额记录
                $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                //添加余额记录
                addAccountRecords($uid,0,+$sellnums,12,$pay_n,$type = 'money');
                $doDec = M('store')->where(array('uid'=>$uid))->setInc('cangku_num',$shouxufei);
                //增加自己的余额记录
                $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
                //添加余额记录
                addAccountRecords($uid,0,+$shouxufei,24,$pay_n,$type = 'money');

            }



        }elseif($type==0){//为购买单，自己是卖出方，清空payout_id和改变pay_state为0并返回全部余额
            $sellnums = $mydeal["pay_nums"];
            $shouxufei = $mydeal["fee_nums"];
            $allNum = bcadd($shouxufei,$sellnums,2);

            $doDec = M('store')->where(array('uid'=>$uid))->setInc('cangku_num',$allNum);

            //增加自己的余额记录

            $pay_n = M('store')->where(array('uid' => $uid))->getfield('cangku_num');
            //添加余额记录
            addAccountRecords($uid,0,+$sellnums,12,$pay_n,$type = 'money');
            $payout['payout_id'] =0;
            $payout['pay_state'] =0;
            $res1 = M('trans')->where(array('id'=>$id))->save($payout);


        }

        if($res1){
            ajaxReturn(L('qxcg'),1);
        }else{
            ajaxReturn(L('czsb'),1);
        }
    }
}
