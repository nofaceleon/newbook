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
        $captchar = new Captchar();
        $result = $captchar->checkCode($code);

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
}
