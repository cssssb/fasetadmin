<?php

namespace app\admin\controller\user;

use app\common\controller\Backend;
use think\Db;

/**
 * 会员管理
 *
 * @icon fa fa-user
 */
class User extends Backend
{

    protected $relationSearch = true;


    /**
     * @var \app\admin\model\User
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('User');
    }

    /**
     * 查看
     */
    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $total = $this->model
                ->with('group')
                ->where($where)
                ->order($sort, $order)
                ->count();
            $list = $this->model
                ->with('group')
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            foreach ($list as $k => $v) {
                $v->hidden(['password', 'salt']);
            }
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }

    /**
     * 编辑
     */
    public function edit($ids = NULL){
    //     var_dump(json_decode($row,true));die;
        if(isset($_POST['row']['money'])){
            DB::startTrans();
            try{
            //管理员数量
            $admin_number = (int)DB::name('admin')->where('id',$this->auth->id)->find()['number'];
            if($admin_number<$_POST['row']['money']){
                echo json_encode(['code'=>0,'data'=>"",'msg'=>'管理员余额不足','url'=>'','wait'=>3],JSON_UNESCAPED_UNICODE);die;
            }
            DB::name('user')->where('id',$ids)->setInc('money',$_POST['row']['money']);
            DB::name('admin')->where('id',$this->auth->id)->setDec('number',$_POST['row']['money']);
            $data = [
                'admin_id'=>$this->auth->id,
                'admin_name' =>$this->auth->nickname,
                'details' =>'管理员:'.$this->auth->nickname.'给用户充值'.$_POST['row']['money'].'点,管理员余额:'.((int)$this->auth->number-(int)$_POST['row']['money']),
                'c_time' =>date('Y-m-d H:i:s',time()),
                'update_number'=>$_POST['row']['money'],
                'have_number'=>$this->auth->number-$_POST['row']['money']
            ];
            DB::name('admin_number_log')->where('id',$this->auth->id)->insert($data);
            DB::commit();
            }catch(\Exception $e){
                                var_dump($e->getLine());die;

                Db::rollback();
                $this->error('转账失败');
            }
            $this->success('转账成功');
            
        }
        $row = $this->model->get($ids);
        if (!$row)
            $this->error(__('No Results were found'));
        $this->view->assign('groupList', build_select('row[group_id]', \app\admin\model\UserGroup::column('id,name'), $row['group_id'], ['class' => 'form-control selectpicker']));
        $data =  parent::edit($ids);

        return $data;
    }
}
