<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/3/30
 * Time: 8:06
 */

namespace app\admin\controller;

use app\admin\model\Admin;
use think\Controller;
use think\facade\Session;

class Login extends Controller
{
    public function index(){
        
        return $this->fetch();
    }

    // 登录
    public function login(){

        $account = input('post.account');
        $passwd = input('post.passwd');

        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['verifyCode'])) {
                // 校验失败
                return ajaxReturn(0,'验证码不正确');
            }
        }

        $db = new Admin();
        $result = $db->login($account,$passwd);

        if($result == 1){
            return ajaxReturn(1,'登录成功',array('url'=>url('Index/index')));
        }else if($result == 2){
            return ajaxReturn(0,'密码不正确，请重新输入密码!');
        }else if($result == 3){
            return ajaxReturn(0,'不存在该用户，请使用正确账号登录!');
        }else if($result == 4){
            return ajaxReturn(0,'登陆尝试次数过于频繁，请10分钟后再登陆！');
        }
    }

    // 退出登录
    public function logout(){
        Session::delete('id');
        Session::delete('name');
        Session::delete('account');
        unset($_SESSION);
        $this->redirect('login/index');
    }

}