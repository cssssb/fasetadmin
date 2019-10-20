<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Sms;
use think\Config;
use think\Cookie;
use think\Hook;
use think\Session;
use think\Validate;
use think\Db;

/**
 * 会员中心
 */
class Recharge extends Frontend
{
    // public function __construct()
    // {
    //     $url = $this->request->request('url', '', 'trim');
    //     $referer = $this->request->server('HTTP_REFERER');
    //     if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
    //         && !preg_match("/(user\/login|user\/register|user\/logout)/i", $referer)) {
    //         $url = $referer;
    //     }
    // }
    public function _initialize()
    {
        parent::_initialize();
        $auth = $this->auth;

        if (!Config::get('fastadmin.usercenter')) {
            $this->error(__('User center already closed'));
        }

        //监听注册登录注销的事件
        Hook::add('user_login_successed', function ($user) use ($auth) {
            $expire = input('post.keeplogin') ? 30 * 86400 : 0;
            Cookie::set('uid', $user->id, $expire);
            Cookie::set('token', $auth->getToken(), $expire);
        });
        Hook::add('user_register_successed', function ($user) use ($auth) {
            Cookie::set('uid', $user->id);
            Cookie::set('token', $auth->getToken());
        });
        Hook::add('user_delete_successed', function ($user) use ($auth) {
            Cookie::delete('uid');
            Cookie::delete('token');
        });
        Hook::add('user_logout_successed', function ($user) use ($auth) {
            Cookie::delete('uid');
            Cookie::delete('token');
        });
    }

    /**
     * 空的请求
     * @param $name
     * @return mixed
     */
    public function _empty($name)
    {
        $data = Hook::listen("user_request_empty", $name);
        foreach ($data as $index => $datum) {
            $this->view->assign($datum);
        }
        return $this->view->fetch('user/' . $name);
    }

    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-19
     * @Return:        
     * @Notes:         卡密充值view
     * @ErrorReason:   
     * ================
     */
    public function charlierecharge(){
        // $url = $this->request->request('url', '', 'trim');
       
        $this->view->assign('title', '卡密充值');
        return $this->view->fetch();

    }
    
    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-19
     * @Return:        
     * @Notes:         充值订单
     * @ErrorReason:   
     * ================
     */
    public function rechargeorder(){

    }

    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-19
     * @Return:        
     * @Notes:         余额日志
     * @ErrorReason:   
     * ================
     */
    public function balancelog(){

    }
}
