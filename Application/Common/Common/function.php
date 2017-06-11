<?php
/**
 * Created by PhpStorm.
 * User: song
 * Date: 2017/6/10
 * Time: 19:00
 */

//公共函数中写验证码校验的方法，因为验证码验证需要用在很多地方
function check($code)
{
    $captchar=new \Org\Util\Captchar();
    $res=$captchar->checkCode($code);
    return $res;


}