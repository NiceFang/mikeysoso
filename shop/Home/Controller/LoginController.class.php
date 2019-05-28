<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller
{
    /**
     * 后台登陆
     */
    public function login()
    {
        //判断网站是否关闭
        $close=is_close_site();

        if($close['value']==0){
            $this->assign('message',$close['tip'])->display('closesite');
        }else{
            //$this->assign('lang',$lang);
           /* $lang =cookie('think_language');
            if(empty($lang)){
                $this->display('Login/login/l/en-us');
            }else{
                $this->display('Login/login/l/'.$lang);
            }*/
            $this->display('Login/login');

        }
    }

    public function msglogin()
    {
        //判断网站是否关闭
        $close=is_close_site();
        if($close['value']==0){
            $this->assign('message',$close['tip'])->display('closesite');
        }else{
            $account = session('account');
            $this->assign('account',$account);

            $this->display();
        }
    }

    public function wshm(){
        $userid = I("uid");
        session("userid",$userid);

    }



    //注册好友
    public function register(){

        if(IS_AJAX){
            //接收数据
            $user=D('User');

            $data        = $user->create();
            if(!$data){
                ajaxReturn(L($user->getError()),0);
                return ;
            }
            $imgCode = I('verify');
            check_verify($imgCode);
//            check_add($imgCode);
            //dump(11);
            //验证码
            $code = I('code');
            $mobile = I('mobile');
            $isEmail = true;
            //$mobile = '1587229752@qq.com';
            //验证邮箱
            $checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
            if(preg_match($checkmail,$mobile)){
                if(!check_mail($code,$mobile)){
                    $set_code = session('EmailCode');
                   ajaxReturn(L('yzmcwhygq'));
                }
            }else{
                if(!check_sms($code,$mobile)){
                   ajaxReturn(L('yzmcwhygq'));
                }
                 $isEmail = false;
            }


            //判断仓库
            $store=D('Store');
            if($isEmail){
                unset($data['mobile']);
                $data['mobile']='';
                $data['email'] = $mobile;
                $result = $user->where(['email'=>$mobile])->find();
                if($result){
                    ajaxReturn(L('yxbncf'),0);
                }

            }else{
                //ajaxReturn(1232);
                $data['mobile']  = $mobile;
            }
            $data['account']= $mobile;
            //密码加密
            $salt= substr(md5(time()),0,3);
            $data['login_pwd']=$user->pwdMd5($data['login_pwd'],$salt);
            $data['login_salt']=$salt;


            $data['safety_pwd']=$user->pwdMd5($data['safety_pwd'],$salt);
            $data['safety_salt']=$salt;

            //推荐人
            $pid=$data['pid'];
            $last['userid|mobile|email'] = $pid;
         /*   $name = D('user')->where($last)->find();
            var_dump($name);
            exit;*/
        //    $p_info=$user->where(array('userid'=>$pid))->field('userid,pid,gid,username,account,mobile,email,path,deep')->find();
            $p_info=$user->where($last)->field('userid,pid,gid,username,account,mobile,email,path,deep,recommend,team,is_states')->find();
            if($p_info['recommend']==0){
                ajaxReturn(L('tjrwx'),0);
            }
            $data['is_states'] = $p_info['is_states'];
            $data['team'] = $p_info['team'];
            $data['img_head']='toux-icon.png';
//            $p_info=$user->field('pid,gid,username,account,mobile,path,deep')->find($pid);
            $gid=$p_info['pid'];//上上级ID
            $ggid=$p_info['gid'];//上上上级ID

            if($gid){
                $data['gid']=$gid;
            }
            if($ggid){
                $data['ggid']=$ggid;
            }

            //拼接路径
            $path=$p_info['path'];
            $deep=$p_info['deep'];
            if(empty($path)){
                $data['path']='-'.$pid.'-';
            }else{
                $data['path']=$path.$pid.'-';
            }
            $data['deep']=$deep+1;

            $user->startTrans();//开启事务



            $uid=$user->add($data);

            if(!$uid){
                $user->rollback();
                ajaxReturn(L('zcsb'));
            }

            //给上级添加值推人数
            M('user_level')->where(array('uid'=>$pid))->setInc('children_num',1);


        $jifens= D('config')->where("name='jifens'")->getField("value");
        $jifens= (float)$jifens;
        $rens= D('config')->where("name='rens'")->getField("value");
        $pid_n=M('user')->where(array('pid'=>$pid))->count(1);


        if($pid_n<=$rens && $jifens>0){
                $datapay22['fengmi_num'] = array('exp', 'fengmi_num + ' . $jifens);
                $res_pay_get = M('store')->where(array('uid' => $pid))->save($datapay22);//推荐一人增加
                $get_n = M('store')->where(array('uid' => $pid))->getfield('fengmi_num');
                //添加积分记录
                $arr = addAccountRecords($pid,0,$jifens,5,$get_n,$type = 'scores');
                if(!$res_pay_get || !$arr){
                  $user->rollback();
                  ajaxReturn(L('zcsb'));
                }
//                    $datass['pay_id'] = $pid;
//                    $datass['get_id'] = $pid;
//                    $datass['get_nums'] = $jifens;
//                    $datass['now_nums_get'] = $get_n;
//                    $datass['now_nums'] = $get_n;
//                    $datass['is_release'] = 1;
//                    $datass['get_time'] = time();
//                    $datass['get_type'] = 23;
//                    $res_addrs = M('tranmoney')->add($datass);
        }




            //给用户添加等级
            AddUserLevel($pid);
            if($uid){
                //创建钱包
                $jifen=0;
                $regjifen= D('config')->where("name='regjifen'")->getField("value");//奖励开启才送
                if($regjifen==1){
                    $jifen=M('config')->where(array('name'=>'jifen'))->getField('value');
                    $jifen=(float)$jifen;

                }
                    $store = array();
                    $store['uid'] = $uid;
                    $store['cangku_num'] = 0;
                    $store['fengmi_num'] = $jifen;
                    $store['plant_num'] = 0;
                    $store['huafei_total'] = 0;
                    $status =  M("store")->add($store);
                    if(!$status){
                        $user->rollback();
                        ajaxReturn(L('zcsb'));
                    }
                    if($jifen > 0){
                        //添加积分记录
                        $getFengmi = M('store')->where(array('uid' => $uid))->getfield('fengmi_num');
                        $statu = addAccountRecords($uid,0,$jifen,6,$getFengmi,$type = 'scores');
                        if(!$statu){
                            $user->rollback();
                            ajaxReturn(L('zcsb'));
                        }
                    }
                    $user->commit();
                    AddUserLevel($pid);
                    $lang = cookie('think_language');
                    if(empty($lang)){
                        ajaxReturn(L('zccg'),1,U('Login/login'.'?l=en-us&mobile='.$mobile));
                    }else{
                        ajaxReturn(L('zccg'),1,U('Login/login'.'?l='.$lang.'&mobile='.$mobile));
                    }
            }else{
                $user->rollback();
                ajaxReturn(L('zccg'),0);
            }
        }

        $lang = I('get.l');
        //dump($lang);exit;
        $this->assign('lang',$lang);
        $mobile = trim(I('UID'));
        $parent_account = session("parent_account");
        if(empty($mobile)){
            if($parent_account){
                $mobile = $parent_account;
            }
        }
        $this->assign('mobile',$mobile);
        $this->display();
    }




    //快速登录
    public function quickLogin(){
        if (IS_AJAX) {
            $account = I('account');
            $code = I('code');

            // 验证验证码是否正确
            $user_object = D('Home/User');
            if(!check_sms($code,$account)){
                ajaxReturn('验证码错误或已过期');
            }
            $user_info   = $user_object->Quicklogin($account);
            if (!$user_info) {
                ajaxReturn($user_object->getError(),0);
            }
            // 设置登录状态
            $uid = $user_object->auto_login($user_info);
            // 跳转
            if (0 < $uid && $user_info['userid'] === $uid) {
                session('in_time',time());
                ajaxReturn('登录成功',1,U('Index/index'));
            }else{
                ajaxReturn('签名错误',0);
            }
        }
    }

    public function checkLogin(){
        if (IS_AJAX) {
            $account = I('account');
            $password = I('password');
            // 验证用户名密码是否正确
            $user_object = D('Home/User');
            $user_info   = $user_object->login($account, $password);
            if (!$user_info) {
                ajaxReturn($user_object->getError(),0);
            }
            session('account',$account);

             $user_info   = $user_object->Quicklogin($account);
            if (!$user_info) {
                ajaxReturn($user_object->getError(),0);
            }
            // 设置登录状态
            $uid = $user_object->auto_login($user_info);
            // 跳转
            if (0 < $uid && $user_info['userid'] === $uid) {
                session('in_time',time());
                ajaxReturn(L('dlcg'),1,U('Index/index','l='.cookie('think_language')));
            }

        }
    }

    /**
     * 注销
     * 
     */
    public function logout()
    {   
        cookie('msg',null);
        session(null);
//        $this->redirect('Login/login');
        $this->redirect('index/index');
    }
    //主机A发送完数据然后向主机B发送fin字段告诉主机2数据传送完毕同时主机A进入即将分手的状态一
    //主机B收到了主机A的fin字段同时回复 然后主机A进入分手状态二

    /**
     * 图片验证码生成，用于登录和注册
     * 
     */
    public function verify()
    {
        set_verify();
    }


    //找回密码
    public function getpsw(){
        
        $this->display();
    }

    /**
     * 找回密码
     */
    public function setpsw(){
        if(!IS_AJAX)
        $mobile=I('post.mobile');
        $code=I('post.code');
        $password=I('post.password');
        $reppassword=I('post.passwordmin');
        $isEmail = true;
      if(empty($mobile)){
            ajaxReturn(L('sjhmbnwk'));//手机号码不能为空
        }
        if(empty($code)){
            ajaxReturn(L('yzmbnwk'));
        }
        if(empty($password)){
            ajaxReturn(L('mmbnwk'));
        }
        if($password  != $reppassword){
            ajaxReturn(L('lcsrdmmbyz'));
        }
        //验证邮箱手机==yuan
        $checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)";
             if(preg_match($checkmail,$mobile)){
                   $mwhere['email']=$mobile;
                    if(!check_mail($code,$mobile)){
                        $set_code = session('EmailCode');
                        ajaxReturn(L('yzmcwhygq'));
                    }
                }else{
                    $isEmail = false;
                    $mwhere['mobile']=$mobile;
                    if(!check_sms($code,$mobile)){
                      ajaxReturn(L('yzmcwhygq'));
                    }
                }

        $user=D('User');

        //ajaxReturn($mwhere);
        $userid=$user->where($mwhere)->getField('userid');


        if(empty($userid)){
            ajaxReturn(L('sjhmcwhbzxtz'));
        }

        $where['userid']=$userid;
        //密码加密
        $salt=user_salt();
        $data['login_pwd']=$user->pwdMd5($password,$salt);
        $data['login_salt']=$salt;
        $res=$user->field('login_pwd,login_salt')->where($where)->save($data);
        if($res){
            session('sms_code',null);
            ajaxReturn(L('xgcg'),1,U('Login/logout'));
        }
        else{
            ajaxReturn(L('xgsb'));
        }

    }
    /*找回支付密码*/
    //找回密码
    public function getpswpay(){

        $this->display();
    }
    public function Lang(){
        //用户语言判断
        if(IS_AJAX){
            if(!empty($_POST['url'])){
                if(empty(session('userid'))){//若是登录页面
                    $lang = $_POST['url'];
                    cookie('think_language',$lang,60*60*24*360);
                    ajaxReturn(cookie('think_language'),1);
                }else{
                    ajaxReturn('修改语言失败',0);
                }
            }
        }
    }
    public function setpswpay(){
        if(!IS_AJAX){
            return ;
        }
        $mobile=I('post.mobile');
        $code=I('post.code');
        $password=I('post.password');
        $reppassword=I('post.passwordmin');
        if(empty($mobile)){
            ajaxReturn(L('sjhmbnwk'));
        }
        if(empty($code)){
            ajaxReturn(L('yzmbnwk'));
        }
        if(empty($password)){
            ajaxReturn(L('mmbnwk'));
        }
        if($password  != $reppassword){
            ajaxReturn(L('lcsrdmmbyz'));
        }

        if(!check_sms($code,$mobile)){
          //  ajaxReturn(L('yzmcwhygq'));
        }

        $user=D('User');
        $mwhere['mobile|email']=$mobile;
        $userid=$user->where($mwhere)->getField('userid');
        if(empty($userid)){
            ajaxReturn(L('sjhmcwhbzxtz'));
        }

        $where['userid']=$userid;
        //密码加密

        $salt=user_salt();
        $data['safety_pwd']=$user->pwdMd5($password,$salt);
        $data['safety_salt']=$salt;
        $res=$user->field('safety_pwd,safety_salt')->where($where)->save($data);
        if($res){
            session('sms_code',null);
            ajaxReturn(L('xgcg'),1,U('Index/index'));
        }
        else{
            ajaxReturn(L('xgsb'));
        }
    }

    /** 
 *  
 * 验证码生成 
 */  
public function verify_c(){  
    $Verify = new \Think\Verify();  
    $Verify->fontSize = 18;  
    $Verify->length   = 4;  
    $Verify->useNoise = false;  
    $Verify->codeSet = '0123456789';  
    $Verify->imageW = 130;  
    $Verify->imageH = 50;  
    //$Verify->expire = 600;
//    $Verify->entry();
    $Verify->entry_add();
} 
/* 验证码校验 */
public function check_verify($code, $id = '')
{
    $verify = new \Think\Verify();
    $res = $verify->check($code, $id);
    $this->ajaxReturn($res, 'json');
}
    public function sendCodelogin(){
        $mobile=I('post.mobile');
        if(empty($mobile)){
            $mes['status']=0;
            $mes['message']=L('sjhmbnwk');
            $this->ajaxReturn($mes);
        }
        $where['mobile|userid'] = $mobile;
        $isset = M('user')->where($where)->count(1);
        if($isset < 1){
            $mes['status']=0;
            $mes['message']='sjhmcwhbzxtz';
            $this->ajaxReturn($mes);
        }
        $this->ajaxReturn(Loginmsg($mobile));
    }

    public function sendCode(){
        $mobile=I('post.mobile');//输入的手机号码
        $sendType = I('post.l');//选择的语言
        $imgCode = I('post.verify');//图形验证码
        check_verify($imgCode);//检验图形验证码
//        check_add($imgCode);
        //$mobile = I('mobile');
        //判断用户用的哪种方式注册
        $checkmail="/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
        if(preg_match($checkmail,$mobile)){
            $result = sendPost($mobile);
            $this->ajaxReturn($result);
        }

        if(!isset($sendType) || empty($sendType)){
            $sendType = cookie('think_language');
        }
        if($sendType == 'zxcghy84-corean' && L('guoji') == 'hanguo'){
            $sendType = 'zxcghy84-corean';
        }
        if(empty($mobile)){
            $mes['status']=0;
            $mes['message']= L('sjhmbnwk');
            $this->ajaxReturn($mes);
        } 
        if(!empty($_SERVER["HTTP_CLIENT_IP"]))
        {
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else if(!empty($_SERVER["REMOTE_ADDR"]))
        {
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        // var_dump($cip);
        $datas=array();
        $datas['ip']=$cip;
        $datas['time']=time();

        $resCountWhere = array(
            'reg_ip'=>$cip,

            'reg_date'=>array('egt',strtotime(date('y-m-d')))
        );
        $resNum=M('user')->where($resCountWhere)->count();
        if($resNum>10){
            $mes=array();
            $mes['status'] = 2;
            $mes['message'] = L('wfznjzzc');
            M('errorlog_ip')->add($datas);
            $this->ajaxReturn($mes);
        }
        $res=M('preventip')->where(array('ip'=>$cip))->find();

        if(empty($res)){
            $user=D('User');
            $result=sendMsg($mobile,$sendType);
            // var_dump($result);
            if($result['status']==1){
               M('preventip')->add($datas);
            }
            $this->ajaxReturn($result);
        }elseif(!empty($res)){
            if(time()-$res['time'] <= 300){
                $mes=array();
                $mes['status'] = 2;
                $mes['message'] = L('wfznjzzc');
                $this->ajaxReturn($mes);
            }else{
                $user=D('User');
                $result=sendMsg($mobile,$sendType);
                // var_dump($result);
                if($result['status']==1){
                    
                    $datas['id']=$res['id'];
                    $ress=M('preventip')->save($datas);
                 }
                $this->ajaxReturn($result);
            }
        }
        $count=1;
//        if($count==1){
//            $mes['status']=0;
//            $mes['message']='手机号码已在系统中';
//            $this->ajaxReturn($mes);
//        }
        
    }

    
    public function adduser(){
      
        //判断是否开启交易功能
        $return=IsTrading(32);
        if($return['value']==0){
          $this->assign('content',$return['tip'])->display('Close/index');  
          exit();
        }

        $mobile=I('get.mobile');
        $this->assign('mobile',$mobile);
        $this->display();
    }

    public function saveuser(){
        if(IS_AJAX){
            //接收数据
            $user=D('User');
            $data        = $user->create();

            if(!$data){
                ajaxReturn($user->getError(),0);
                return ;
            }

            //判断仓库
            $store=D('Store');
            $data['account']=$data['mobile'];
            //密码加密
            $salt= substr(md5(time()),0,3);
            $data['login_pwd']=$user->pwdMd5($data['login_pwd'],$salt);
            $data['login_salt']=$salt;
            $data['safety_pwd']=$user->pwdMd5($data['safety_pwd'],$salt);
            $data['safety_salt']=$salt;

            //推荐人
            $pid=$data['pid'];
            $p_info=$user->field('pid,gid,username,account,mobile,path,deep')->find($pid);
            $gid=$p_info['pid'];//上上级ID
            $ggid=$p_info['gid'];//上上上级ID
            if($gid){
                $data['gid']=$gid;
            }
            if($ggid){
                $data['ggid']=$ggid;
            }

             //拼接路径
            $path=$p_info['path'];
            $deep=$p_info['deep'];
            if(empty($path)){
              $data['path']='-'.$pid.'-';
            }else{
              $data['path']=$path.$pid.'-';
            }
            $data['deep']=$deep+1;


            $user->startTrans();//开启事务

            $uid=$user->add($data);
            if(!$uid){
                $user->rollback();
                ajaxReturn(L('zcsb'));
            }
            //为新会员创建仓库和土地
            if(!$store->CreateCangku(0,$uid)){
                $user->rollback();
                ajaxReturn('仓库创建失败，请联系管理员',0);
            }
              
            //给上级添加值推人数
            M('user_level')->where(array('uid'=>$pid))->setInc('children_num',1);
            //给用户添加等级
            AddUserLevel($pid);

            if($uid){
                $user->commit();
                ajaxReturn(L('zccg'),1,U('Login/login'));
            }
            else{
                $user->rollback();
                ajaxReturn(L('zcsb'),0);
            }
        }
    }



 //TD每分钟增长任务
    public function Growem()
    {
     

     $config_object = D('Config');
     $growem=$config_object->where("name='growem'")->getField('value');
     $growem=(float)$growem;  
     $suiji=mt_rand()/mt_getrandmax()*$growem;//每十二分钟增长率

        $fp = fopen("open13.txt", "a+");
        fwrite($fp, date("Y-m-d H:i:s") . "增长率：".$suiji."\n");
        


        $ntime=time();
        $zerot=date("Y-m-d");
        $zerotime=strtotime($zerot);
        //获取当天第一个价格
        $TDzprice= D('coindets')->where("coin_addtime>=$zerotime")->order('coin_addtime asc')->getField("coin_price");
        $TDzpricez= $TDzprice*1.1;



        $TD= D('coindets')->where("cid=1")->order('coin_addtime desc')->find();
        $coin_price=$TD["coin_price"];
        $coin_price=$TD["max"];
        $coin_price=$TD["min"];
        $coin_price=$TD["coin_price"];  


        $nowp=$TD["coin_price"]*(1+$suiji*0.01); //现在的价格         


        //每天涨幅不超过10%
        if($nowp<$TDzpricez){
           
                $coinone['cid'] =1;
                $coinone['coin_name'] ="mikey";
                $coinone['coin_price'] =$nowp;
                $coinone['max'] =$TD["max"]*(1+$suiji*0.01);
                $coinone['min'] =$TD["min"]*(1+$suiji*0.01);
                $coinone['coin_addtime'] = $ntime;
                M('coindets')->add($coinone);
                $nowprice = L('nowprice');
                fwrite($fp, $nowprice."：".$nowp."\n");

        }


             fclose($fp);
//采集


$url1="http://gateio.io/json_svr/query_push/?u=13&c=472008&type=push_main_rates&symbol=USDT_CNY";
$ch1 = curl_init();
curl_setopt($ch1,CURLOPT_URL,$url1);
curl_setopt($ch1,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch1,CURLOPT_HEADER,0);
curl_setopt($ch1, CURLOPT_POST, 1);//post提交方式
//curl_setopt($ch1, CURLOPT_POSTFIELDS);
$output1 = curl_exec($ch1);
if($output1 === FALSE ){
echo "CURL Error:".curl_error($ch1);
}

curl_close($ch1);
$huilv_s=$this->get_between($output1,"sell_rate\":\"","\",\"max_rate");



  $url="http://gateio.io";
        $ch = curl_init();

// 2. 设置选项，包括URL
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
// 3. 执行并获取HTML文档内容
        $output = curl_exec($ch);
        if($output === FALSE ){
            echo "CURL Error:".curl_error($ch);
        }
// 4. 释放curl句柄
        curl_close($ch);

//var_dump(time());die;
//$content=$this->get_between($output,">ETH</span>","day-updn");
$content1=$this->get_between($output,"list_tbody","ody>");


$content_eth=$this->get_between($content1,">ETH</span>","</tb");
$eth_m=$this->get_between($content_eth,"$","</td><td>$");
$eth_m=$huilv_s*$eth_m;


$content_btc=$this->get_between($content1,">BTC</span>","</tb");
$btc_m=$this->get_between($content_btc,"$","</td><td>$");
$btc_m=$huilv_s*$btc_m;

$content_ltc=file_get_contents("https://gateio.io/trade/LTC_USDT");
$ltc_m=$this->get_between($content_ltc,"<title>$"," LTC/USDT");
$ltc_m=$huilv_s*$ltc_m;

$content_dog=file_get_contents("https://gateio.io/trade/DOGE_USDT");
$dog_m=$this->get_between($content_dog,"<title>$"," DOGE/USDT");
$dog_m=$huilv_s*$dog_m;


 if($btc_m>0){           
                $coinone['cid'] =2;
                $coinone['coin_name'] ="比特币";
                $coinone['coin_price'] =$btc_m;
                $coinone['max'] =$btc_m*1.1;
                $coinone['min'] =$btc_m*0.9;
                $coinone['coin_addtime'] = $ntime;
                M('coindets')->add($coinone);               

        }
 if($ltc_m>0){           
                $coinone['cid'] =3;
                $coinone['coin_name'] ="莱特币";
                $coinone['coin_price'] =$ltc_m;
                $coinone['max'] =$ltc_m*1.1;
                $coinone['min'] =$ltc_m*0.9;
                $coinone['coin_addtime'] = $ntime;
                M('coindets')->add($coinone);               

        }

 if($eth_m>0){           
                $coinone['cid'] =4;
                $coinone['coin_name'] ="以太坊";
                $coinone['coin_price'] =$eth_m;
                $coinone['max'] =$eth_m*1.1;
                $coinone['min'] =$eth_m*0.9;
                $coinone['coin_addtime'] = $ntime;
                M('coindets')->add($coinone);               

        }

 if($dog_m>0){           
                $coinone['cid'] =5;
                $coinone['coin_name'] ="狗狗币";
                $coinone['coin_price'] =$dog_m;
                $coinone['max'] =$dog_m*1.1;
                $coinone['min'] =$dog_m*0.9;
                $coinone['coin_addtime'] = $ntime;
                M('coindets')->add($coinone);               

        }

file_put_contents("1.txt", $content1);
file_put_contents("2.txt", date("Y-m-d H:i:s") ." B:".$btc_m." L:".$ltc_m." E:".$eth_m." D:".$dog_m." 汇率:".$huilv_s);


       
             
    }


public function get_between($input, $start, $end) {
    $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
    return $substr;

}

    //释放
    public function Relase()
    {

		$fp = fopen("open12.txt", "a+");
		fwrite($fp, date("Y-m-d H:i:s") . " 当前时间可开奖！\n");
		fclose($fp);

        //基础释放率
        $uinfp = M('user');
        $time = date('Y-m-d');
        $todaystime = strtotime($time);
        $where['releas_rate'] = array('gt', 0);
        $where['is_reward'] = 1;
        $where['_logic'] = 'or';
        $map['_complex'] = $where;
        $map['releas_time'] = array('elt', $todaystime);

        //今日基础释放率
//        $basi = M('config')->where(array('name' => 'sell_fee'))->getField('value');
        $perinfo = $uinfp->where($map)->order('userid desc')->limit(2000)->field('userid,releas_rate,releas_time,is_reward')->select();
        
        if (!empty($perinfo)) {
            foreach ($perinfo as $k => $v) {
                $treauid = $v['userid'];
                $data['releas_rate'] = 0.00;
                $data['releas_time'] = time();
                $data['is_reward'] = 0;
                $data['today_releas'] = $v['releas_rate'];

                $res_get = M('user')->where(array('userid' => $treauid))->save($data);//资产转入
            }
        } else {
            echo '今日已经执行完';
        }
    }

    public function Appload(){
        $this->display();
    }
    public function Anzhorload(){
        //判断是否在微信端

            $url='http://www.TDss.com/Public/home/zp/TD.apk';
            //是否为安卓
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
                ajaxReturn('IOS请下载苹果版',0);
            }else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android')){
                if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
                    ajaxReturn('安卓端请在浏览器打开下载',0);
                }else{
                    ajaxReturn($url,1);
                }
            }else{
                ajaxReturn($url,1);
            }
//
    }

    /**
     * 登录接口
     * @username 用户账号，手机
     * @password
     */
    public function enter(){
        $loginkey1 = I('loginkey');
        $loginkey1 = json_decode($loginkey1);//将值解析数组
        $loginkey = $loginkey1['loginkey'];
        $userInfo = decode($loginkey);
        $userInfo = base64_decode($userInfo);
        $mobile = $userInfo['mobile'];
        $password = $userInfo['password'];
        $imei = $loginkey1['imei'];
        $timestamp = $userInfo['timestamp'];
        $sign = $userInfo['sign'];
        //iptu
        $signature = strtoupper(md5("&imei=$imei&password=$password&timestamp=$timestamp&username=$mobile&Accesskey=mochain_access"));
        if($sign!=$signature){
            jsonReturn(500,'不是指定用户机');
        }
        $result = M('user')->where(['mobile'=>$mobile,'login_pwd'=>$password])->find();
        if(!$result){
            jsonReturn(500,'手机号或密码错误');
        }
        session('userid',$result['userid']);
        jsonReturn(200,'登录成功');
    }
    //注册

    /**
     * @username 用户名手机
     * @password 登录密吗
     * @referee 推荐人手机号码
     */
    public function addUser1(){
        //接收数据
        $username = trim(I('username'));
        $password = trim(I('password'));
        $referee = trim(I('referee'));
//        $imei = I('imei');
//        $timestamp = I('timestamp');
//iprtu
//        $signature = strtoupper(md5("&imei=$imei&password=$password&referee=$referee&timestamp=$timestamp&username=$account&Accesskey=mochain_access"));
//        if($sign!=$signature){
//            jsonReturn(500,'数据异常');
//        }

        if(empty($username)){
            jsonReturn(500,'用户名不能为空');
        }
        if(empty($password)){
            jsonReturn(500,'密码不能为空');
        }
        if(empty($referee)){
            jsonReturn(500,'推荐人不能为空');
        }
        $pid = M('user')->where(['phone'=>$referee])->find();
        if(!$pid){
            jsonReturn(500,'推荐人手机不存在');
        }
        $phone = M('user')->where(['mobile'=>$username])->find();
        if(!$phone){
            jsonReturn(500,'手机号已存在');
        }
        $password = md5($password);
        $data = [
            'mobile'=>$username,
            'login_pwd'=>$password,
            'pid'=>$pid['userid'],
        ];
        $result = M('user')->save($data);
        if(!$result){
            jsonReturn(500,'注册失败');
        }
        jsonReturn(200,'注册成功');
    }


    /**
     * 修改密码
     * @username 用户名手机
     * @password密码
     */
    public function editPwd(){
        $username = trim(I('username'));
        $password = trim(I('password'));


//        $signature = strtoupper(md5("&imei=$imei&password=$password&timestamp=$timestamp&username=$account&Accesskey=mochain_access"));
//        if($sign!=$signature){
//            jsonReturn(500,'数据异常');
//        }

        if(empty($username)){
            jsonReturn(500,'用户名不能为空');
        }
        if(empty($password)){
            jsonReturn(500,'密码不能为空');
        }
        $password = md5($password);
        $result = M('user')->where(['mobile'=>$username])->setField(['login_pwd'=>$password]);
        if(!$result){
            jsonReturn(500,'修改失败');
        }
        jsonReturn(200,'修改成功');
    }


}
