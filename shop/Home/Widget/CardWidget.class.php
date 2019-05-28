<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22
 * Time: 14:35
 */
namespace Home\Widget;
use Think\Controller;

class CardWidget extends Controller
{
    /**
     * 获取用户绑定的imtoken信息 alipay信息 weichat信息
     * return imtoken.html / alipay.html /weichat.html
     */
    public function menu($name)
    {
        layout(false); // 临时关闭当前模板的布局功能
        $seek = D($name);
        $uid = $_SESSION['userid'];
        $arr = $seek->where("userid=$uid")->order($name."_default desc")->select();

        $this->assign('arr',$arr);
        return $this->display("Widget:$name");
    }

    public function dengji($flieName)
    {
        $uid = session('userid');
        $where =["userid"=>$uid];
        $userinfos = M('user')->where($where)
            ->field('img_head,userid,username,user_credit,is_reward,today_releas,quanxian,use_grade,releas_time,is_degraded,is_auto')
            ->find();
        $moneyinfo = M('store')->where(array('uid' => $uid))->field('cangku_num,fengmi_num')->find();
        $moneyinfo['cangku_num'] = bcadd($moneyinfo['cangku_num'],'0.00',2);
        $moneyinfo['fengmi_num'] = bcadd($moneyinfo['fengmi_num'],'0.00',2);
        $filesize = @getimagesize("./Public/home/wap/heads/".$userinfos['img_head']);
        if(!$filesize){
            $userinfos['img_head']='toux-icon.png';
        }
        $this->assign("userinfos",$userinfos);
        $this->assign("moneyinfos",$moneyinfo);
        return $this->display("Widget:$flieName");
        //{:W('Car/dengji')}
    }

    /**
     * @param $table 表名
     * @param $page 显示条数
     * @param $in 条件 需要显示的条件
     * @param string $user_where 用户反馈页面的 userid 别的页面可以不传
     */
    public function jilu($table,$page,$in,$user_where=0)
    {
        $this->assign("page",$page);
        $this->assign("where",$user_where);
        $this->assign("table",$table);
        $this->assign("in",$in);
        return $this->display("Widget:xiala");
    }

}