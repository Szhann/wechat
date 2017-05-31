<?php
namespace Home\Controller;
use Think\Controller;

class TokenController extends Controller {
    public function test(){
        echo 'hello thinkphp!';
    }
    public function checkSignature(){
        //1.第一步获取微信传入的参数
        $echostr   = $_GET['echostr'];
        $signature = $_GET['signature'];
        $timestamp = $_GET['timestamp'];
        $nonce     = $_GET['nonce'];
        $token     = 'lby';

        //2.进行排序和加密
        $arr = array($token,$timestamp,$nonce);
        sort($arr);
        $code = join('',$arr);
        $code = sha1($code);

        //3.验证
        if($code == $signature && $echostr){
            echo $echostr;
            exit;
        }
    }
    public function getAccesstoken(){
        $appid = 'wx95b1615cf82bb199';
        $secret = '56c1cba2f71c8c0df8c8a64814dfff1b';
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        $access_token = file_get_contents($url);
        echo $access_token;
        $this->display('index');
    }
}