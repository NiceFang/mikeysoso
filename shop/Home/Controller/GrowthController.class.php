<?php
namespace Home\Controller;
use Think\Controller;
class GrowthController extends CommonController {


     //===========采蜜记录===============
    public function StealDeatail(){
        if(!IS_AJAX){
            return false;
        }
        $userid=session('userid');
        $m=M('steal_detail');
        $where['uid']=$userid;

        $p = I('p','0','intval');
        $page=$p*10;
        $arr=$m->field("num s_num,username uname,type_name,FROM_UNIXTIME(create_time,'%Y-%m-%d %H:%i') as tt ")->where($where)->order('id desc')->limit(
            $page,10)->select();
       if(empty($arr)){
               $arr=null; 
        }
        $this->ajaxReturn($arr);
    }

//    转入
    public function Intro(){
        $time = time();
        $userid = session('userid');
        $uinfo = M('user')->where(array('userid' => $userid))->find();
        $arr = D('user')->where("userid=$userid")->field('quanxian,team')->find();
        $arrOne = explode('-',$arr['quanxian']);
        $team = explode('-',$arr['team']);

        if(in_array(1,$arrOne)){
            $this->error('您的账号无法进行转入操作，请联系管理员','/Index/index.html');
        }
        if(in_array(1,$team)){
            $this->error('您的账号无法进行转入操作，请联系管理员','/Index/index.html');
        }
		$u_ID = $userid;
		$drpath = './Uploads/Rcode';
		$imgma = 'codes' . $userid . '.png';

		$urel = '/Uploads/Rcode/' . $imgma;
		if (!file_exists($drpath . '/' . $imgma)) {
            sp_dir_create($drpath);
            vendor("phpqrcode.phpqrcode");
            $phpqrcode = new \QRcode();
            $hurl = "http://{$_SERVER['HTTP_HOST']}" . U('Index/Changeout/sid/' . $u_ID);

           // $hurl = "http://www.huiyunx.com" . U('Index/Changeout/sid/' . $u_ID);
            $size = "7";
            //$size = "10.10";
            $errorLevel = "L";
            $phpqrcode->png($hurl, $drpath . '/' . $imgma, $errorLevel, $size);
        }

		$this->urel = $urel;
		$moneyinfo = M('store')->where("uid=$userid")->find();
        $moneyinfo['cangku_num'] = bcadd($moneyinfo['cangku_num'],0,2);
        $moneyinfo['fengmi_num'] = bcadd($moneyinfo['fengmi_num'],0,2);
		$coindets=array();
		for($i=1;$i<=5;$i++){
			$coindets[]= D('coindets')->where("cid=".$i)->order('coin_addtime desc')->find();
		}
        $level = $this->userLevel[$uinfo['use_grade']];

        $uinfo['use_grade_name'] = L($level);
      //当前我的资产
        $minecoins = M('ucoins')->where(array('c_uid'=>$userid,'cid'=>array("neq",0)))->order('cid asc')->select();
        $this->assign('minecoins',$minecoins);
        $this->assign('urel',$urel);
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
            $name =1;
        }else{
            $name=0;
        }
        $this->assign('name',$name);
		$this->assign('coindets',$coindets);
		$this->assign('moneyinfo', $moneyinfo);
      	$this->assign('uinfo',$uinfo);

        $this->display();
    }
    //修改默认银行卡
    public function updateBank()
    {
        if(IS_AJAX){
            if(!empty($_POST['Id'])){
                $bankId = $_POST['Id'];
                $uid = session("userid");
                $saveArrOne = [
                    'is_default'=>0
                ];
                $status = M('ubanks')->where(["is_default=1 and user_id=$uid"])->save($saveArrOne);
                $saveArr = [
                    'is_default'=>1
                ];
                  $ubanksUpdate =  M('ubanks')->where(["id=$bankId"])->save($saveArr);
                  if($ubanksUpdate){
                      ajaxReturn("修改成功",1);
                  }else{
                      ajaxReturn("修改默认银行卡失败,请联系管理员",0);
                  }

            }
        }
    }
    //转入明细
    public function Introrecords()
    {
        $uid = session('userid');
//        dump($uid);exit;

        $arr = [
            'master_id'=>$uid,
            'get_type'=>3
        ];
        $Model = M('usermoney_record ur');
        $Chan_info = $Model
            ->join('ysk_user u ON ur.deputy_id= u.userid')
            ->field('u.username,ur.id,ur.deputy_id,ur.get_nums,ur.get_time,u.img_head')
            ->where($arr)
            ->order('id desc')
            ->select();
        foreach ($Chan_info as $key=>$val){
            $filesize = @getimagesize("./Public/home/wap/heads/".$val['img_head']);
            if(!$filesize){
                $Chan_info[$key]['img_head']='toux-icon.png';
            }
        }

        $this->assign('Chan_info',$Chan_info);
        $this->display();


    }


    //取消订单
    public function quxiao_order(){

        $id = (int)I('id','intval',0);
        $uid = session('userid');
        $mydeal = M('trans')->where(array("id"=>$id,"payin_id|payout_id"=>$uid,"pay_state"=>array("lt",2)))->find();
        if(!$mydeal)ajaxReturn(L('ddbcz'),0);
        $type=$mydeal["trans_type"];
        M()->startTrans();//开启事务
        try{
            $arr = M('trans_quxiao')->add($mydeal);//把记录复制到另一个表
            if(!$arr){
                M()->rollback();
                ajaxReturn(L('czsb'),0);
                return;
            }
            if($type==1){//卖出单，自己是购买方，只清空payin_id和改变pay_state为0
                $payout['payin_id'] =0;
                $payout['pay_state'] =0;
                $res1 = M('trans')->where(array('id'=>$id))->save($payout);
                if(!$res1){
                    M()->rollback();
                    ajaxReturn(L('czsb'),0);
                    return;
                }
                M()->commit();
                ajaxReturn(L('qxcg'),1);
                return;
            }elseif($type==0){
                //为购买单，删除订单
                if(!empty($mydeal['payout_id'])){
                    $sellnums = $mydeal["pay_nums"];
                    $shouxufei = $mydeal["fee_nums"];
                    $allNum = bcadd($shouxufei,$sellnums,2);
                    $uidSale = $mydeal['payout_id'];
                    $doDec = M('store')->where(array('uid'=>$uidSale))->setInc('cangku_num',$allNum);
                    //增加卖出方的余额记录
                    $pay_nOne = M('store')->where(array('uid' => $uidSale))->getfield('cangku_num');
                    $One = addAccountRecords($mydeal['payout_id'],0,$mydeal['pay_nums'],13,$pay_nOne,$type = 'money');
                    $pay_nTwo = M('store')->where(array('uid' => $uidSale))->getfield('cangku_num');
                    $Two = addAccountRecords($mydeal['payout_id'],0,$shouxufei,24,$pay_nTwo,$type = 'money');
                    if(!$doDec ||  !$pay_nOne || !$pay_nTwo || !$One || !$Two){
                        // 回滚事务
                        M()->rollback();
                        ajaxReturn(L('czsb'),0);
                        return;
                    }
                }
                $res1 = M('trans')->delete($id);
                if($res1){
                    //提交事务
                    M()->commit();
                    ajaxReturn(L('qxcg'),1);
                    return;
                }else{
                    // 回滚事务
                    M()->rollback();
                    ajaxReturn(L('czsb'),0);
                    return;
                }
            }
        } catch (\Exception $e) {
            // 回滚事务
            M()->rollback();
            ajaxReturn(L('czsb'),0);
        }
    }


    //买入
    public function Purchase(){

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
            $cardid = trim(I('cardid'));//银行卡id
            $messge = trim(I('messge'));//留言
            $sellAll = array(500,1000,3000,5000,10000,30000);

            //判断是否有未处理订单==yuan==
            $statusOrder = M('trans')->where(array('pay_state'=>['in',['0,1,2']],'payin_id'=>$uid,
            ))->select();
            $statusOrder1 = M('trans')->where(array('pay_state'=>['in',['0,1,2']],'payout_id'=>$uid,
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
            //验证银行卡是否是自己
            $id_Uid = M('ubanks')->where(array('id'=>$cardid))->getField('user_id');
            if($id_Uid != $uid){
                ajaxReturn(L('yhkbsnd'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))->Field('account,mobile,safety_pwd,safety_salt')->find();
            $user_object = D('Home/User');
            $user_object->Trans($minepwd['account'], $pwd);
            //生成订单
            $data['pay_no'] = build_order_no();
            $data['payin_id'] = $uid;
            $data['out_card'] = $cardid;
            $data['pay_nums'] = $sellnums;
            $data['trade_notes'] = $messge;
            $data['pay_time'] = time();
            $data['trans_type'] = 0;
            $res_Add = M('trans')->add($data);
            //给自己减少这么多余额
            if($res_Add){
                $doDec = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',100);
                $cangkuNum = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
                //添加余额记录
                addAccountRecords($uid,0,-100,21,$cangkuNum,$type = 'money');
                ajaxReturn(L('mrddcjcg'),1);
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

    //添加银行卡
    public function test1(){
        $sellnums = array(500,1000,3000,5000,10000,30000);
        $sellnums = 5000;//出售数量
        $sellAll = array(500,1000,3000,'5000',10000,30000);
        if (!in_array(500, $sellAll)) {
            echo "Got Irix";
        }
    }
    /**
     *
     */
    public function Addbank(){
        $bakinfo = M('bank_name')->order('q_id asc')->select();
        $this->assign('bakinfo',$bakinfo);
        $this->display();
    }
    public function  addBanks()
    {
        if(IS_AJAX){
            $uid = session('userid');
            $crkxm = I('crkxm');
            $khy = I('khy');
            $yhk = I('yhk');
            $khzy = I('khzy');
            if(empty($crkxm)){
                ajaxReturn(L('qsrzsxm'),0);
            }
            if(empty($khy)){

                ajaxReturn(L('addcard3'),0);
            }
            if(empty($yhk)){
                ajaxReturn(L('qsryhkh'),0);
            }
            if(empty($khzy)){
                ajaxReturn(L('qsrkhzh'),0);
            }

            $bank =$_POST['khy'];
            $bankId =D('bank_name')->where("banq_genre="."'".$bank."'")->field("q_id")->find()['q_id'];
            if(!$bankId){
                ajaxReturn("您选择的银行卡有误,请重新选择",0);
            }
            $moren  = 0;
            if ($_POST['c_on']==1){
                $moren = 1;
                $shuzu = [
                  'is_default'  => '0',
                ];
                M('ubanks')->where("is_default=$moren and user_id=$uid")->save($shuzu);
            }
            $arr = [
                'hold_name'=>$crkxm,
                'card_id'=>$bankId,
                'card_number'=>$yhk,
                'open_card'=>$khzy,
                'add_time'=>time(),
                'is_default'=>$moren,
                'user_id'=>$uid
            ];

            $res_addcard = M('ubanks')->add($arr);
            if($res_addcard){
                //设置用户银行卡姓名
                $bank_uname = M('user')->where(array('userid'=>$uid))->getField('bank_uname');
                if(empty($bank_uname)){
                    M('user')->where(array('userid'=>$uid))->setField('bank_uname',$crkxm);
                }
                ajaxReturn(L('yhktjcg'),1,'/Growth/Cardinfos');
            }
        }
    }
    //订单中心
    public function Nofinsh(){
        $state = trim(I('state'));
        $uid = session('userid');
        $traInfo = M('trans');
        if($state > 0){
            $where['pay_state'] =  array('between','1,2');
        }else{
            $where['pay_state'] = 0;
        }
        $where['payin_id'] = $uid;

        //分页
        $p=getpage($traInfo,$where,20);
        $page=$p->show();
        $orders = $traInfo->where($where)->order('id desc')->select();
        $banks = M('ubanks');
        foreach($orders as $k =>$v){
            if($v['payin_id'] != ''){
                //银行卡号.开户支行.开户银行
                $bankinfos = $banks ->where(array('id'=>$v['card_id']))->field('hold_name,card_number,card_id,open_card')->find();
                $uinfomsg = M('user')->where(array('userid'=>$v['payout_id']))->Field('username,mobile')->find();
                $orders[$k]['cardnum'] = $bankinfos['card_number'];
                $orders[$k]['bname'] = M('bank_name')->where(array('q_id'=>$bankinfos['card_id']))->getfield('banq_genre');
                $orders[$k]['openrds'] = $bankinfos['open_card'];
                $orders[$k]['uname'] = $uinfomsg['username'];
                $orders[$k]['umobile'] = $uinfomsg['mobile'];

            }
        }
        $this->assign('state',$state);
        $this->assign('orders',$orders);
        $this->assign('page',$page);
        $this->display();
    }
    //确认打款
    public function Conpay(){
        //查询我买入的
        $uid = session('userid');
        $traInfo = M('trans');
        $banks = M('ubanks');
        $where['payin_id'] = $uid;
        $where['pay_state'] = 1;
        //分页
        $p=getpage($traInfo,$where,20);
        $page=$p->show();
        $orders = $traInfo->where($where)->order('id desc')->select();
        //收款人
        foreach($orders as $k =>$v){
            //银行卡号.开户支行.开户银行
            $bankinfos = $banks ->where(array('id'=>$v['card_id']))->field('hold_name,card_number,card_id,open_card')->find();
            $uinfomsg = M('user')->where(array('userid'=>$v['payout_id']))->Field('username,mobile')->find();
            $orders[$k]['cardnum'] = $bankinfos['card_number'];
            $orders[$k]['bname'] = M('bank_name')->where(array('q_id'=>$bankinfos['card_id']))->getfield('banq_genre');
            $orders[$k]['openrds'] = $bankinfos['open_card'];
            $orders[$k]['uname'] = $bankinfos['hold_name'];
            $orders[$k]['umobile'] = $uinfomsg['mobile'];
        }
        if(IS_AJAX){
            $uid = session('userid');
            $picname = $_FILES['uploadfile']['name'];
            $picsize = $_FILES['uploadfile']['size'];
            $trid = trim(I('trid'));
            $pay_type = I('pay_type');

            if($trid <= 0){
                ajaxReturn(L('tjsbcxd'),0);
            }
            if ($picname != "") {
                if ($picsize > 2014000) { //限制上传大小
                    ajaxReturn(L('tpdxbncg'),0);
                }
                $type = strstr($picname, '.'); //限制上传格式
                if ($type != ".gif" && $type != ".jpg" && $type != ".png"  && $type != ".jpeg") {
                    ajaxReturn(L('tpgsbd'),0);
                }
                $rand = rand(100, 999);
                $pics = uniqid() . $type; //命名图片名称
                //上传路径
                $pic_path = "./Uploads/Payvos/". $pics;
                move_uploaded_file($_FILES['uploadfile']['tmp_name'], $pic_path);
            }
            $size = round($picsize/1024,2); //转换成kb
            $pic_path = trim($pic_path,'.');
            if($size){
                $res = M('trans')->where(array('id'=>$trid))->setField(array('trans_img'=>$pic_path,'pay_state'=>2,'pay_type'=>$pay_type));
                if($res){
                    ajaxReturn(L('dktjcg'),1,'/Growth/Conpay');
                }else{
                    ajaxReturn(L('dktjsb'),0);
                }
            }
        }
//        layout(false);
        $this->assign('page',$page);
        $this->assign('orders',$orders);
        $this->display();
    }

    public function Paidimg(){
        $id = I('id');
        $imginfo = M('trans')->where(array('id'=>$id))->getField('trans_img');
        $this->assign('imginfo',$imginfo);

        $this->display();
    }

    //已完成订单
    public function Dofinsh(){
        //查询我买入的
        $uid = session('userid');
        $traInfo = M('trans');
        $banks = M('ubanks');
        $where['payin_id'] = $uid;
        $where['pay_state'] = 3;
        //分页
        $p=getpage($traInfo,$where,20);
        $page=$p->show();
        $orders = $traInfo->where($where)->order('id desc')->select();
        //收款人
        foreach($orders as $k =>$v){
            //银行卡号.开户支行.开户银行
            $bankinfos = $banks ->where(array('id'=>$v['card_id']))->field('hold_name,card_number,card_id,open_card')->find();
            $uinfomsg = M('user')->where(array('userid'=>$v['payout_id']))->Field('username,mobile')->find();
            $orders[$k]['cardnum'] = $bankinfos['card_number'];
            $orders[$k]['bname'] = M('bank_name')->where(array('q_id'=>$bankinfos['card_id']))->getfield('banq_genre');
            $orders[$k]['openrds'] = $bankinfos['open_card'];
            $orders[$k]['uname'] = $uinfomsg['username'];
            $orders[$k]['umobile'] = $uinfomsg['mobile'];
        }
        $this->assign('page',$page);
        $this->assign('orders',$orders);
        $this->display();
    }
    //判断是否处于交易时间
    public function jsajax()
    {
        if(!empty($_POST) && $_POST['ac']=='create'){
           $arr = D('config')->where('id=77')->find();
            $arrone = explode("-",$arr['options']);
            $time = date('H:i',time());
            if ($time>$arrone[0] && $time<$arrone[1]) {
               echo "1";
            }else{
               echo "0";
            }
            
        }
    }
    //买入记录
    public function Buyrecords(){
        $traInfo = M('trans');
        $uid = session('userid');
        $where['payin_id'] = $uid;
        //分页
        $p=getpage($traInfo,$where,20);
        $page=$p->show();
        $Chan_info = $traInfo->where($where)->order('id desc')->select();
        foreach ($Chan_info as $k =>$v){
            $Chan_info[$k]['username'] = M('user')->where(array('userid'=>$v['payout_id']))->getField('username');
            $Chan_info[$k]['get_timeymd'] = date('Y-m-d',$v['pay_time']);
            $Chan_info[$k]['get_timedate'] = date('H:i:s',$v['pay_time']);
        }
        if(IS_AJAX){
            if(count($Chan_info) >= 1) {
                ajaxReturn($Chan_info,1);
            }else{
                ajaxReturn(L('zwjl1'),0);
            }
        }
        $this->assign('page',$page);
        $this->assign('Chan_info',$Chan_info);
        $this->assign('uid',$uid);
        $this->display();
    }


//卖入中心
    public function Buycenter(){
        if(IS_AJAX){
            $pricenum = I('mvalue');
            if($pricenum == ''){
                ajaxReturn(L('qxzzqdddjg'),0);
            }
            $order_info = M('trans as tr')
                ->join('LEFT JOIN  ysk_user as us on tr.payout_id = us.userid')
                ->where(array('tr.pay_state'=>0,'tr.trans_type'=>1,'tr.pay_nums'=>$pricenum,'tr.payout_id'=>array('gt',0)))
                ->order('id desc')
                ->select();
            foreach($order_info as $k => $v){
                $order_info[$k]['cardinfo'] = M('bank_name bn')
                    ->join('LEFT join ysk_ubanks as ub on bn.q_id = ub.card_id')
                    ->where(array('ub.id'=>$v['card_id']))
                    ->getfield('banq_genre');
//                $order_info[$k]['spay'] = $v['pay_nums'] * 0.85;
            }
            if(count($order_info) <= 0){
                ajaxReturn(L('mzdxgjl'),0);
            }else{
                ajaxReturn($order_info,1);
            }
        }
        $this->display();
    }
    public function off()
    {//查询配置表里的数据时间
        return M('config')->where('id=77')->find();
    }

    public function Dopurs(){
        if(IS_AJAX){
            $uid = session('userid');
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
            $arr = D('user')->where("userid=$uid")->field('quanxian,team')->find();
            $arrOne = explode('-',$arr['quanxian']);
            $team = explode('-',$arr['team']);
            if(in_array(3,$arrOne)){
                ajaxReturn('您的账号无法进行买入操作，请联系管理员',0);
            }
            if(in_array(3,$team)){
                ajaxReturn('您的账号无法进行买入操作，请联系管理员',0);
            }
            $PaYouId= (int)D('trans')->where("id=".$_POST['trid'])->find()['payout_id'];
            $IsStatus = (int)D('user')->where("userid=$PaYouId")->field('is_states')->find()['is_states'];
            $UserIdStatus = (int)D('user')->where("userid=$uid")->field('is_states')->find()['is_states'];
            if($IsStatus != $UserIdStatus){
                ajaxReturn(L('无效交易'),0);
            }
            //判断是否支持团队内转账
            $date = D('user')->where("userid=$uid")->field('team')->find();//查询买入用户的team
            $date = explode('-',$date['team']);//分割成数组
            $take = D('user')->where("userid=$IsStatus")->field('team')->find();//查询卖出用户的team
            $take = explode('-',$take['team']);//分割成数组
            $where['path'] = ['like',"%".$uid."%"];//查询卖出用户的团队
            $IsStatesUserIdArr =  D('user')->where($where)->field('userid')->select();
            $userIdArr = array_column($IsStatesUserIdArr,'userid');//查询团队内的所有用户的子id
            if(in_array($IsStatus,$userIdArr) && in_array(3,$date)){
                //判断他们是一个团队的 且  自己本身在对团队卖出的team字段是否被禁止
                ajaxReturn('您的账号无法买入团队人的订单，请联系管理员',0);
            }else if(in_array($IsStatus,$userIdArr)  &&  in_array(3,$take)){
                ajaxReturn('对方账户无法接受团队人的买入，请联系管理员',0);
            }

            $trid = I('trid',1,'intval');
            $pwd = trim(I('pwd'));
            $sellnums = M('trans')->where(array('id'=>$trid))->field('pay_nums,payout_id,pay_state')->find();
            $arr = explode("-",$this->off()['options']);
            $startTime = strtotime(date("Y-m-d ".$arr[0].":00"));
            $endTime = strtotime(date("Y-m-d ".$arr[1].":00"));
            if(time()<$startTime |  time()>$endTime){
              //  ajaxReturn(L('不在交易时间内'),0);
                ajaxReturn(L('bzjysjn'),0);
            }
            $sellAll = array(500,1000,3000,5000,10000,30000);
            if (!in_array($sellnums['pay_nums'], $sellAll)) {
                ajaxReturn(L('nxzgmdjebzq'),0);
            }
            if($sellnums['payout_id'] == $uid){
                ajaxReturn(L('nbnmrzjsjdo'),0);
            }
            if($sellnums['pay_state'] != 0){
                ajaxReturn(L('gddczyc'),0);
            }
            //验证交易密码
            $minepwd = M('user')->where(array('userid'=>$uid))
                ->Field('account,mobile,safety_pwd,safety_salt')
                ->find();
            $user_object = D('Home/User');
            $user_object->Trans($minepwd['account'], $pwd);
            //记录买入会员
            M()->startTrans();//开启事务
            try{
                //修改订单状态
                $res_Buy = M('trans')->where(array('id'=>$trid))->setField(array('payin_id'=>$uid,'pay_state'=>1));
                if($res_Buy){
                   /* //扣除一百保证金
                    $doDec = M('store')->where(array('uid'=>$uid))->setDec('cangku_num',100);
                    $cangkuNum = M('store')->where(array('uid'=>$uid))->getField('cangku_num');
                    //添加余额记录
                    $arr = addAccountRecords($uid,0,-100,21,$cangkuNum,$type = 'money');
                    if($doDec && $arr){
                        //提交事务
                        M()->commit();
                        ajaxReturn(L('mrcg'),1);
                        return;
                    }
                    // 回滚事务
                    M()->rollback();
                    ajaxReturn('买入失败',0);
                    return;*/
                    //提交事务
                    M()->commit();
                    ajaxReturn(L('mrcg'),1);
                    return;
                  //  $Id = D('trans')->where(array('id'=>$trid))->find();
                  //  $url = $_SERVER['SERVER_NAME'].":8082?type=publish&content=您的余额已被认购，请收到转款后及时确认，否则将会影响你的信誉度。&to=".$Id['payout_id'];
                   // $this->carriedApi($url);
                }else{
                    // 回滚事务
                    M()->rollback();
                    ajaxReturn('买入失败',0);
                    return;
                }

            }catch (\Exception $e) {
                // 回滚事务
                M()->rollback();
                ajaxReturn('买入失败',0);
                return;
            }
        }
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
    //银行卡信息
    public function Cardinfos(){
        $uid = (int)session('userid');

        $controller = I('clco');
        $action = I('funact');
       $morecars = M('ubanks as a')->where("a.user_id=$uid")->join("ysk_bank_name as b on a.card_id=b.q_id")->order("a.is_default desc")->select();


        //删除
        if(IS_AJAX){
            $cardid = I('bangid');
            //是否是自己绑定的银行卡
            $isuid = M('ubanks')->where(array('id'=>$cardid))->getField('user_id');
            if($isuid != $uid){
                ajaxReturn(L('gzyhkzsbsyn'),0);
            }
            $res = M('ubanks')->where(array('id'=>$cardid))->delete();
            if($res){
                ajaxReturn(L('gzhksccg'),1,'/User/Personal');
            }
        }
//var_dump($_GET);
//        var_dump($controller);
//        var_dump($action);
        $actions = '';
        $url = '';
        if(!empty($controller) && !empty($action)){
            $actions = $controller.'/'.$action;
            $url = $actions;
//            $url = U($actions);
        }
//        var_dump($actions);
        $this->assign('morecars',$morecars);
        $this->assign('actionUrl',$url);
        $this->display();
    }
      public function test(){
        //获取要下载的文件名
        $filename = $_GET['filename'];
        $file = substr($filename,0,16);
       	$png = substr($filename,-3);
        if($png == 'png' && ($file=='./Uploads/Scode/' || $file=='./Uploads/Rcode/')){
                //设置头信息
        ob_end_clean();
//        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//        header('Content-Description: File Transfer');
//        header('Content-Type: application/octet-stream');

//        header('Content-Disposition:attachment;filename=' . basename($filename));
//        header('Content-Length:' . filesize($filename));

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($filename));
        header('Content-Disposition: attachment; filename=' . basename($filename));

        //读取文件并写入到输出缓冲
        readfile($filename);
        echo "<script>alert('下载成功')</script>";
        }else{
          echo "<script>alert('非法操作')</script>";
        }

    }
}