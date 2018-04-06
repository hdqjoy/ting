<?php
namespace app\index\controller;

use think\facade\Config;
use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {

//        dump(Config::get('app.'));    // 获取配置的方法
//        dump(Config::pull('app'));
//        dump(Config::has('app.'));

        // 数据库查询
//        $data = Db::table('ti_user')->where('id',1)->find();
//        $tpl = 'index view';
//
//        $this->assign('tpl',$tpl);
//        $this->assign('data',$data);
        return $this->fetch();
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
