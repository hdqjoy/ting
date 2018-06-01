<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */
namespace app\demo\controller;

class StrArr extends DemoBase{
    
    public function run(){
        $a    = 'car';          // $a is a string
        echo $a.PHP_EOL;

        $a[0] = 'b';            // $a is still a string
        echo $a.PHP_EOL;        // bar
        var_dump($a);           // string bar

        $a[1] = '1';
        var_dump($a);           // string b1r
    }
}
