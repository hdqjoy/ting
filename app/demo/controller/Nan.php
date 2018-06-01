<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */
namespace app\demo\controller;

class Nan extends DemoBase{
    
    public function run(){
        echo intval(19.31 * 100).PHP_EOL;   // 1930 强制转换的数据会失真

        var_dump(NAN);              // float(NAN)
        var_dump(NAN || FALSE);     // true
        var_dump(NAN && TRUE);      // true
        var_dump(NAN === FALSE);    // false
        var_dump(NAN === TRUE);     // false
        var_dump(NAN === "FDS");    // false
        var_dump(NAN === NAN);      // false
        var_dump(NAN == NAN);       // false
        var_dump(NAN == FALSE);     // false
        var_dump(NAN == TRUE);      // true
    }
}