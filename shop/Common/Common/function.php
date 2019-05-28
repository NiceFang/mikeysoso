<?php

function p($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


//检查网站是否关闭
function is_close_site(){

    $where['name']='TOGGLE_WEB_SITE';
    $info=M('Config','ysk_')->where($where)->field('value,tip,options')->find();
    $timeOptions = explode('-', $info['options']);
    $timeOptions[0] = strtotime($timeOptions[0]);
    $timeOptions[1] = strtotime($timeOptions[1]);
    $nowTime = time();
    if($info['value'] == 0 && ($nowTime < $timeOptions[0] ||  $nowTime > $timeOptions[1])){
        $info['value'] = 1;
    }
    return $info;
}
//检查商城是否关闭
function is_close_mall(){

    $where['name']='TOGGLE_MALL_SITE';
    $info=M('Config','ysk_')->where($where)->field('value,tip')->find();
    return $info;
}


function sp_dir_create($path, $mode = 0777)
{
    if (is_dir($path)) return true;
    $ftp_enable = 0;
    $path = sp_dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}

function sp_dir_path($path)
{
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/')
        $path = $path . '/';
    return $path;
}

/**
 * [get_car_no 生成矿车编号]
 * @return [type] [description]
 */
function get_car_no(){
    $no=M('nzusfarm')->max('no');
    $no=intval($no);
    $no=$no+1;
    $len=strlen($no);
    if($len<6){
        $arr[1]='00000';
        $arr[2]='0000';
        $arr[3]='000';
        $arr[4]='00';
        $arr[5]='0';
        $no=$arr[$len].$no;
    }
    return $no;
}
/**
 *添加公共上传方法
 *获取上传路径
 *$picture
 */
function get_cover_url($picture){
    if($picture){
        $url = __ROOT__.'/Uploads/'.$picture;
    }else{
        $url = __ROOT__.'/Uploads/photo.jpg';
    }
    return $url;
}

/**
 * 用于生成插入datetime类型字段用的字符串
 * @param string $str 支持偏移字符串
 */
function datetime($str = 'now')
{
    return @date("Y-m-d H:i:s", strtotime($str));
}

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 * @author jry <416148489@qq.com>
 */
function time_format($time = null, $format = 'Y-m-d H:i')
{
    $time = $time === null ? time() : intval($time);
    return date($format, $time);
}

/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string
 * @author jry <416148489@qq.com>
 */
function user_md5($str, $auth_key=null)
{
    if (!$auth_key) {
        $auth_key = C('AUTH_KEY') ?: '0755web';
    }
    return '' === $str ? '' : md5(sha1($str) . $auth_key);
}

/**
 * [user_salt 用户密码加密链接串]
 * @return [type] [description]
 */
function user_salt($time=null){
    if(isset($time) || empty($time)){
        $time=time();
    }
    return substr(md5($time),0,3);
}

/**
 * 获取上传文件路径
 * @param  int $id 文件ID
 * @return string
 * @author jry <416148489@qq.com>
 */
function get_cover($id = null, $type = null)
{
    return D('Admin/Upload')->getCover($id, $type);
}



/**
 * 检测是否使用手机访问
 * @access public
 * @return bool
 */
function is_wap()
{
    if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
        return true;
    } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
        return true;
    } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
        return true;
    } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}

/**
 * 是否微信访问
 * @return bool
 * @author jry <416148489@qq.com>
 */
function is_weixin()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    } else {
        return false;
    }
}

/**
 * [get_verify 生成验证码]
 * @return [type] [description]
 */
function get_verify(){
    ob_clean();
    $config =    array(
        'codeSet' =>  '0123456789',
        'fontSize'    =>    50,    // 验证码字体大小
        'length'      =>    4,     // 验证码位数
        'fontttf'     =>   '5.ttf',
        'useCurve'    => false,
        'bg'          => array(229, 237, 240),
    );
    $Verify =     new \Think\Verify($config);
    $Verify->entry();
}


/**
 * [ajaxReturn ajax提示款]
 * @param  [type]  $message [提示文字]
 * @param  integer $status  [1=成功 0=失败]
 * @param  string  $url     [跳转地址]
 * @param  string  $extra   [回传数据]
 * @return [type]           [json数据]
 */
function ajaxReturn($message,$status=0, $url ='',$extra='') {
    // 返回JSON数据格式到客户端 包含状态信息
    header('Content-Type:application/json; charset=utf-8');
    $result = array(
        'message' => $message,
        'status'  =>  $status,
        'url' => $url,
        'result'  =>  $extra
    );

    exit(json_encode($result));
}

function jsonReturn($code,$msg){
    $arr = [
        'code'=>$code,
        'msg'=>$msg,
    ];
    exit(json_encode($arr));
}

// =陶==js消息提示框===
function error_alert($mes){
    echo "<meta charset=\"utf-8\"/><script>alert('".$mes."');javascript:history.back(-1);</script>";
    exit;
}
function success_alert($mes,$url=''){
    if($url!=''){
        echo "<meta charset=\"utf-8\"/><script>alert('".$mes."');location.href='" .$url. "';</script>";
    }else{
        echo "<meta charset=\"utf-8\"/><script>alert('".$mes."');location.href='" .$jumpUrl. "';</script>";
    }
    exit;
}
// =陶==js消息提示框===



//防注入，字符串处理，禁止构造数组提交
//字符过滤
//陶
function safe_replace($string) {
    if(is_array($string)){
        $string=implode('，',$string);
        $string=htmlspecialchars(str_shuffle($string));
    } else{
        $string=htmlspecialchars($string);
    }
    $string = str_replace('%20','',$string);
    $string = str_replace('%27','',$string);
    $string = str_replace('%2527','',$string);
    $string = str_replace('*','',$string);
    $string=str_replace("select","",$string);
    $string=str_replace("join","",$string);
    $string=str_replace("union","",$string);
    $string=str_replace("where","",$string);
    $string=str_replace("insert","",$string);
    $string=str_replace("delete","",$string);
    $string=str_replace("update","",$string);
    $string=str_replace("like","",$string);
    $string=str_replace("drop","",$string);
    $string=str_replace("create","",$string);
    $string=str_replace("modify","",$string);
    $string=str_replace("rename","",$string);
    $string=str_replace("alter","",$string);
    $string=str_replace("cas","",$string);
    $string=str_replace("or","",$string);
    $string=str_replace("=","",$string);
    $string = str_replace('"','&quot;',$string);
    $string = str_replace("'",'',$string);
    $string = str_replace('"','',$string);
    $string = str_replace(';','',$string);
    $string = str_replace('<','&lt;',$string);
    $string = str_replace('>','&gt;',$string);
    $string = str_replace("{",'',$string);
    $string = str_replace('}','',$string);
    $string = str_replace('--','',$string);
    $string = str_replace('(','',$string);
    $string = str_replace(')','',$string);

    return $string;
}

function payway($value){
    $arr=array('支付宝','微信');
    return $arr[$value];
}

/**
 * 获取父级账号
 */
function get_parent_account($pid){
    $account=D('User')->where('userid ='.$pid)->getField('account');
    if($account)
        return $account;
    else
        return '无';
}

function get_user_name($uid){
    $where['userid']=$uid;
    $info=M('user')->where($where)->field('account,username')->find();
    return $info['username']."(".$info['account'].")";
}


//验证码
function set_verifybak(){
    ob_clean();
    $config =    array(
        'codeSet' =>  '0123456789',
        'fontSize'    =>    30,    // 验证码字体大小   
        'length'      =>    4,     // 验证码位数    
        'fontttf'     =>   '5.ttf',
        'useCurve'    => false,
        'expire'    =>  1800,//过期时间
    );
    $Verify =     new \Think\Verify($config);
    $Verify->entry();
}
// 检测输入的验证码是否正确，$code为用户输入的验证码字符串

function set_verify($code, $id = '',$type=''){

    $verify =     new \Think\Imgcodeverify();

    if($type='add'){

        return $verify->check_add($code, $id);

    }

    else{

        return $verify->check($code, $id);

    }

}
//验证验证码
//function check_verify($code)
//{
//    $verify = new \Think\Verify();
//    return $verify->check($code);
//}
function check_verify($code)
{
    $verify = new \Think\Verify();
    return $verify->check_add($code);
}

//获取以及好友人数
function get_children_count($uid){
    $where['pid']=$uid;
    return M('user')->where($where)->count(1);
}


/**
 * [trading 添加用户交易记录明细]
 * @param  [type] $data [添加的数据]
 * @return [type]         [description]
 */
function add_trading($data){
    if(empty($data))
        return false;

    $trading=M('fruitdetail');

    if(empty($data['uid'])){
        $userid=session('userid');
        $data['uid']=$userid;
    }
    $data['add_time']=time();
    $res=$trading->add($data);
    return $res;
}

//添加会员奖励记录
/**
 * @param $userId 用户id
 * @param $configType 奖励配置类型
 * @param $awardType  奖励类型
 * @param $money 金额
 * @return bool
 */
function userAward($userId,$configType,$awardType,$money){
    $where = array();
    $where['userid'] = array('EQ',$userId);
    $userInfo = D("user")->field('userid,path')->where($where)->find();

    if(empty($userInfo['path'])){
        return 1;
    }

    $whereConfig = array();

    $awardValue = array();
    $awardValue['type'] = $awardType;
    $awardValue['user_id'] = $userInfo['userid'];
    $awardValue['money'] = $money;
    $awardValue['path'] = $userInfo['path'];

    if($awardType == 1){
        $whereConfig['name'] = array('EQ',$configType);;
        $configInfo = D("config")->field('value,tip,options')->where($whereConfig)->find();
        $awardValue['reward_rate_one'] = $configInfo['value'];
    }elseif ($awardType == 2){
        $whereConfig['name'] = array('like',$configType.'%');
        $whereConfig['group'] = array('EQ',12);
        $configInfo = D("config")->field('name,value,tip,options')->where($whereConfig)->select();
        foreach ($configInfo as $key => $val){
            if($val['name'] == 'qukuaij1'){
                $awardValue['reward_rate_one'] = $val['value'];
            }
            if($val['name'] == 'qukuaij2'){
                $awardValue['reward_rate_two'] = $val['value'];
            }
        }
    }elseif ($awardType == 3){
        $whereConfig['name'] = array('EQ',$configType);
        $configInfo = D("config")->field('value,tip,options')->where($whereConfig)->find();
        $awardValue['reward_rate_one'] = $configInfo['value'];

        $whereVipConfig = array();
        $whereVipConfig['name'] = array(array('EQ','vipj3'),array('EQ','vipj4'),'or');
        $whereVipConfig['group'] = array('EQ',13);
        $vipConfigInfo = D("config")->field('name,value,tip,options')->where($whereVipConfig)->select();

        foreach ($vipConfigInfo as $key => $val){
            if($val['name'] == 'vipj3'){
                $awardValue['reward_rate_two'] = $val['value'];
            }elseif ($val['name'] == 'vipj4'){
                $awardValue['reward_rate_all'] = $val['value'];
            }
        }
    }
//    $awardValue['reward_rate_two'] = $configInfo['tip'];
//    $awardValue['reward_rate_all'] = $configInfo['option'];
   $arr =  M("user_award")->add($awardValue);

    if($arr){
        return 1;
    }else{
        return 0;
    }
}

//会员等级
/**
 * @param $uid 用户id
 * @param $useGrade 用户等级
 * @param $isDegraded 是否降级 1是 2否
 */
function formatLevelbaks($uid,$useGrade,$isDegraded,$satusOne=1){
    $user=D('User');
    $store = M('store');
    $where['uid'] = array('EQ',$uid);
    $scores = $store->where($where)->getField('fengmi_num');
    $jiLevel = 1;
    switch ($scores){
        case bccomp($scores,4980,5) < 0:
            $jiLevel = 1;
            break;
        case bccomp($scores,4980,5) >= 0 && bccomp($scores,5000,5) < 0:
            $jiLevel = 3;
            break;
        case bccomp($scores,5000,5) >= 0 && bccomp($scores,1000000,5) < 0;
            $jiLevel = 2;
            break;
        case bccomp($scores,1000000,5) >= 0 && bccomp($scores,3000000,5) < 0;
            $jiLevel = 4;
            break;
        case bccomp($scores,3000000,5) >= 0;
            $jiLevel = 5;
            break;
    }

    //被推荐人ID
    $userIds = $user->field('userid')->where(array('pid'=>$uid))->select();
    $userStr = '';
    if(!empty($userIds)){
        foreach ($userIds as $val){
            $userStr .= $val['userid'].',';
        }
    }
    //推荐卫士人数
    $inUser['uid'] = array('in',$userStr);
    $inUser['fengmi_num'] = array('egt',4980);
    $tUserCountFive = $store->where($inUser)->count();
    //推荐达人数量
    $inUser['fengmi_num'] = array('egt',1000000);
    $tUserCountThree = $store->where($inUser)->count();

    $userLevel = $jiLevel;
    if($jiLevel == 1 && $isDegraded == 2){
        uUserLevel($uid,$jiLevel,$satusOne);
        return true;
    }elseif($jiLevel == 3){
        $userLevel = 2;
    }elseif($jiLevel == 2){
        if($tUserCountFive >= 5){
            $userLevel = 3;
        }else{
            $userLevel = 2;
        }
    }elseif($jiLevel == 4){
        if($tUserCountFive >= 5){
            $userLevel = 4;
        }else{
            $userLevel = 2;
        }
    }elseif ($jiLevel == 5){
        if($tUserCountThree >= 3){
            $userLevel = 5;
        }else{
            if($tUserCountFive >= 5){
                $userLevel = 4;
            }else{
                $userLevel = 2;
            }
        }
    }

    if($isDegraded != 1){
        uUserLevel($uid,$userLevel,$satusOne);
    }else{
        if($userLevel > $useGrade){
            uUserLevel($uid,$userLevel,$satusOne);
        }
    }


    //等级为1时，如不做忽略降级处理，直接更新。反之不做处理。
//    if($jiLevel == 1 && $isDegraded == 2){
//        uUserLevel($uid,$jiLevel);
//        return true;
//    }
    //等级为2时，如做升级或忽略降级处理，则直接更新等级。否则不做处理
//    if($jiLevel == 2 && ($useGrade < 2 || $isDegraded = 2)){
//        uUserLevel($uid,$jiLevel);
//        return true;
//    }
    //等级为3或4时，如做升级或忽略降级处理，推荐卫士人数大于等5人，更新相应等级，小于5人等级降为2
//    if(($jiLevel == 3 && ($useGrade < 3 || $isDegraded = 2) ) ||
//        ($jiLevel ==4 && ($useGrade < 4 || $isDegraded = 2))){
//        if($tUserCountFive >= 5){
//            uUserLevel($uid,$jiLevel);
//        }else{
//            uUserLevel($uid,2);
//        }
//        return true;
//    }
    //等级为5时，如做升级或忽略降级处理，推荐达人人数大于等于3，更新相应等级，小于3时确认推荐卫士人数是否大于等于5人，更新相应等级，小于5人等级降为2
//    if($jiLevel == 5 && ($useGrade < 5 || $isDegraded = 2)){
//        if($tUserCountThree >= 3){
//            uUserLevel($uid,$jiLevel);
//        }else{
//            if($tUserCountFive > 5){
//                uUserLevel($uid,4);
//            }else{
//                uUserLevel($uid,2);
//            }
//        }
//        return true;
//    }
//
//    $userIds = $user->field('userid')->where(array('pid'=>$uid))->select();
//    $userStr = '';
//    if(!empty($userIds)){
//        foreach ($userIds as $val){
//            $userStr .= $val['userid'].',';
//        }
//    }

//    if($userStr != ''){
//        $userStr = rtrim($userStr,',');
//        $inUser = array();
//        $inUser['uid'] = array('in',$userStr);
//        $inUser['fengmi_num'] = array('egt',5000);
//        $tUserCount = $store->where($inUser)->count();
//    }

//    $inUser = [];
//    if($userStr != '' && ($jiLevel == 3 && ($useGrade < 3 || $isDegraded = 2) ) ||
//        ($jiLevel ==4 && ($useGrade < 4 || $isDegraded = 2))){
//        $inUser['uid'] = array('in',$userStr);
//        $inUser['fengmi_num'] = array('egt',5000);
//        $tUserCount = $store->where($inUser)->count();
//        if($tUserCount > 5){
//            uUserLevel($uid,$jiLevel);
//        }
//    }
//
//    if($userStr != '' && ($jiLevel == 5 && ($useGrade < 5 || $isDegraded = 2))){
//        $inUser['uid'] = array('in',$userStr);
//        $inUser['fengmi_num'] = array('egt',1000000);
//        $tUserCount = $store->where($inUser)->count();
//        if($tUserCount > 3){
//            uUserLevel($uid,$jiLevel);
//        }else{
//            $inUser['uid'] = array('in',$userStr);
//            $inUser['fengmi_num'] = array('egt',5000);
//            $tUserCount = $store->where($inUser)->count();
//            if($tUserCount > 5){
//                uUserLevel($uid,4);
//            }else{
//                uUserLevel($uid,2);
//            }
//        }
//    }

//    if(bccomp($scores,5000,5) < 0){
//        $level = '志愿者';
//        if($isDegraded == 2){
//            uUserLevel($uid,1);
//        }
//    }else if (bccomp($scores,5000,5) >= 0 && bccomp($scores,1000000,5) < 0){
//        $userIds = $user->field('userid')->where(array('pid'=>$uid))->select();
//        if(count($userIds) >= 5){
//            $userStr = '';
//            foreach ($userIds as $val){
//                $userStr .= $val['userid'].',';
//            }
//            $userStr = rtrim($userStr,',');
//            $inUser = array();
//            $inUser['uid'] = array('in',$userStr);
//            $inUser['fengmi_num'] = array('egt',5000);
//            $tUserCount = $store->where($inUser)->count();
//            if($tUserCount >= 5){
//                $level = '环保顾问';
//                if($isDegraded == 2 || $useGrade < 3){
//                    uUserLevel($uid,3);
//                }
//            }else{
//                $level = '环保卫士';
//                if($isDegraded == 2 || $useGrade < 2){
//                    uUserLevel($uid,2);
//                }
//            }
//        }else{
//            $level = '环保卫士';
//            if($isDegraded == 2 || $useGrade < 2){
//                uUserLevel($uid,2);
//            }
//        }
//    }else if(bccomp($scores,1000000,5) >= 0 && bccomp($scores,3000000,5) < 0){
//        $userIds = $user->field('userid')->where(array('pid'=>$uid))->select();
//        if(count($userIds) >= 5){
//            $userStr = '';
//            foreach ($userIds as $val){
//                $userStr .= $val['userid'].',';
//            }
//            $userStr = rtrim($userStr,',');
//            $inUser = array();
//            $inUser['uid'] = array('in',$userStr);
//            $inUser['fengmi_num'] = array('egt',5000);
//            $tUserCount = $store->where($inUser)->count();
//            if($tUserCount >= 5){
//                $level = '环保达人';
//                if($isDegraded == 2 || $useGrade < 4){
//                    uUserLevel($uid,4);
//                }
//            }else{
//                $level = '环保卫士';
//                if($isDegraded == 2 || $useGrade < 2){
//                    uUserLevel($uid,2);
//                }
//            }
//        }else{
//            $level = '环保卫士';
//            if($isDegraded == 2 || $useGrade < 2){
//                uUserLevel($uid,2);
//            }
//        }
//    }else{
//        $userIds = $user->field('userid')->where(array('pid'=>$uid))->select();
//        if(count($userIds) >= 3){
//            $userStr = '';
//            foreach ($userIds as $val){
//                $userStr .= $val['userid'].',';
//            }
//            $userStr = rtrim($userStr,',');
//            $inUser = array();
//            $inUser['uid'] = array('in',$userStr);
//            $inUser['fengmi_num'] = array('egt',1000000);
//            $tUserCount = $store->where($inUser)->count();
//            if($tUserCount >= 3){
//                $level = '环保大使';
//                if($isDegraded == 2 || $useGrade < 2){
//                    uUserLevel($uid,5);
//                }
//            }else{
//                $level = '环保卫士';
//                if($isDegraded == 2 || $useGrade < 2){
//                    uUserLevel($uid,2);
//                }
//            }
//        }else{
//            $level = '环保卫士';
//            if($isDegraded == 2 || $useGrade < 2){
//                uUserLevel($uid,2);
//            }
//        }
//    }
////    return $level;
}

function uUserLevel($uid,$level){
    $userModel = M('user');
    $configModel = D('config');
    $Model = M();
    //$Model->startTrans();//开启事务
   // try{
        $where = 'userid = '.$uid;
        $userGrade = $userModel->where($where)->field('use_grade')->find()['use_grade'];
        if($userGrade!=$level){
            $name = $userModel->where($where)->setField('use_grade',$level);
            if(!$name){
                return 0;
            }
           /* if(!$name){
                $Model->rollback();//事务回滚
                return 0;
            }*/
        }
        $configLevel= $configModel->where("name='level'")->getField("value");
        $button= $configModel->where("name='button'")->getField("value");
       /* if($button == 1 && $level >= $configLevel){
            $userData = $userModel->field('pid,reward_superior_status')->where($where)->find();
            if($userData['reward_superior_status'] == 1){
                //获取配置中赠送矿池量
                $leveljifen= $configModel->where("name='leveljifens'")->getField("value");
                $arr =  M('store')->where(['uid'=>$userData['pid']])->setInc('fengmi_num',$leveljifen);
                $scores = M('store')->where(['uid'=>$userData['pid']])->getField('fengmi_num');
                //添加积分记录
                $one = addAccountRecords($userData['pid'],$uid,$leveljifen,5,$scores,'scores');
                $userModel->where($where)->setField('reward_superior_status',2);
                if(!$one || !$arr){
                    $Model->rollback();//事务回滚
                    $arr = ['one'=>$one,'arr'=>$arr];
                    return 0;
                }
            }
        }*/
        /*if($status==1){
            $Model->commit();//事务提交
        }*/
        return 1;
   /* }catch(Exception $e){
        $Model->rollback();//事务回滚
        return 0;
    }*/
}
//创建TOKEN
function creatToken() {
    $code = chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE)) . chr(mt_rand(0xB0, 0xF7)) . chr(mt_rand(0xA1, 0xFE));
    session('TOKEN', authcode($code));
    return authcode($code);
}

//判断TOKEN
function checkToken($token) {
    if ($token == session('TOKEN')) {
        session('TOKEN', NULL);
        return 1;
    } else {
        return 0;
    }
}
/* 加密TOKEN */
function authcode($str) {
    $key = "ANDIAMON";
    $str = substr(md5($str), 8, 10);
    return md5($key . $str);
}

//会员等级
function formatLevel($uid,$useGrade,$isDegraded){
    $user=D('User');
    $store = M('store');

    $where['uid'] = array('EQ',$uid);
    $scores = $store->where($where)->getField('fengmi_num');
    //获取等级配置信息
    $configWhere = [
        'group'=>13,
    ];
    $configValue = M('config')->field('name,options,tip')->where($configWhere)->select();
    $configData = [];
    foreach ($configValue as $val){
        $configData[$val['name'].'options'] = $val['options'];
        $configData[$val['name'].'tip'] = $val['tip'];
    }
    $jiLevel = 1;
    switch ($scores){
        case bccomp($scores,$configData['vipj1tip'],5) < 0:
            $jiLevel = 1;
            break;
        case bccomp($scores,$configData['vipj1tip'],5) >= 0 && bccomp($scores,$configData['vipj2tip'],5) < 0:
            $jiLevel = 3;
            break;
        case bccomp($scores,$configData['vipj2tip'],5) >= 0 && bccomp($scores,$configData['vipj3tip'],5) < 0;
            $jiLevel = 2;
            break;
        case bccomp($scores,$configData['vipj3tip'],5) >= 0 && bccomp($scores,$configData['vipj4tip'],5) < 0;
            $jiLevel = 4;
            break;
//        case bccomp($scores,1000000,5) >= 0 && bccomp($scores,3000000,5) < 0;
//            $jiLevel = 4;
//            break;
        case bccomp($scores,$configData['vipj4tip'],5) >= 0;
            $jiLevel = 5;
            break;
    }

    //取出推荐了多少人
    $userWhere = [
        'pid'=>$uid,
    ];
    $userWhere['use_grade'] = [
        'egt',2
    ];
    $tUserCountFive = $user->where($userWhere)->count();
    $userWhere['use_grade'] = [
        'egt',4
    ];
    $tUserCountThree = $user->where($userWhere)->count();
//    $userStr = '';
//    if(!empty($userIds)){
//        foreach ($userIds as $val){
//            $userStr .= $val['userid'].',';
//        }
//    }
    //推荐卫士人数
//    $inUser['uid'] = array('in',$userStr);
//    $inUser['fengmi_num'] = array('egt',$configData['vipj1tip']);
//    $tUserCountFive = $store->where($inUser)->count();
//    //推荐达人数量
//    $inUser['fengmi_num'] = array('egt',$configData['vipj3tip']);
//    $tUserCountThree = $store->where($inUser)->count();
//积分满足的情况下判断等级是否满足
    $userLevel = $jiLevel;
    if($jiLevel == 1 && $isDegraded == 2){
         $arrOne = uUserLevel($uid,$jiLevel);
         if($arrOne){
             return 1;
         }else{
             return 0;
         }

    }elseif($jiLevel == 3){
        $userLevel = 2;
    }elseif($jiLevel == 2){
        if($tUserCountFive >= $configData['vipj2options']){
            $userLevel = 3;
        }else{
            $userLevel = 2;
        }
    }elseif($jiLevel == 4){
        if($tUserCountFive >= $configData['vipj3options']){
            $userLevel = 4;
        }else{
            $userLevel = 2;
        }
    }elseif ($jiLevel == 5){
        if($tUserCountThree >= $configData['vipj4options']){
            $userLevel = 5;
        }else{
            if($tUserCountFive >= $configData['vipj3options']){
                $userLevel = 4;
            }else{
                $userLevel = 2;
            }
        }
    }

    if($isDegraded != 1){
        //不忽略降级操作
        $arr =  uUserLevel($uid,$userLevel);
    }else{
        //忽略降级操作
        if($userLevel > $useGrade){
            $arr =   uUserLevel($uid,$userLevel);
        }
    }
    //$arr =   uUserLevel($uid,$userLevel);
    if(!isset($arr)){
        return 1;
    }
    return $arr;

}

function uUserLevelbakS($uid,$level){
    $userModel = M('user');
    $configModel = D('config');
    $where = 'userid = '.$uid;
    $userModel->where($where)->setField('use_grade',$level);

    $configLevel= $configModel->where("name='level'")->getField("value");
    $button= $configModel->where("name='button'")->getField("value");
    if($button == 1 && $level >= $configLevel){
        $userData = $userModel->field('pid,reward_superior_status')->where($where)->find();
        if($userData['reward_superior_status'] == 1){
            //获取配置中赠送矿池量
            $leveljifen= $configModel->where("name='leveljifens'")->getField("value");
            M('store')->where(['uid'=>$userData['pid']])->setInc('fengmi_num',$leveljifen);
            $scores = M('store')->where(['uid'=>$userData['pid']])->getField('fengmi_num');
            //添加积分记录
            addAccountRecords($userData['pid'],$uid,$leveljifen,5,$scores,'scores');
            $userModel->where($where)->setField('reward_superior_status',2);
        }
    }
}

/**
 * 会员积分、余额变化记录
 * @param $masterId 主变化用户ID
 * @param $deputyId 被变化用户ID
 * @param $accountNum 变化量
 * @param $getType 变化详细类型
 * @param $nowAllNum 变化后总量
 * @param $type 变化类型，默认余额
 */
function addAccountRecords($masterId,$deputyId,$accountNum,$getType,$nowAllNum,$type = 'money',$award=0,$user_id=0){
    $moneyData = [
        'master_id' => $masterId,
        'deputy_id' => $deputyId,
        'get_nums' => $accountNum,
        'get_type' => $getType,
        'now_nums' => $nowAllNum,
        'award_id'=>$award,
        'user_id'=>$user_id

    ];

    $tableName = 'user'.$type.'_record';

    $status = M($tableName)->add($moneyData);
//    echo M($tableName)->getLastSql();
    return $status;

}