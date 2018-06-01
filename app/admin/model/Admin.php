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

    public function getRoleAttr($value)
    {
        $status = [1=>'超级管理员组',2=>'管理员管理组',3=>'用户管理组'];
        return $status[$value];
    }

    protected $type = [
        'create_time' =>  'timestamp',
        'update_time' =>  'timestamp',
        'delete_time' =>  'timestamp',
    ];

    // 登录逻辑
    public function login($account='',$passwd=''){

        $count = Db::table('ti_login_log')
            ->where('ipaddr',ip2long(request()->ip()))
            ->where('status',0)
            ->where('site',0)
            ->where('account',$account)
            ->where('create_time','>=',(time() - 300))  // 五分钟内登录超过5次失败，则30分钟内禁止登录
            ->count();

        if($count >= 5){
            // 标识：管理员后台($flag)：'admin'.$account.ip2long(ip);应用系统：'web'.$account.ip2long(ip)
            $flag = 'admin'.$account.ip2long(request()->ip());
            // 判断是否设置标识
            if(session("?$flag")){

                if( time() - session($flag) <600 ){
                    
                    return 4;		// 限制时间内，继续限制
                }else{

                    // 超过了时间限制，销毁session同时执行登录
                    session('name', null);
                    return $this->doLogin($account,$passwd);
                }
            }else{

                // 记录限制登录标识和时间点，开始限制
                session($flag, time());
                return 4;		// 限制时间内，继续限制
            }
        }else{

            return $this->doLogin($account,$passwd);
        }
    }

    // 具体登录过程
    public function doLogin($account,$passwd){
        $user = self::where('account',$account)
            ->where('state',1)
            ->find();

        if($user){
            if($user['passwd'] === md5($passwd.config('salt'))){
                Session::set('id',$user['id']);
                Session::set('account',$user['account']);
                Session::set('admin_name',$user['admin_name']);

                $this->doLoginLog($account,1);
                return 1;   // 登录成功
            }else{

                $this->doLoginLog($account,0);
                return 2;   // 密码不正确
            }

        }else {

            $this->doLoginLog($account,0);
            return 3;   // 不存在该用户
        }
    }

    // 记录登录日志
    public function doLoginLog($account,$status){
        $data = [
            'ipaddr' => ip2long(request()->ip()),
            'status' => $status,
            'site'   => 0,
            'account'=> $account,
            'create_time' => time(),
        ];

        Db::table('ti_login_log')->data($data)->insert();
    }

}