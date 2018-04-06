<?php

/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/3/31
 * Time: 16:10
 */
namespace app\admin\model;
use think\facade\Session;
use think\Model;
use think\Db;

class Admin extends Model
{
    protected $pk = 'id';

    public function login($account='',$passwd=''){

        $user = self::get([
            'account'   => $account,
            'is_del'    => 1,
            'state'     => 1,
        ]);

//        echo Db::table('Admin')->getLastSql();    // 获取最后一条sql语句

        if($user){
            if($user['passwd'] === md5($passwd)){
                Session::set('id',$user['id']);
                Session::set('account',$user['account']);
                Session::set('name',$user['name']);

                return 1;   // 登录成功
            }else{
                return 2;   // 密码不正确
            }

        }else {
            return 3;   // 不存在该用户
        }
    }
}