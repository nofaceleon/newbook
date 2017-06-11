<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2017/6/10
 * Time: 22:30
 */
namespace Back\Controller;

use Think\Controller;
use Think\Page;

class AdminController extends Controller
{

    //显示管理员后台界面
    public function index()
    {
        $this->display();
    }

    //查询用户界面的显示
    public function userinfo()
    {

            $model = M('user_info');

            //添加搜索条件
            $keyword=I('get.keyword','');

            $cond="user_name like '$keyword%' or user_true_name like '$keyword%'";
            //对数据进行分页
            $limit = 5;//每页显示多少条数据

            $total = $model->where($cond)->count();//符合条件的总共多少条数据

            //trace($total);
            //实例化分页类
            $page = new Page($total, $limit);
            //定制分页样式
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('theme', '<ul class="pagination"> %FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% </ul>');

            //添加需要查询的字段
            $fields = [
                'user_name',
                'user_true_name',
                'user_address',
                'user_tel',
                'user_add_time',
                'user_access'
            ];
            $user_list = $model->field($fields)->where($cond)->limit($page->firstRow . ',' . $page->listRows)->select();
            $this->assign('user_list', $user_list);
            $this->assign('empty', '<tr><td colspan="8">暂时没有用户信息！</td></tr>');
            $show = $page->show();
            $this->assign('show', $show);

            //回显搜索的内容
            $this->assign('keyword',$keyword);
            $this->assign('total',$total);
            $this->display();


    }

    //注销操作
    public function outlogin()
    {
        session('username', null);
        $url = U('Back/User/adminlogin');
        echo "<script>window.location.href='$url';</script>";//使用js跳转
    }


}