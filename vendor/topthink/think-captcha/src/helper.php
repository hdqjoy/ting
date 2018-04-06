<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

Route::get('captcha/[:id]', "\\think\\captcha\\CaptchaController@index");

Validate::extend('captcha', function ($value, $id = '') {
    return captcha_check($value, $id);
});

Validate::setTypeMsg('captcha', ':attribute错误!');

/**
 * @param string $id
 * @param array  $config
 * @return \think\Response
 */
function captcha($id = '', $config = [])
{
    $captcha = new \think\captcha\Captcha($config);
    return $captcha->entry($id);
}

/**
 * @param $id
 * @return string
 */
function captcha_src($id = '')
{
    return Url::build('/captcha' . ($id ? "/{$id}" : ''));
}

/**
 * @param $id
 * @return mixed
 */
//function captcha_img($id = '')
//{
//    return '<img src="' . captcha_src($id) . '" alt="captcha" />';
//}

/**
 * 修改过的验证码图片，可实现点击更换验证码
 * @param string $id
 * @return string
 */
function captcha_img($id = "")
{
    $js_src = "this.src='".captcha_src()."'";
    return '<img id="verifyCode" src="' . captcha_src($id) . '" alt="点击更新验证码" title="看不清，换一张"
     onclick="'.$js_src.'" />';
}

/**
 * @param        $value
 * @param string $id
 * @param array  $config
 * @return bool
 */
function captcha_check($value, $id = '')
{
    $captcha = new \think\captcha\Captcha((array) Config::pull('captcha'));
    return $captcha->check($value, $id);
}
