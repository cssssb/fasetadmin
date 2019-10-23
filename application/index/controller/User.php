<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Sms;
use think\Config;
use think\Cookie;
use think\Hook;
use think\Session;
use think\Validate;
use app\common\model\User as Usermodel;
use think\Db;

/**
 * 会员中心
 */
class User extends Frontend
{
    protected $layout = 'default';
    protected $noNeedLogin = ['login', 'register', 'third'];
    protected $noNeedRight = ['*'];
    
    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-14
     * @Return:        
     * @Notes:         邀请返利
     * @ErrorReason:   
     * ================
     */
    public function invite(){
        $url = $this->request->request('url', '', 'trim');
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register|user\/logout)/i", $referer)) {
            $url = $referer;
        }
        //获取被邀请人列表
        // $data['user_data'] = DB::name('user')->where('inviter='.$this->auth->id)->field('id')->select();
        $data['user_data'] = DB::name('user')->field('id,nickname,createtime')->select();
        $data['user_number'] = count($data['user_data']);
        // var_dump($data);die;
        $this->view->assign('url', $url);
        $this->view->assign('title', '邀请返利');
        $this->view->assign('data',$data);
        $this->view->assign('user_id',$this->auth->id);
        
        return $this->view->fetch();
    }
    
    
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
     * 会员中心
     */
    public function index()
    {
        $this->view->assign('title', __('User center'));
        return $this->view->fetch();
    }

    /**
     * 注册会员
     */
    public function register()
    {
            // var_dump($_GET);die;
        $url = $this->request->request('url', '', 'trim');
        if ($this->auth->id) {
            $this->success(__('You\'ve logged in, do not login again'), $url ? $url : url('user/index'));
        }
        if ($this->request->isPost()) {
            $username = $this->request->post('username');
            $password = $this->request->post('password');
            $email = $this->request->post('email');
            $mobile = $this->request->post('mobile', '');
            $captcha = $this->request->post('captcha');
            $token = $this->request->post('__token__');
            $rule = [
                'username'  => 'require|length:3,30',
                'password'  => 'require|length:6,30',
                'email'     => 'require|email',
                'mobile'    => 'regex:/^1\d{10}$/',
                '__token__' => 'require|token',
            ];

            $msg = [
                'username.require' => 'Username can not be empty',
                'username.length'  => 'Username must be 3 to 30 characters',
                'password.require' => 'Password can not be empty',
                'password.length'  => 'Password must be 6 to 30 characters',
                //'captcha.require'  => 'Captcha can not be empty',
                //'captcha.captcha'  => 'Captcha is incorrect',
                'email'            => 'Email is incorrect',
                'mobile'           => 'Mobile is incorrect',
            ];
            $data = [
                'username'  => $username,
                'password'  => $password,
                'email'     => $email,
                'mobile'    => $mobile,
                //'captcha'   => $captcha,
                '__token__' => $token,
            ];
            // $ret = Sms::check($mobile, $captcha, 'register');
            // if (!$ret) {
            //     $this->error(__('Captcha is incorrect'));
            // }
            $validate = new Validate($rule, $msg);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
            }
            if ($this->auth->register($username, $password, $email, $mobile,$_GET)) {
                // die;
                $this->success(__('Sign up successful'), $url ? $url : url('user/index'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        //判断来源
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register|user\/logout)/i", $referer)) {
            $url = $referer;
        }
        $this->view->assign('url', $url);
        $this->view->assign('title', __('Register'));
        return $this->view->fetch();
    }

    /**
     * 会员登录
     */
    public function login()
    {
        $url = $this->request->request('url', '', 'trim');
        if ($this->auth->id) {
            $this->success(__('You\'ve logged in, do not login again'), $url ? $url : url('user/index'));
        }
        if ($this->request->isPost()) {
            $account = $this->request->post('account');
            $password = $this->request->post('password');
            $keeplogin = (int)$this->request->post('keeplogin');
            $token = $this->request->post('__token__');
            $rule = [
                'account'   => 'require|length:3,50',
                'password'  => 'require|length:6,30',
                '__token__' => 'require|token',
            ];

            $msg = [
                'account.require'  => 'Account can not be empty',
                'account.length'   => 'Account must be 3 to 50 characters',
                'password.require' => 'Password can not be empty',
                'password.length'  => 'Password must be 6 to 30 characters',
            ];
            $data = [
                'account'   => $account,
                'password'  => $password,
                '__token__' => $token,
            ];
            $validate = new Validate($rule, $msg);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
                return false;
            }
            if ($this->auth->login($account, $password)) {
                $this->success(__('Logged in successful'), $url ? $url : url('user/index'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        //判断来源
        $referer = $this->request->server('HTTP_REFERER');
        if (!$url && (strtolower(parse_url($referer, PHP_URL_HOST)) == strtolower($this->request->host()))
            && !preg_match("/(user\/login|user\/register|user\/logout)/i", $referer)) {
            $url = $referer;
        }
        $this->view->assign('url', $url);
        $this->view->assign('title', __('Login'));
        return $this->view->fetch();
    }
    /**
     * 注销登录
     */
    public function logout()
    {
        //注销本站
        $this->auth->logout();
        $this->success(__('Logout successful'), url('user/index'));
    }

    /**
     * 个人信息
     */
    public function profile()
    {
        $this->view->assign('title', __('Profile'));
        return $this->view->fetch();
    }

    /**
     * 修改密码
     */
    public function changepwd()
    {
        // var_dump($this->request->isPost());die;
        if ($this->request->isPost()) {
            $oldpassword = $this->request->post("oldpassword");
            $newpassword = $this->request->post("newpassword");
            $renewpassword = $this->request->post("renewpassword");
            $token = $this->request->post('__token__');
            $rule = [
                'oldpassword'   => 'require|length:6,30',
                'newpassword'   => 'require|length:6,30',
                'renewpassword' => 'require|length:6,30|confirm:newpassword',
                '__token__'     => 'token',
            ];

            $msg = [
            ];
            $data = [
                'oldpassword'   => $oldpassword,
                'newpassword'   => $newpassword,
                'renewpassword' => $renewpassword,
                '__token__'     => $token,
            ];
            $field = [
                'oldpassword'   => __('Old password'),
                'newpassword'   => __('New password'),
                'renewpassword' => __('Renew password')
            ];
            $validate = new Validate($rule, $msg, $field);
            $result = $validate->check($data);
            if (!$result) {
                $this->error(__($validate->getError()), null, ['token' => $this->request->token()]);
                return false;
            }

            $ret = $this->auth->changepwd($newpassword, $oldpassword);
            if ($ret) {
                $this->success(__('Reset password successful'), url('user/login'));
            } else {
                $this->error($this->auth->getError(), null, ['token' => $this->request->token()]);
            }
        }
        $this->view->assign('title', __('Change password'));
        return $this->view->fetch();
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
        $data = DB::name('rechargeablecard')->where('user_id='.$this->auth->id)->select();
        $this->view->assign('title', '卡密充值');
        $this->view->assign('data', $data);
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
        $data = DB::name('rechargeablecard')->where('user_id='.$this->auth->id)->select();
        $this->view->assign('title', '充值订单');
        $this->view->assign('data', $data);
        // var_dump($data);
        return $this->view->fetch();
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
        $data = DB::name('rechargeablecard_log')->where('user_id='.$this->auth->id)->select();
        $number = DB::name('rechargeablecard')->where('user_id='.$this->auth->id)->find()['number'];
        $this->view->assign('title', '余额日志');
        $this->view->assign('data', $data);
        $this->view->assign('number', $number);
        return $this->view->fetch();
    }

    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-20
     * @Return:        
     * @Notes:         查询卡密
     * @ErrorReason:   
     * ================
     */
    public function findhaspwd(){
        //获取卡密
        if ($this->request->isPost()) {
            $haspwd = $this->request->post("has_pwd");
        }
        $data = $this->_findhaspwd($haspwd);
        $this->view->assign('title','卡密充值');
        $this->view->assign('data',$data);
        return $this->view->fetch();
    }

    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-20
     * @Return:        
     * @Notes:         兑换卡密
     * @ErrorReason:   
     * ================
     */
    public function hasexchange(){
        //获取卡密
        if(!$_GET['has_pwd']){
            echo json_encode('缺少参数',JSON_UNESCAPED_UNICODE);die;
        }else{
            $haspwd = $_GET['has_pwd'];
        }
        $update = ['user_id'=>$this->auth->id,'c_time'=>date('Y-M-D H:i:s',time())];
        if(DB::name('rechargeablecard')->where('has_pwd='.$haspwd)->update($update)){
            $has_data = $this->_findhaspwd($haspwd);
            //添加到余额日志 
            $data=['describe' => '充值',
                    'user_id'=>$this->auth->id,
                    'user_name'=>$this->auth->username,
                    'number'=>$has_data['number'],
                    'remainder'=>$has_data['number']+$this->auth->money,
                    'type'=>1
                ];
            DB::name('rechargeablecard_log')->insert($data);
             $msg['msg']='兑换成功';
            echo json_encode($msg,JSON_UNESCAPED_UNICODE);die;
        }else{
            $msg['msg']='兑换失败';
            echo json_encode($msg,JSON_UNESCAPED_UNICODE);die;
        };
    }

    //输入卡密查找指定卡
    private function _findhaspwd($has_pwd){
        return DB::name('rechargeablecard')->where('has_pwd='.$has_pwd)->find();
    }
    //修改用户余额
    private function _updateusermoney($param){
        return DB::name('user')->where('id='.$this->auth->id)->update($param);
    }

}
