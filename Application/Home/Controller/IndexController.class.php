<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        if (IS_POST) {

        } else {
            //从数据库中查询出来数据显示到页面上
            $model = M('goods_info');
            $book_list = $model->order('goods_add_time desc')->limit('10')->select();//只显示10条

            //从数据库中随机选取10本书
            $focus_list = $model->order('rand()')->limit('6')->select();

            //图书分类的显示
            $category_list=M('goods_category')->field(['cat_id','cat_name'])->select();

            //畅销图书榜
            $hot_list=$model->field(['goods_name','goods_sales'])->order('goods_sales desc')->limit('10')->select();



            $this->assign('book_list', $book_list);//显示新书速递
            $this->assign('focus_list', $focus_list);//显示可能喜欢
            $this->assign('category_list', $category_list);//显示图书分类
            $this->assign('hot_list', $hot_list);//显示畅销图书榜
            $this->display();
        }

    }
}