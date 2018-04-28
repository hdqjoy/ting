<?php
/**
 * Created by PhpStorm.
 * User: hdqjo
 * Date: 2018/4/16
 * Time: 22:16
 */

namespace app\admin\controller;
use think\Db;
use think\facade\Request;
use app\admin\model\Admin as AdminModel;


class Admin extends AdminBase
{

    // 代理商列表
    public function index(){

        $sdate = input('param.sdate',date('Y-m-01'));
        $edate = input('param.edate',date('Y-m-d'));
        $account = input('param.account','');

        $db = new AdminModel();
        $list = $db->where('state','>','-1')
                    ->where('create_time','>=',strtotime($sdate))
                    ->where('create_time','<', strtotime($edate))
                    ->whereLike('account',"%$account%")
                    ->paginate(config('list_rows'),false,['query'=>request()->param()]);
        $total = $list->total();
        $page = $list->render();

        $this->assign('list',$list);
        $this->assign('total',$total);
        $this->assign('page',$page);
        $this->assign('sdate',$sdate);
        $this->assign('edate',$edate);
        $this->assign('account',$account);
        return $this->view->fetch('index',['title'=>'管理员列表']);
        

    }

    // 添加代理商
    public function add(){
        
        if(Request::isPost()){

            $db = new AdminModel();
            
            $is_exit = $db::get(['account'=>input('post.account')]);
            if($is_exit == null){   // 添加登录账号不存在时，才能添加

                $passwd = md5(input('post.passwd').config('salt'));
                $data = [
                    'admin_name' => input('post.admin_name'),
                    'account' => input('post.account'),
                    'passwd' => $passwd,
                    'role' => input('post.role'),
                    'phone' => input('post.phone'),
                    'email' => input('post.email'),
                ];

                $res = $db->data($data)->save();
                if($res){
                    return ajaxReturn(1,'添加成功');
                }else{
                    return ajaxReturn(0,'添加失败');
                }
            }else{
                return ajaxReturn(0,'该用登录账号存在，请使用其他账号添加');
            }
        }else{
            return $this->view->fetch('add',['title'=>'添加管理员']);
        }
    }

    // 编辑代理商
    public function edit(){
        $db = new AdminModel();

        if(Request::isPost()){
            
            $user = $db::get(input('post.id'));

            $user->admin_name = input('post.admin_name');
            $user->role = input('post.role');
            $user->phone = input('post.phone');
            $user->email = input('post.email');
            $user->update_time = time();
            if(input('post.passwd') != ''){
                $passwd = md5(input('post.passwd').config('salt'));
                $user->passwd = $passwd;
            }

            $res = $user->save();
            if($res){
                return ajaxReturn(1,'修改成功');
            }else{
                return ajaxReturn(0,'修改失败');
            }

        }else{
            
            $adminInfo = $db->where('id',input('get.id'))->find();

            $this->assign('admin',$adminInfo);
            return $this->view->fetch('edit',['title'=>'编辑管理员']);
        }
    }

    // 删除代理商
    public function del(){
        $db = new AdminModel();
        $id = input('post.id');

        $res = $db->where('id', $id)
            ->update(['state' => '-1','delete_time'=>time()]);
        
        if($res){
            return ajaxReturn(1,'删除成功');
        }else{
            return ajaxReturn(0,'删除失败');
        }
    }

    // 修改用户是否启用的状态
    public function chgState(){
        $db = new AdminModel();
        $id = input('post.id');
        $state = input('state');

        if($state == 1){
            $data = ['state'=>0,'update_time'=>time()];
        }elseif ($state == 0){
            $data = ['state'=>1,'update_time'=>time()];
        }else{
            $data = array();
        }

        $res = $db->where('id',$id)
            ->data($data)
            ->update();

        if($res){
            return ajaxReturn(1,'修改成功');
        }else{
            return ajaxReturn(0,'修改失败');
        }

    }
}