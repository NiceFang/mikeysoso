<?php
namespace API\Controller;
use Think\Controller;
class UserController extends Controller
{
    public function index()
    {
        $this->display();
    }
    public function userInfo()
    {

        $url = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $urlyuming = "https://shangmeng.itdoor.cc/app/index.php?i=9&c=entry&m=ewei_shopv2&do=mobile";
        /*if($_POST['key']==){

        }*/
        var_dump(Session_id('na10jbvgedp7vmve77e3uiqck8'));
        var_dump($_SESSION);
         //var_dump(cookie('na10jbvgedp7vmve77e3uiqck8'));
       // https://shangmeng.itdoor.cc/app/index.php?i=9&c=entry&m=ewei_shopv2&do=mobile
        $this->display();
    }
    public function encryptKey()
    {

    }
}