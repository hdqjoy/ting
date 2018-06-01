<?php
/**
 * Created by PhpStorm.
 * User: hdqjoy
 * Date: 2018/3/25
 * Time: 8:36
 */
namespace app\admin\controller;

use think\facade\Session;
use think\Request;

class Index extends AdminBase
{
    
    public function index(){
        
        return $this->view->fetch('index',['title'=>'首页']);
    }
    
    public function test(){

        $menu = $this->getMenuList(2);

        dump($menu);

        $nav = "";
        foreach ($menu as $k=>$v){
            $nav .= '<dl id="menu-'.$v['name'].'">'.PHP_EOL;
            $nav .= '<dt><i class="Hui-iconfont">&#xe62d;</i>'.$v['title'].'<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>'.PHP_EOL;
            $nav .= '<dd>'.PHP_EOL;

            if(!empty($v['child'])){
                $nav .= '<ul>'.PHP_EOL;
                foreach ($v['child'] as $key=>$value){
                    $nav .= '<li><a href=<#:url("'.$value['name'].'")#> title='.$value['title'].'>'.$value['title'].'</a></li>'.PHP_EOL;
                }
                $nav .= '</ul>'.PHP_EOL;
            }
            $nav .= '</dd>'.PHP_EOL;
            $nav .= '</dl>'.PHP_EOL;
        }

        dump($nav);

die;






        return 'hello admin';
    }


}