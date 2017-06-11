<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2017/6/10
 * Time: 18:06
 */
namespace Back\Controller;

use Org\Util\Captchar;
use Think\Controller;

class UserController extends Controller
{

    //显示用户登陆界面
    public function userlogin()
    {
        if (IS_POST) {

        } else {

            $this->display();
        }
    }

    //用户注册界面
    public function register()
    {
        if(IS_POST){

        }else{
            $this->display();
        }
    }



    //显示管理员登陆界面
    public function adminlogin()
    {
        if(IS_POST){
            //当数据提交过来,接收数据
            $username=I('post.admin_user');
            $password=md5(I('post.admin_pwd'));

            //后台也要进行验证码的验证

            $captchar=I('post.captchar');
            //验证验证码是否正确
            $result=check($captchar);
            if(!$result){
                //验证码错误
                session('error','验证码错误！');
                $this->redirect('adminlogin');
                die;
            }

            $model=M('admin_info');
            $cond=[
                'admin_user'=>$username,
                'admin_pwd'=>$password,
            ];
            $res=$model->where($cond)->select();
            if($res){
                //登陆成功
                session('username',$username);
                $this->redirect('Back/Admin/index');
            }else{
                //登陆失败
                $error='用户名或者密码错误！';
                session('error',$error);//将错误信息存储到session中
                $this->redirect('adminlogin');
            }

        }else{
            $this->display();
            session('error',null);//使用完毕，清除session
        }
    }

    //显示验证码
    public function showCaptchar()
    {
        $captchar = new Captchar();
        //设置字体文件的路径
        $captchar->fontfile = './Public/Fonts/STXINWEI.TTF';
        $captchar->makeImage();//生成验证码图像

    }

    //ajax操作验证验证码是否正确
    public function checkcode()
    {
        //接收ajax传递过来的验证码
        $code = I('request.code');
//        $captchar = new Captchar();
//        $result = $captchar->checkCode($code);

        $result=check($code);//使用自定义函数中封装好的验证码验证方法

        if ($result) {
            //验证码正确
            $data = array(
                'flag' => 1,
                'mes' => '验证码正确'
            );

            $this->ajaxreturn($data);
        } else {
            //验证码错误
            $data = array(
                'flag' => 0,
                'mes' => '验证码错误'
            );
            $this->ajaxreturn($data);
        }

    }

    //ajax验证用户名是否重复
    public function checkname()
    {
        //接收ajax传递过来的用户名
        $username=I('request.username');
        $model=M('user_info');
        $cond=[
            'user_name'=>$username
        ];
        $res=$model->where($cond)->select();
        if($res){
            //说明用户名已经存在，无法注册
            $data=[
                'flag'=>0,
                'mes'=>'用户名已经被注册'
            ];
            $this->ajaxreturn($data);
        }else{
            //说明用户名不存在，可以注册
            $data=[
                'flag'=>1,
                'mes'=>'该用户名可以使用'
            ];
            $this->ajaxreturn($data);

        }
    }
}
