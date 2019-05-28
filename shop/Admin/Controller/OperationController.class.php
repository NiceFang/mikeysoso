<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/6
 * Time: 9:22
 */
namespace Admin\Controller;
class OperationController extends AdminController
{
    public function index()
    {
        $this->display();
    }
    public function theData()
    {
        $time =strtotime(date("Y-m-d "."00:00:00",time()));
        $dateStart = date("Y-m-d "."00:00:00",time());
        $dateOver =date("Y-m-d H:i:s",$time+60*60*24) ;

        //交易量
        $where['pay_time'] =[['EGT',$time],['LT',time()],'and'];
        $where['pay_state']=3;
        $volumeCount = D('trans')->where($where)->count("id");

        //买入
        $where['trans_type']=0;
        $payin_idCount = D('trans')->where($where)->count("id");

        //卖出
        $where['trans_type']=1;
        $payout_idCount = D('trans')->where($where)->count("id");

        //转入
        $arr['get_time'] = [['EGT',$dateStart],['LT',$dateOver],'and'];
        $arr['get_type']=3;
        $accountsCount = D('usermoney_record')->where($arr)->count("id");
        //复投量
        $arr['get_type']=2;
        $afterVotingCount = D('usermoney_record')->where($arr)->count("id");
        //注册量
        $userWhere['reg_date']=[['EGT',$time],['LT',time()],'and'];
        $registerCount = D('user')->where($userWhere)->count('userid');
        $arrCount =[
            'volumeCount'=>(int)$volumeCount,
            'payin_idCount'=>(int)$payin_idCount,
            'payout_idCount'=>(int)$payout_idCount,
            'accountsCount'=>(int)$accountsCount,
            'afterVotingCount'=>(int)$afterVotingCount,
            'registerCount'=>(int)$registerCount
        ];
        echo json_encode($arrCount);
    }
}