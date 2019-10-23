<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use think\Db;

/**
 * 
 *
 * @icon fa fa-circle-o
 */
class Rechargeorder extends Backend
{
    
    /**
     * Rechargeorder模型对象
     * @var \app\admin\model\Rechargeorder
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Rechargeorder;

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
    public function add(){
        if($this->request->post()){
            $data = $this->request->post()['row'];
            $data['cadmin_time'] = date("Y-m-d H:i:s", time());
            DB::name('rechargeablecard')->insert($data);
            echo ("<script>setTimeout('window.location.reload()', 1);</script>");
        }
        $has_pwd = $this->getName(16);
        $this->view->assign('has_pwd', $has_pwd);
        return $this->view->fetch();
    }
    function getName($n=16) { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
    if(DB::name('rechargeablecard')->where('has_pwd','=','`'.$randomString.'`')->find()){
        return $this->getName();
    }
       
    
        return $randomString; 
    
    } 

    /**
     * 查看
     */
    public function index()
    {
        if ($this->request->isAjax()) {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams(null);
            $total = $this->model
                ->where($where)
                ->order($sort, $order)
                ->count();

            $list = DB::name('rechargeablecard')
                ->alias('r')
                ->join('user u','r.user_id=u.id','left')
                ->join('admin a','a.id=r.admin_id','left')
                ->field('r.*,u.nickname user_id,a.username admin_id')
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
}
}