<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/3/25
 * Time: 8:36
 */
namespace app\admin\controller;

use think\facade\Session;

class Index extends AdminBase
{
    
    public function index(){
        
        return $this->view->fetch('index',['title'=>'首页']);
    }
    
    public function test(){
        
        return 'hello admin';
    }


}