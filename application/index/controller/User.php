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
        // $this->view->assign('title','卡密充值');
        if (!$_GET['has_pwd']) {
            echo "<script>alert('请输入查询卡号');history.go(-1);</script>";
        }
        $haspwd = $_GET['has_pwd'];
        $data = $this->_findhaspwd($haspwd);
        if($data['user_id']){
            $msg['msg'] = '已被绑定';
        }else{
            $msg['data'] = $data;
        }

        $this->_postjsonencode($msg);
        // $this->view->assign('data',$data);
        // return $this->view->fetch();
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
        $msg['msg'] = '缺少参数';
        if(!isset($_GET['has_pwd'])){
            return $this->_postjsonencode($msg);
        }else{
            $haspwd = $_GET['has_pwd'];
        }
        //判断是否有人已经绑定过了
        $has_data = $this->_findhaspwd($haspwd);
        if($has_data['user_id']){
            $msg['msg'] = '已经被绑定';
            return $this->_postjsonencode($msg);
        }
        $time = date('Y-m-d H:i:s');
        $update = ['user_id'=>$this->auth->id,'c_time'=>$time];
        if(DB::name('rechargeablecard')->where('has_pwd','=',$haspwd)->update($update)){
            //修改余额
            DB::name('user')->where('id',$this->auth->id)->setInc('money',$has_data['number']);
            //添加到余额日志
            $data=['describe' => '充值',
                    'user_id'=>$this->auth->id,
                    'user_name'=>$this->auth->nickname,
                    'number'=>$has_data['number'],
                    'remainder'=>$this->auth->money+$has_data['number'],
                    'type'=>1,
                    'c_time'=>date('Y-m-d H:i:s',time())
                ];
            DB::name('rechargeablecard_log')->insert($data);
             $msg['msg']='兑换成功';
             return $this->_postjsonencode($msg);
        }else{
            $msg['msg']='兑换失败';
            return $this->_postjsonencode($msg);
        };
    }
    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-24
     * @Return:        
     * @Notes:         兑换点数
     * @ErrorReason:   
     * ================
     */
    public function exchangepoints(){
        $this->view->assign('money',$this->auth->money);
        $server_list = $this->_getServerWithUser();
        $this->view->assign('server_list',$server_list);
        return $this->view->fetch();
    }
    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-27
     * @Return:        
     * @Notes:         兑换点数的提交
     * @ErrorReason:   
     * ================
     */
    public function buttenexchangepoints(){
        //验证用户余额是否足够购买
        isset($_GET['amount_id'])?$where['id']=$_GET['amount_id']:$this->_postjsonencode(['msg'=>'缺少参数']);
        isset($_GET['number'])?true:$_GET['number']=1;
        $amount_data = DB::name('exchange_amount')->where($where)->find();
        $price = $amount_data['price'] * (int)$_GET['number'];
        if($this->auth->money<$price){
            $msg['msg'] = '余额不足';
            $this->_postjsonencode($msg);
        }
        //购买  减去金额 增加points里服务器数量的个数
        DB::name('user')->where('id',$this->auth->id)->setDec('money',$price);
        $where = [];
        $where['user_id'] = $this->auth->id;
        $where['type'] = $_GET['amount_id'];
        if(DB::name('exchange_points')->where($where)->find()){
        DB::name('exchange_points')->where($where)->setInc('number',$_GET['number']);}else{
            $data['user_id'] = $this->auth->id;
            $data['number'] = $_GET['number'];
            $data['type'] = $_GET['amount_id'];
            $data['create_time'] = date('Y-m-d H:i:s');
            DB::name('exchange_points')->insert($data);
        }
        
        //写入余额日治
        $data = [];
        $data['user_id'] = $this->auth->id;
        $data['user_name'] = $this->auth->nickname;
        $data['type'] = 0;
        $data['number'] = $price;
        $data['remainder'] = $this->auth->money-$price;
        $data['describe'] = '购买'.$amount_data['name'].':'.$_GET['number'].' 花费:'.$price.' 余额'.($this->auth->money-$price);
        $data['c_time'] = date('Y-m-d H:i:s');
        DB::name('rechargeablecard_log')->insert($data);
        $msg['msg'] = '操作成功';
        $this->_postjsonencode($msg);die;
    }
     /**
      * ================
      * @Author:        css
      * @Parameter:     
      * @DataTime:      2019-10-24
      * @Return:        
      * @Notes:         交易记录
      * @ErrorReason:   
      * ================
      */

      public function transaction(){
        $server_list = $this->_getServerWithUser();
        $logger = DB::name('exchange_log')->where('user_id='.$this->auth->id)->select();
        
        foreach ($logger as &$key) {
            foreach ($server_list as $k){
                if($k['id'] = $key['amount_id']){
                    $key['amount_name'] = $k['name'];
                }
            }
            if($key['manage']==0){
                $key['manage']='兑换';
            }else{
                $key['manage']='消费';
            }
            if($key['state']==0){
                $key['state'] = '减少';
            }else{
                $key['state'] = '增加';
            }
        }
        $user_money = $this->auth->money;
        $this->view->assign('title','交易记录');
        $this->view->assign('server_list',$server_list);
        $this->view->assign('logger',$logger);
        $this->view->assign('user_money',$user_money);
        return $this->view->fetch();
      }
    //输入卡密查找指定卡
    private function _findhaspwd($has_pwd){
        return DB::name('rechargeablecard')->where('has_pwd','=',$has_pwd)->find();
    }
    //获取服务器列表
    private function _getServerList(){
        return DB::name('exchange_amount')->select();
    }
    //获取用户各服务器点数
    private function _getuserServernumber(){
        return DB::name('exchange_points')->alias('p')->join('exchange_amount a','p.type=a.id','left')->where('user_id='.$this->auth->id)->select();
    }

    private function _postjsonencode($msg){
        echo json_encode($msg,JSON_UNESCAPED_UNICODE);
    }
    public function getserverlist(){
        return $this->_postjsonencode($this->_getServerList());
    }

    private function _getServerWithUser(){
        $server_list = $this->_getServerList();
        $user_server_number = $this->_getuserServernumber();
        foreach($server_list as &$k){
            if(count($user_server_number)>=1){
                foreach($user_server_number as $key){
                    if($key['type']==$k['id']){
                        $k['user_number'] = $key['number'];
                    }else{
                        $k['user_number'] =0;
                    }
                }
            }else{
                $k['user_number'] = 0;
            }
        }
        return $server_list;
    }

    /**
     * ================
     * @Author:        css
     * @Parameter:     
     * @DataTime:      2019-10-27
     * @Return:        
     * @Notes:         黑名单自助解封
     * @ErrorReason:   
     * ================
     */

     /**
      * ================
      * @Author:        css
      * @Parameter:     
      * @DataTime:      2019-10-27
      * @Return:        
      * @Notes:         主账号 查询类型 用户账号
      * @ErrorReason:   
      * ================
      */

      /**
       * ================
       * @Author:        css
       * @Parameter:     
       * @DataTime:      2019-10-27
       * @Return:        
       * @Notes:         申请动态/静态
       * @ErrorReason:   
       * ================
       */

    
        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-27
         * @Return:        
         * @Notes:         动态/静态列表
         * @ErrorReason:   
         * ================
         */
    
        //  public function 

        //md5(代理AgentId+代理AgentSecret+QueryString(不包括sign)+秒级timestamp)
        // agentid	string	代理API接口分配的 AgentID
        // sign	string	请求签名 计算方式详见 5
        // timestamp	string	秒级时间戳
        // agent_id：u6wjww1wc32rizyido7uwwacmvlbwuue 
        // agent_sec: of67j67lpc1hr0x3dyyae3w61fbdr11o
        private function _httpget(){
            $this->agent_id = 'u6wjww1wc32rizyido7uwwacmvlbwuue';
            $this->agent_sec = 'of67j67lpc1hr0x3dyyae3w61fbdr11o';
            $_url = 'agent';
            $url = 'http://b.api.vpn.cn:8080';
            header('Content-type:application/json;charset=utf-8');
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//禁止curl验证对等证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//  ssl证书公用名
            curl_setopt($ch, CURLOPT_URL, $url);//需要获取的url地址
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//将获取的数据以字符串形式输出 而不是直接输出
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            if ($data === false) {
                return "CURL Error:" . curl_error($ch);
            }
            return json_decode($data, true);
        }
}
