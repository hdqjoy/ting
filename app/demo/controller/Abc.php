<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */
namespace app\demo\controller;

class Abc extends DemoBase{
    
    public function run(){
        echo '== Alphabets ==' . PHP_EOL;
        $s = 'A';
        for ($n=0; $n<10; $n++) {
            echo ++$s . ' ';
        }
        // B C D E F G H I J K
        echo PHP_EOL;

        for ($n=10; $n>0; $n--) {
            echo (--$s) . ' ';
        }
        // K K K K K K K K K K
    }
}