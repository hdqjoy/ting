<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 在这里的函数，其他地方可以直接使用

/**
 * 封装ajax调用，返回数据的方法
 * @param $status
 * @param $msg
 * @param array $data
 */
function ajaxReturn($status, $msg, $data = array()){
    $result = array(
        'status'    => $status,
        'msg'       => $msg,
        'data'      => $data
    );

    return json($result);
}