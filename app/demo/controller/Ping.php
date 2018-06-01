<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */
namespace app\demo\controller;

class Ping extends DemoBase{

    public function run(){
        $host = 'www.baidu.com';
        echo `ping -n 3 {$host}`;
    }

}