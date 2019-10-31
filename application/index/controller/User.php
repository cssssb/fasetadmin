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
    private static $_url='';
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
        $this->_server_url = 'http://b.api.vpn.cn:8080';
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
            isset($_GET['inviter'])?$additional_data['inviter'] = $_GET['inviter']:false;
            if ($this->auth->register($username, $password, $email, $mobile,$additional_data)) {
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
        // agent_id：wvohjijo4gdrwmswawqsrxlbptpl5rd6 
        // agent_sec: 3m6710mpz6py4os28uxgmnawxkfjlwrc
        private function _httpget(){
            
            $this->agent_id = 'wvohjijo4gdrwmswawqsrxlbptpl5rd6';
            $this->agent_sec = '3m6710mpz6py4os28uxgmnawxkfjlwrc';
            $_url = 'timestamp='.time().'&agentid='.$this->agent_id.self::$_url;
            $sign = md5($this->agent_id.$this->agent_sec.$_url.time());
            $url = $this->_server_url.$this->url.$_url.'&sign='.$sign;
            header('Content-type:application/json;charset=utf-8');
            $demo = 'http://[代理接口地址]/agent/create?agentid=aaa&count=10&cusId=2602&defaultLink=1&timestamp=1546409119&sign=4594587996bae3728047ed807c7e36dd';
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
        
        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-28
         * @Return:        
         * @Notes:         代理余额查询
         * @ErrorReason:   
         * ================
         */
        public function agentBalanceQuery(){
            $this->url = '/agent/getbalance?';
            $data = $this->_httpget();
            // var_export($data);
            //array ( 'code' => 0, 'message' => 'success', 'data' => array ( 'count' => 9332719, 'days' => 0, ), )
        }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-28
         * @Return:        
         * @Notes:         线路列表
         * @ErrorReason:   
         * ================
         */
        public function lineList(){
            $this->url = '/agent/getlinklist?';
            $data = $this->_httpget();
            // var_dump($data);
            return $this->_postjsonencode($data);
        }
        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-28
         * @Return:        
         * @Notes:         vpn账号创建（）
         * @ErrorReason:   
         * 
         * ================
         */
        // cusId	是	int	客户id
        // name	是	string	账号名 仅允许字母数字
        // password	是	int	密码 仅允许字母数字
        // linkId	是	string	授权线路集合 1,2,3,4,5(当传9999时，授权路线是所有开启状态的路线)
        // defaultLink	是	int	默认线路 包年包月账号随机分配线路时此参数失效
        // expireDate	是	string	过期时间 2018-01-15
        // isp	是	int	运营商 1联通 2电信 3移动 4联通电信 0不限
        // accountTotal	是	int	包年包月账号(静态)创建数量，按次计费账号（动态）无此参数
        // count	是	int	按次计费账号ip切换次数，包年包月账号无此参数（count传了>=0就是动态，count不传就是静态）
        // rand	否	boolean	随机分配线路 1所选线路随机分配 0无随机。默认0，非必须参数。仅包年包月账号有效，固定分配默认线路时无效
        // type	否	int	创建单个账号时是否名称增加01 默认增加01 type=1时不增加01
        // timeoutExec	是	string	设置动态账号在线超时后账号状态 add 增加一个使用次数/offline 账号下线
        public function agentCreate(){
            
            $_GET['expireDate']='2099-12-31';
            $param = 'name,password,linkId,defaultLink,isp';
            $param = $this->_dataFilter($param);
            $param['accountTotal'] = $this->_dataFilter('accountTotal',false);//静态数量 动态无此参数
            $param['timeoutExec'] = $this->_dataFilter('timeoutExec',false);//动态设置超时状态 静态无此参数
            $param['expireDate'] = $this->_dataFilter('expireDate',false);//静态到期时间，动态无此参数
            $param['count'] = $this->_dataFilter('count',false);//动态切换ip次数，静态无此参数
            $param['rand'] = $this->_dataFilter('rand',false);
            $param['type'] = $this->_dataFilter('type',false);
            // expireDate
            self::$_url.='&cusId='.$this->auth->system_id;
            // echo self::$_url;
            //todo 判断是哪个服务器 写死的如果是1为e服务器
            // if($_GET['serve_id']==1){
            //     //修改访问地址
            // $this->_server_url = 'https://e.api.vpn.cn:8080';
            // }
            $this->url = '/agent/create?';
            $data = $this->_httpget();
            return $this->_postjsonencode($data);
        }
        

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         vpn账号查询 /|?
         * @ErrorReason:   
         * ================
         */
        public function agentSearch(){
            $param = 'cusId,id';
            $param = $this->_dataFilter($param);
            $this->url = '/agent/search/?';
            $data = $this->_httpget();
            return $this->_postjsonencode($data);
        }


        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         vpn账号充值
         * @ErrorReason:   
         * ================
         */
        public function agentRecharge(){
            $param = 'name';
            $param = $this->_dataFilter($param);
            $param['days'] = (int) $this->_dataFilter('days',false);//int
            $param['count'] = $this->_dataFilter('count',false);
            $param['cusId'] = $this->auth->serve_id;
            $msg['msg'] = '操作有误';
            if(isset($param['days'])||isset($param['count'])){
                $this->url = '/agent/recharge/?';
                $data = $this->_httpget();
                return $this->_postjsonencode($data);
            }
            return $this->_postjsonencode($msg);

        }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         客户列表
         * @ErrorReason:   
         * ================
         */
        public function getCustomersList(){
            $this->url = '/agent/getCustomersList/?';
            return $this->_postjsonencode($this->_httpget());
        }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         修改vpn账号基础信息 
         * @ErrorReason:   
         * ================
         */
        // id	是	string	VPN账号id集合 1,2,3
        // cusId	是	int	客户id
        // password	是	string	密码
        // status	是	int	账号状态 1启用 0禁用
        // isp	是	int	运营商设置 0 不限 1联通 2电信 3移动 4 联通电信
        // timeoutExec	是	string	设置动态账号在线超时后账号状态 add 增加一个使用次数/offline 账号下线
        public function agentChangeAccBaseDatal(){
            $param = 'id,password,status,isp';
            $param = $this->_dataFilter($param);
            //如果有此参数是修改动态的vpn
            $param['timeoutExec'] = $this->_dataFilter('timeoutExec',false);
            self::$_url .= '&cusId='.$this->auth->system_id;
            $this->url = '/agent/changeAccBaseData/?';
            $data = $this->_httpget();
            return $this->_postjsonencode($data);
        }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         修改vpn账号线路信息 
         * @ErrorReason:   
         * ================
         */
        // id	是	string	VPN账号id集合 1,2,3
        // cusId	是	int	客户id
        // linkId	是	string	线路id集合 linkId=1,2,3
        // defaultLink	是	int	默认线路id
        // rand	否	int	是否随机分配线路 1随机 0固定
        // ip	否	string	要切换的客户端公网IP,不传则账号所有ip都会进行切换
        // updateIp	是	int	是否强制更换IP地址:1=是,0=否
         public function agentChangeAccEnableLinks(){
             $param = 'id,linkId,defaultLink,updateIp';
             $param = $this->_dataFilter($param);
             $param['rand'] = $this->_dataFilter('rand',false);
             $param['ip'] = $this->_dataFilter('ip',false);
             self::$_url .= '&cusId='.$this->auth->system_id;
             $this->url = '/agent/changeAccEnableLinks/?';
             $data = $this->_httpget();
             return $this->_postjsonencode($data);
            //  {
            //     "code":0,
            //     "message":"success",
            //     "data":{}
            // }
         }

         /**
          * ================
          * @Author:        css
          * @Parameter:     
          * @DataTime:      2019-10-30
          * @Return:        
          * @Notes:    动态账号共享点数充值     
          * @ErrorReason:   
          * ================
          */
          public function agentRechargeDynShareByCustomId(){
            $param['count'] = $this->_dataFilter('count');
            self::$_url .= '&cusId='.$this->auth->system_id;
            $this->url = '/agent/rechargeDynShareByCustomId';
            $data = $this->_httpget();
            return $this->_postjsonencode($data);
          }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         VPN账号按名称查询
         * @ErrorReason:   
         * ================
         */
        // 参数名	必选	类型	说明
        // cusId	是	int	客户id
        // name	是	string	账号名称集合 A,B,C
        // page	是	int	请求第几页的数据（默认每页返回50条数据）
         public function agentSearchAccByName(){
             $param = 'name,page';
             $param = $this->_dataFilter($param);
             self::$_url .= '&cusId='.$this->auth->system_id;
             $this->url = '/agent/searchAccByName/?';
             $data = $this->_httpget();
             return $this->_postjsonencode($data);
         }
        //  {
        //     "code": 0,
        //     "message": "success",
        //     "data": {
        //         "count": "69",  //总数量
        //         "pages": 2,     //总页数
        //         "cur_page": 1,  //当前页
        //         "size": 50,     //每页返回的数量
        //         "accList": [{
        //             "id": 21266,
        //             "accType":"static",
        //             "cusId": 274,
        //             "groupId": 1754,
        //             "username": "ah10053",
        //             "expireTime": "2028-08-17 23:59:59",
        //             "linkList": [{
        //                 "linkId": 95,
        //                 "isDefault": 1
        //             }],
        //             "isp": 1,
        //             "isOnline": 0,
        //             "dynShare": {
        //                 "used": 0,
        //                 "total": 0
        //             },
        //             "timeoutExec": "add",
        //             "surplus": 30
        //         }]
        //     }
        // }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-30
         * @Return:        
         * @Notes:         VPN账号按客户查询
         * @ErrorReason:   
         * ================
         */
        // cusId	是	int	客户id
        // page	是	int	请求第几页的数据（每页默认返回50条）

        public function agentSearchAccByCid(){
            $param['page'] = $this->_dataFilter('page');
            self::$_url .= '&cusId='.$this->auth->system_id;
            $this->url = '/agent/searchAccByCid/?';
            $data = $this->_httpget();
            return $this->_postjsonencode($data);
        }


        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-28
         * @Return:        
         * @Notes:         数据过滤
         * @ErrorReason:   
         * ================
         */
        private function _dataFilter($array, $strict = true)
        {
            is_array($array) ? true : $array = explode(',', $array);
            $data = [];
            foreach ($array as $key) {
                if(isset($_GET[$key])) {
                    $data[$key] = $_GET[$key];
                    self::$_url .="&$key=$_GET[$key]";
                }
                if ($strict) {
                    !isset($data[$key]) ? exit($this->_postjsonencode(['msg'=>"缺少参数$key"])) : true;
                } else {
                    if (!isset($data[$key])) {
                        unset($data[$key]);
                    }
                }
            }
            return $data;
        }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-28
         * @Return:        
         * @Notes:         查询ip被拉黑
         * @ErrorReason:   
         * ================
         */
        public function blacklistedQuery(){
            $param = 'ip';
            $param = $this->_dataFilter($param,true);
            $this->url = '/agent/checkClientIpIsBlock?';
            $data = $this->_httpget('&ip='.$param['ip']);
            return $this->_postjsonencode($data);
            // 参数名	类型	说明
            // remote_ip	string	客户端IP
            // acc	string	账号名称
            // lot	int	屏蔽时长，单位为秒
            // create_time	int	记录创建时间
            // message	string	屏蔽原因
            // {
            //     "code": 0,
            //     "message": "success",
            //     "data": {
            //       "searchList": {
            //         "remote_ip": "客户端IP",
            //         "acc": "账号名称",
            //         "lot": 屏蔽时长，单位为秒,
            //         "create_time": 记录创建时间,
            //         "message": "屏蔽原因"
            //       }
            //     }
            //   }
        }

        /**
         * ================
         * @Author:        css
         * @Parameter:     
         * @DataTime:      2019-10-28
         * @Return:        
         * @Notes:         删除被拉黑的ip
         * @ErrorReason:   
         * ================
         */
        public function deleteBlack(){
            $param = 'ip';
            $param = $this->_dataFilter($param,true);
            $this->url = '/agent/removeClientIpBlock?';
            $data = $this->_httpget('&ip='.$param['ip']);
            return $this->_postjsonencode($data);

            // {
            //     "code": 0,
            //     "message": "success",
            //     "data": {}
            //   }
        }
}
