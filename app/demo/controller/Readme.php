<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/5/31
 */
namespace app\demo\controller;

class Readme extends DemoBase{

    public function readme(){

        echo <<<EOF
            本目录写的所有文件，均是PHP的用例<br />
            文件对应功能说明：<br />
            
            文件名             功能<br />
            DemoBase.php        demo模块的基类
            Abc.php             字母通过自增，可以实现增加；字母通过自减，不可以实现自减<br />
            Encphp.php          php 源码简单加密的几种方法
            Nan.php             NAN 的比较关系<br />
            Ping.php            网页 ping 命令的使用<br />
            StrArr.php          字符串和数组，下标的区别<br />
            Readme.php          说明文件<br />

EOF;

    }
}