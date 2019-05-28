<?php

namespace Shop\Controller;

use Think\Controller;

class CarController extends CommonController
{
	public function ment()
	{
		$this->display();
	}

	public function shopping()
	{
        $carList = session("car");
        /*dump($carList);die;*/
        $this->assign("carList", $carList);
        $this->display();

	}

	public function shoppingbb()
	{

		$this->display();
	}

	public function shoppingcc()
	{
		$this->display();
	}

    /**
     * 添加订单表
     *
     */
	public function addOrder()
	{
		$uid = session('userid');//获取用户id
		$selProductList = session("selCar");//储存的购物车商品
		if (!$selProductList) $this->error("订单状态不正确", "/Shop/Car/shopping");
		$carList = session("car");//储存的购物车商品
		//地址
		$address_id = I('address_id');
		$adinfo = M('address')->where(array('address_id'=>$address_id))->find();
		$buy_name = $adinfo['name'];
		$buy_phone = $adinfo['telephone'];
		$buy_address = $adinfo['province_id'].$adinfo['city_id'].$adinfo['country_id'].$adinfo['address'];
		$remark = "备注";
		$commodity = M("product_detail");
        //获取所有订单id
        $ordersId = session('shop_id');

		#++生成大订单++
        $car_arr=$selProductList;

        //订单金额和数量
        $allTotalPrice = 0;
        $allTotalGuozi = 0;
        $sellerList = array();

        foreach ($car_arr as $key => $carList) {


            foreach ($carList as $k => $v) {

                $where = array();
                $where['id']=$v['pid'];
                $com_info=$commodity->where($where)->field('id,shangjia,price,name')->find();
                if(kuncun($v['pid'],$v['num'])===false){
                  error_alert('商品'.$com_info['name'].'库存不足');
                  return;
                }
                $sellerList[$com_info['shangjia']]['seller_id'] = $com_info['shangjia'];

                if(!in_array($com_info['id'],$sellerList[$com_info['shangjia']]['com_ids'])){
                    $sellerList[$com_info['shangjia']]['com_ids'][] =$com_info['id'];
                    $sellerList[$com_info['shangjia']]['com_nums'][] =$v['num'];
                    $sellerList[$com_info['shangjia']]['com_price'] = $sellerList[$com_info['shangjia']]['com_price']+$com_info['price']*$v['num'];
                    $sellerList[$com_info['shangjia']]['com_colors'][] = $v['color'];
                    $sellerList[$com_info['shangjia']]['com_sizes'][] = $v['size'];
                    $allTotalPrice = $allTotalPrice+$com_info['price']*$v['num'];

                }
            }//foreach
        }//foreach

        $orderids = array();

        foreach ($sellerList as $key => $value) {
        	//生成订单
        	$order = array();
			$order_no = "M" . date("YmdHis") . rand(100000, 999999);//订单编号
			$order['order_no'] = $order_no;//订单编号
			$order['uid'] = $uid;// 购买者id
			$order['buy_name'] = $buy_name;//收货人
			$order['buy_phone'] = $buy_phone;//收货人手机号码
			$order['buy_address'] = $buy_address;//收货地址
			$order['status'] = 0;//订单状态
			$order['order_sellerid'] = $value['seller_id'];//商家UID
			$order['time'] = time();//生成时间戳
            M()->startTrans();//开启事务

            try{
                $order_id = M("order")->add($order);//添加进订单表
                $newOrderId[]=$order_id;
                $orderArr = [];
                $product=0;
                foreach ($value['com_ids'] as $key=> $val){
                    $Arr['order_id'] = (int)$order_id;
                    $Arr['shop_id'] = $val;
                    $Arr['user_id'] = (int)$uid;
                    $Arr['shop_nums'] = $value['com_nums'][$key];
                    $arr = D("product_detail")->where(array("id" => $val))->find();
                    $product+= $arr['price'] * $value['com_nums'][$key];
                    $orderArr[]=$Arr;
                };
                $data['order_id']=$order_id;
                $data['buy_price']=$product;
                M('order')->save($data);
                M('ordsers_shop')->addAll($orderArr);
                M()->commit();//提交
            }catch (\Exception $ex){
                M()->rollback();//回滚
                $this->error('生成订单错误，请联系管理员！');
            }



			$orderids[] = $order_id;
			$relation_id = "|".$order_id."|";

			$total_price = 0;
			$freight = 0;
            $xiaofei_paynums = 0;
            $nums_ji = 0;//赠送鸡场矿池
            $nums_guoyuan = 0;//赠送果园矿池
            $nums_yu = 0;//赠送渔场矿池
            $sanjinums = 0;//赠送渔场矿池
            $is_duobao = 1;

			//2018年1月31日 20:30:15
			#++添加订单明细++
           foreach ($value['com_ids'] as $k => $v) {
           		$num = $value['com_nums'][$k];
				$product = M("product_detail")->where(array("id" => $v))->find();
				if($product['is_duobao']==2){
					$is_duobao =2;
				}

				//计算消费矿池使用比例
				$xiaofeibili = ($product['xiaofei_bili'] * $product['price']) / 100;
				//可参与三级分销数量
				$sanjinums = ($product['sanji_use'] * $product['price']) / 100 * $num;

				$total_price = $total_price + $product['price'] * $num;
				$xiaofei_paynums = $xiaofei_paynums + $xiaofeibili * $num;
                $tt=$total_price;
				//赠送矿池
				$Givenums = $product['jifen_nums'];
				$Givetype = $product['jifen_type'];
				$jifentypes = explode(',',$product['jifen_type']);
				if (in_array('鸡场矿池', $jifentypes)) {
					$nums_ji = $nums_ji + $Givenums;
				}

				if (in_array('果园矿池', $jifentypes)) {
					$nums_guoyuan = $nums_guoyuan + $Givenums;
				}

				if (in_array('渔场矿池', $jifentypes)) {
					$nums_yu = $nums_yu + $Givenums;
				}
				$freight = $freight + $product["freight"];

           		$detail = array();
           		$detail["order_id"] = $order_id;
				$detail["com_id"] = $product['id'];
				$detail["com_name"] = $product['name'];
				$detail["com_price"] = $product['price'];
				$detail["com_num"] = $value['com_nums'][$k];
				$detail["com_img"] = $product['pic'];
				//商家id
				$detail["shangjia"] = $product['shangjia'];
				$detail["uid"] = $uid;
				$detail["com_shoptype"] = $product['type_id'];
				$detail["size"] = $value['com_sizes'][$k];
				$detail["color"] = $value['com_colors'][$k];
				//消费矿池可使用
				$detail["xiaofei_jifen"] = $xiaofei_paynums;
				$detail["jifen_nums"] = $Givenums;
				$detail["jifen_types"] = $Givetype;
				$detail["sanji_money"] = $sanjinums;

				M("order_detail")->add($detail);
				//减少库存
				M("product_detail")->where(array("id" => $product['id']))->setDec("stock", $num);


           }
           #++添加订单明细++

            //修改总价 运费
	/*		M("order")->where(array("order_id" => $order_id))->setField(array("buy_price"=>$tt,'is_duobao'=>$is_duobao));
			//该订单消费矿池最大使用额
			M("order")->where(array("order_id" => $order_id))->setField("xiaofei_jifen", $xiaofei_paynums);
			M("order")->where(array("order_id" => $order_id))->setField("total_yf", $freight);
			M("order")->where(array("order_id" => $order_id))->setField(array('jifen_ji'=>$nums_ji,'jifen_guoyuan'=>$nums_guoyuan,'jifen_yu'=>$nums_yu));
			M("order")->where(array("order_id" => $order_id))->setField(array('sanji_money'=>$sanjinums));*/

        }
        /*if(count($sellerList)>1){
            M("order")->where(array("order_id"=>array("in",$orderids)))->setField("order_relation",$relation_id);
        }*/
		// session("car", $carList);
		session("car", null);
		session("selCar", null);
        unset($_SESSION['selCar']);
        unset($_SESSION['car']);
        session("Order_id", $newOrderId);
		$this->redirect("/Shop/Pay/index", array("oid" => $order_id , "formtype"=>'99'));
	}

	public function Buynow()
	{

	    $uid = session('userid');
        $TenantId =(int)D('product_detail')->where("id=".$_POST['p'])->field('shangjia')->find()["shangjia"];
        if($TenantId != 0){
            $TenantIdStatus = (int)D('user')->where("userid=$TenantId")->field('is_states')->find()['is_states'];
            $UserIdStatus = (int)D('user')->where("userid=$uid")->field('is_states')->find()['is_states'];
            if ($TenantIdStatus != $UserIdStatus){
                ajaxReturn("无效交易",0);
            }
        }
		$uid = session('userid');
		$pid = I("p");
		$num = I("n");
		$size = I("s");
		$color= I("c");
		$jifentype= I("jtype");
		if(!$uid) ajaxReturn("请登录后进行操作。",0);
		if(!$pid) ajaxReturn("参数不正确",0);
		if(!$num) ajaxReturn("数量不正确",0);



		//查询商品名以及价格
		$pdetail = M("product_detail")->where(array("id"=>$pid))->find();
		if(!$pdetail) ajaxReturn("该商品不存在",0);
		$name = $pdetail['name'];
		$price = $pdetail['price'];
		$pic = $pdetail['pic'];
		$isduobao = $pdetail['is_duobao'];

		$addid = I('addid');
		if($addid == ''){
			$addinfp = M('address')->where(array('member_id'=>$uid,'zt_'=>1))->find();
		}else{
			$addinfp = M('address')->where(array('address_id'=>$addid))->find();
		}
		if($addinfp == ''){
			$addinfp = M('address')->where(array('member_id'=>$uid))->order('address_id desc')->find();
		}
        if($pdetail['shangjia'] == $uid){
            $this->error('无需购买自己店铺商品');
        }
    
		//查询出要购买的商品
		$list = array();
		$product['pid'] = $pid;
		$product['size'] = $size;
		$product['color'] = $color;
		$product['num'] = $num;
		$product['name'] = $name;
		$product['price'] = $price;
		$product['pic'] = $pic;
		$product['jtype'] = $jifentype;
		//是否夺宝
		$product['isduobao'] = $isduobao;
		$list[$pid][0] = $product;


		if($list){
			session("selCar",$list);
		}else{
			$list = session("selCar");
		}

		$this->assign("selProductList",$list);
		$this->assign("addinfp",$addinfp);
		message("购买成功","1");
	}


	public function test(){
		$a = Doreport('不能为空','/Shop/Pay/index',2);
	}

	/*购物车修改数量*/
	public function editCar()
	{
		$uid = session('userid');
		$pid = I("p");
		$num = I("n");
		$size = I("s");
		$color = I("c");
		$jifentype = I("jtype");
		if (!$uid) message("请登录后进行操作。");
		if (!$pid) message("参数不正确。");
		if (!$num) message("数量不正确。");
//          if(!$size) message("尺寸不为空。");
//          if(!$color) message("颜色不为空。");
//          if(!$jifentype) message("矿池类型不能为空。");


		//查询商品名以及价格
		$pdetail = M("product_detail")->where(array("id" => $pid))->find();
		if (!$pdetail) message("该商品不存在");
		$name = $pdetail['name'];
		$price = $pdetail['price'];
		$pic = $pdetail['pic'];
		$list = array();
		$car = session("car");
		//购物车是否有商品
		if ($car) {
			$product = $car[$pid];

			//是否存在该商品
			if ($product) {
				$tag = "no";
				foreach ($product as $key => $prod) {
					if ($prod['pid'] == $pid && $prod['size'] == $size && $prod['color'] == $color) {
						$product[$key]['num'] = $num;
						$tag = "ok";
					}
				}

				$car[$pid] = $product;
				if ($tag == "no") {
					$pp['pid'] = $pid;
					$pp['size'] = $size;
					$pp['color'] = $color;
					$pp['num'] = $num;
					$pp['name'] = $name;
					$pp['price'] = $price;
					$pp['pic'] = $pic;
					$pp['jtype'] = $jifentype;
					$car[$pid][] = $pp;
				}
				session("car", $car);
			} else {
				$product['pid'] = $pid;
				$product['size'] = $size;
				$product['color'] = $color;
				$product['num'] = $num;
				$product['name'] = $name;
				$product['price'] = $price;
				$product['pic'] = $pic;
				$product['jtype'] = $jifentype;
				$car[$pid] = array($product);
				session("car", $car);
			}
		} else {
			$product['pid'] = $pid;
			$product['size'] = $size;
			$product['color'] = $color;
			$product['num'] = $num;
			$product['name'] = $name;
			$product['price'] = $price;
			$product['pic'] = $pic;
			$product['jtype'] = $jifentype;
			$prod[$pid] = array($product);
			session("car", $prod);
		}
		message("修改数量成功", "1");
	}

	/*购物车删除*/
	public function delcar()
	{
        $uid = session('userid');
		$pid = I("p");
		$gid = I("g");
		if (!$pid) message("参数不正确。");

		$carList = session("car");
		unset($carList[$pid][$gid]);
		session("car", $carList);

		message("删除商品成功", "1");
	}
}

?>