<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:89:"/www/wwwroot/v.zzz80.cn/fasetadmin/public/../application/index/view/user/transaction.html";i:1572961550;s:77:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/layout/default.html";i:1572961550;s:74:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/meta.html";i:1572961550;s:77:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/sidenav.html";i:1572961550;s:76:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/script.html";i:1572961550;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?> – <?php echo __('The fastest framework based on ThinkPHP5 and Bootstrap'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<?php if(isset($keywords)): ?>
<meta name="keywords" content="<?php echo $keywords; ?>">
<?php endif; if(isset($description)): ?>
<meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>
<meta name="author" content="FastAdmin">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />

<link href="/assets/css/frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config: <?php echo json_encode($config); ?>
    };
</script>
        <link href="/assets/css/user.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#header-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="<?php echo url('/'); ?>" style="padding:6px 15px;"><img src="/assets/img/logo.png" style="height:40px;" alt=""></a> -->
                </div>
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- <li><a href="https://www.fastadmin.net" target="_blank"><?php echo __('Home'); ?></a></li>
                        <li><a href="https://www.fastadmin.net/store.html" target="_blank"><?php echo __('Store'); ?></a></li>
                        <li><a href="https://www.fastadmin.net/wxapp.html" target="_blank"><?php echo __('Wxapp'); ?></a></li>
                        <li><a href="https://www.fastadmin.net/service.html" target="_blank"><?php echo __('Services'); ?></a></li>
                        <li><a href="https://www.fastadmin.net/download.html" target="_blank"><?php echo __('Download'); ?></a></li>
                        <li><a href="https://www.fastadmin.net/demo.html" target="_blank"><?php echo __('Demo'); ?></a></li>
                        <li><a href="https://www.fastadmin.net/donate.html" target="_blank"><?php echo __('Donation'); ?></a></li>
                        <li><a href="https://forum.fastadmin.net" target="_blank"><?php echo __('Forum'); ?></a></li> -->
                        <!-- <li><a href="https://doc.fastadmin.net" target="_blank"><?php echo __('Docs'); ?></a></li> -->
                        <li class="dropdown">
                            <?php if($user): ?>
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 10px;height: 50px;">
                                <span class="avatar-img"><img src="<?php echo cdnurl($user['avatar']); ?>" alt=""></span>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo url('user/index'); ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('User center'); ?> <b class="caret"></b></a>
                            <?php endif; ?>
                            <ul class="dropdown-menu">
                                <?php if($user): ?>
                                <li><a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i><?php echo __('User center'); ?></a></li>
                                <li><a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i><?php echo __('Profile'); ?></a></li>
                                <li><a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i><?php echo __('Change password'); ?></a></li>
                                <li><a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i><?php echo __('Sign out'); ?></a></li>
                                <?php else: ?>
                                <li><a href="<?php echo url('user/login'); ?>"><i class="fa fa-sign-in fa-fw"></i> <?php echo __('Sign in'); ?></a></li>
                                <li><a href="<?php echo url('user/register'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Sign up'); ?></a></li>
                                <?php endif; ?>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content">
            <style>
        .profile-avatar-container {
            position: relative;
            width: 100px;
        }
    
        .profile-avatar-container .profile-user-img {
            width: 100px;
            height: 100px;
        }
    
        .profile-avatar-container .profile-avatar-text {
            display: none;
        }
    
        .profile-avatar-container:hover .profile-avatar-text {
            display: block;
            position: absolute;
            height: 100px;
            width: 100px;
            background: #444;
            opacity: .6;
            color: #fff;
            top: 0;
            left: 0;
            line-height: 100px;
            text-align: center;
        }
    
        .profile-avatar-container button {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            opacity: 0;
        }
    </style>
    <div id="content-container" class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="sidenav">
    <?php echo hook('user_sidenav_before'); ?>
    <ul class="list-group">
        <li class="list-group-heading"><?php echo __('User center'); ?></li>
        <li class="list-group-item <?php echo $config['actionname']=='index'?'active':''; ?>"> <a href="<?php echo url('user/index'); ?>"><i class="fa fa-user-circle fa-fw"></i> <?php echo __('User center'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i> <?php echo __('Profile'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i> <?php echo __('Change password'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='logout'?'active':''; ?>"> <a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo __('Sign out'); ?></a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='invite'?'active':''; ?>"> <a href="<?php echo url('user/invite'); ?>"><i class="fa fa-sign-out fa-fw"></i> 邀请返利</a> </li>
    </ul>
    <ul class="list-group">
        <li class="list-group-heading">充值中心</li>
        <li class="list-group-item <?php echo $config['actionname']=='charlierecharge'?'active':''; ?>"> <a href="<?php echo url('user/charlierecharge'); ?>"><i class="fa fa-user-circle fa-fw"></i> 卡密充值</a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='rechargeorder'?'active':''; ?>"> <a href="<?php echo url('user/rechargeorder'); ?>"><i class="fa fa-user-o fa-fw"></i> 充值订单</a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='balancelog'?'active':''; ?>"> <a href="<?php echo url('user/balancelog'); ?>"><i class="fa fa-key fa-fw"></i> 余额日志</a> </li>
    </ul>
    <ul class="list-group">
            <li class="list-group-heading">交易中心</li>
            <li class="list-group-item <?php echo $config['actionname']=='exchangepoints'?'active':''; ?>"> <a href="<?php echo url('user/exchangepoints'); ?>"><i class="fa fa-user-circle fa-fw"></i> 兑换点数</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='transaction'?'active':''; ?>"> <a href="<?php echo url('user/transaction'); ?>"><i class="fa fa-user-o fa-fw"></i> 交易记录</a> </li>
    </ul>
    <ul class="list-group">
            <li class="list-group-heading">连接服务器</li>
            <li class="list-group-item <?php echo $config['actionname']=='mainaccountnumber'?'active':''; ?>"> <a href="<?php echo url('user/mainaccountnumber'); ?>"><i class="fa fa-user-circle fa-fw"></i> 主账号</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='dynamic'?'active':''; ?>"> <a href="<?php echo url('user/dynamic'); ?>"><i class="fa fa-user-o fa-fw"></i> 申请动态</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='dynamiclist'?'active':''; ?>"> <a href="<?php echo url('user/dynamiclist'); ?>"><i class="fa fa-user-o fa-fw"></i> 动态列表</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='static'?'active':''; ?>"> <a href="<?php echo url('user/static'); ?>"><i class="fa fa-user-o fa-fw"></i> 申请静态</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='staticlist'?'active':''; ?>"> <a href="<?php echo url('user/staticlist'); ?>"><i class="fa fa-user-o fa-fw"></i> 静态列表</a> </li>
    </ul>
    <?php echo hook('user_sidenav_after'); ?>
</div>
            </div>
            <div class="col-md-9">
                    <div class="panel panel-default panel-recharge">
                        <div class="panel-body">
                            <h2 class="page-header">交易记录                        <span>
<small class="text-danger">余额:<?php echo $user_money; ?></small>
</span>
                                <!-- <a href="/index/recharge/recharge.html" class="btn btn-info btn-recharge pull-right">
<i class="fa fa-cny">
</i> 充值余额</a> -->
                            </h2>
                            <div class="row">
                                <?php if(is_array($server_list) || $server_list instanceof \think\Collection || $server_list instanceof \think\Paginator): if( count($server_list)==0 ) : echo "" ;else: foreach($server_list as $key=>$v): ?>
                                                  <div class="col-xs-6 col-md-2" style="text-align:right"><?php echo $v['name']; ?> : </div>
                              <div class="col-xs-6 col-md-1" style="text-align:left"><?php echo $v['user_number']; ?></div>
                              <?php endforeach; endif; else: echo "" ;endif; ?>
                            <hr>
                            
                              <div class="bootstrap-table">
<div class="commonsearch-table hidden">
<form class="form-horizontal form-commonsearch nice-validator n-default n-bootstrap" novalidate="" method="post" action="">
<fieldset>
<div class="row">
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="money" class="control-label col-xs-4">变更点数</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="money-operate" data-name="money" value="BETWEEN" readonly="">
<div class="row row-between">
<div class="col-xs-6">
<input type="text" class="form-control" name="money" value="" placeholder="变更点数" id="money" data-index="0">
</div>
<div class="col-xs-6">
<input type="text" class="form-control" name="money" value="" placeholder="变更点数" id="money" data-index="0">
</div>
</div>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="before" class="control-label col-xs-4">变更前点数</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="before-operate" data-name="before" value="BETWEEN" readonly="">
<div class="row row-between">
<div class="col-xs-6">
<input type="text" class="form-control" name="before" value="" placeholder="变更前点数" id="before" data-index="1">
</div>
<div class="col-xs-6">
<input type="text" class="form-control" name="before" value="" placeholder="变更前点数" id="before" data-index="1">
</div>
</div>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="after" class="control-label col-xs-4">变更后点数</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="after-operate" data-name="after" value="BETWEEN" readonly="">
<div class="row row-between">
<div class="col-xs-6">
<input type="text" class="form-control" name="after" value="" placeholder="变更后点数" id="after" data-index="2">
</div>
<div class="col-xs-6">
<input type="text" class="form-control" name="after" value="" placeholder="变更后点数" id="after" data-index="2">
</div>
</div>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="memo" class="control-label col-xs-4">备注</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="memo-operate" data-name="memo" value="LIKE" readonly="">
<input type="text" class="form-control" name="memo" value="" placeholder="备注" id="memo" data-index="3">
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="codeoperate" class="control-label col-xs-4">积分操作</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="codeoperate-operate" data-name="codeoperate" value="=" readonly="">
<select class="form-control" name="codeoperate">
<option value="">选择</option>
<option value="codechange">兑换</option>
<option value="transfer">转账</option>
<option value="consume">消费</option>
<option value="income">收入</option>
<option value="log">记录</option>
</select>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="state" class="control-label col-xs-4">状态</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="state-operate" data-name="state" value="=" readonly="">
<select class="form-control" name="state">
<option value="">选择</option>
<option value="0">减少</option>
<option value="1">增加</option>
<option value="2">不变</option>
</select>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="codetype" class="control-label col-xs-4">积分类型</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="codetype-operate" data-name="codetype" value="=" readonly="">
<select class="form-control" name="codetype">
<option value="">选择</option>
<option value="0">其他</option>
<option value="1">序列号</option>
<option value="2">脚本1</option>
<option value="3">(b服务器)动态</option>
<option value="4">(b服务器)静态</option>
<option value="5">(e服务器)动态</option>
<option value="6">VPN静态DT</option>
<option value="7">占坑3</option>
<option value="8">梦想</option>
<option value="9">理想</option>
<option value="10">占坑</option>
</select>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="receipt" class="control-label col-xs-4">回执</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="receipt-operate" data-name="receipt" value="=" readonly="">
<select class="form-control" name="receipt">
<option value="">选择</option>
<option value="1">发送</option>
<option value="2">成功</option>
<option value="3">失败</option>
<option value="4">未知</option>
</select>
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="receiptlog" class="control-label col-xs-4">失败原因</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="receiptlog-operate" data-name="receiptlog" value="LIKE" readonly="">
<input type="text" class="form-control" name="receiptlog" value="" placeholder="失败原因" id="receiptlog" data-index="8">
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<label for="createtime" class="control-label col-xs-4">创建时间</label>
<div class="col-xs-8">
<input type="hidden" class="form-control operate" name="createtime-operate" data-name="createtime" value="RANGE" readonly="">
<input type="text" class="form-control datetimerange" name="createtime" value="" placeholder="创建时间" id="createtime" data-index="9">
</div>
</div>
<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
<div class="col-sm-8 col-xs-offset-4">
<button type="submit" class="btn btn-success" formnovalidate="">提交</button> <button type="reset" class="btn btn-default">重置</button> </div>
</div>
</div>
</fieldset>
</form>
</div>
<div class="fixed-table-toolbar">
<div class="bs-bars pull-left">
<div id="toolbar" class="toolbar">
                            
                              </div>
</div>
</div>
<div class="fixed-table-container" style="padding-bottom: 0px;">
<div class="fixed-table-header" style="display: none;">
<table>
</table>
</div>
<div class="fixed-table-body">
<div class="fixed-table-loading" style="top: 42px; display: none;">正在努力地加载数据中，请稍候……</div>
<table id="table" class="table table-striped table-bordered table-hover table-nowrap" width="100%" data-show-columns="true">
                              <thead>
<tr>
<th style="text-align: center; vertical-align: middle; " data-field="money">
<div class="th-inner ">变更点数</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="before">
<div class="th-inner ">变更前点数</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="after">
<div class="th-inner ">变更后点数</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="memo">
<div class="th-inner ">备注</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="codeoperate">
<div class="th-inner ">积分操作</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="state">
<div class="th-inner ">状态</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="codetype">
<div class="th-inner ">积分类型</div>
<div class="fht-cell">
</div>
</th>
<th style="text-align: center; vertical-align: middle; " data-field="createtime">
<div class="th-inner ">创建时间</div>
<div class="fht-cell">
</div>
</th>
</tr>
</thead>
<tbody data-listidx="0">
    <?php if(is_array($logger) || $logger instanceof \think\Collection || $logger instanceof \think\Paginator): if( count($logger)==0 ) : echo "" ;else: foreach($logger as $key=>$v): ?>
<tr data-index="0"> 
<td style="text-align: center; vertical-align: middle; "><?php echo $v['update_number']; ?></td>
<td style="text-align: center; vertical-align: middle; "><?php echo $v['before_number']; ?></td>
<td style="text-align: center; vertical-align: middle; "><?php echo $v['after_number']; ?></td>
<td style="text-align: center; vertical-align: middle; "><?php echo $v['remarks']; ?></td> <td style="text-align: center; vertical-align: middle; ">
<a href="javascript:;" class="searchit" data-toggle="tooltip"  data-field="codeoperate" data-value="consume">
<span class="{ $v.manage == '消费'?echo 'text-danger'?echo 'text-primary';}"><?php echo $v['manage']; ?></span>
</a>
</td> <td style="text-align: center; vertical-align: middle; ">
<a href="javascript:;" class="searchit" data-toggle="tooltip"  data-field="state" data-value="0">
<span class="{ $v.manage == '减少'?echo 'text-primary'?echo 'text-success';}"><?php echo $v['state']; ?></span>
</a>
</td> <td style="text-align: center; vertical-align: middle; ">
<a href="javascript:;" class="searchit" data-toggle="tooltip"  data-field="codetype" data-value="5">
<span class="text-gray"><?php echo $v['amount_name']; ?></span>
</a>
</td><td style="text-align: center; vertical-align: middle; "><?php echo $v['c_time']; ?></td> </tr>
<?php endforeach; endif; else: echo "" ;endif; ?>
<tr data-index="1"> <td style="text-align: center; vertical-align: middle; ">130</td> <td style="text-align: center; vertical-align: middle; ">0</td> <td style="text-align: center; vertical-align: middle; ">130</td> <td style="text-align: center; vertical-align: middle; ">兑换(e服务器)动态: 130 花费:65 余额:2.52</td> <td style="text-align: center; vertical-align: middle; ">
<a href="javascript:;" class="searchit" data-toggle="tooltip"  data-field="codeoperate" data-value="codechange">
<span class="text-primary">兑换</span>
</a>
</td> <td style="text-align: center; vertical-align: middle; ">
<a href="javascript:;" class="searchit" data-toggle="tooltip"  data-field="state" data-value="1">
<span class="text-success">增加</span>
</a>
</td> <td style="text-align: center; vertical-align: middle; ">
<a href="javascript:;" class="searchit" data-toggle="tooltip"  data-field="codetype" data-value="5">
<span class="text-gray">(e服务器)动态</span>
</a>
</td> <td style="text-align: center; vertical-align: middle; ">2019-08-07 19:41:50</td> </tr>
</tbody>
</table>
</div>
<div class="fixed-table-footer" style="display: none;">
<table>
<tbody>
<tr>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="clearfix">
</div>
                          </div>
                        </div>
                    </div>
        </div>
    </div>
    
    <script type="text/html" id="emailtpl">
        <form id="email-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changeemail'); ?>">
            <div class="form-body">
                <input type="hidden" name="action" value="changeemail" />
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3"><?php echo __('New Email'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" value="" data-rule="required;email;remote(<?php echo url('api/validate/check_email_available'); ?>, event=changeemail, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New email'); ?>">
                        <span class="msg-box">
</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <div class="input-group">
                            <input type="text" name="captcha" id="email-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_ems_correct'); ?>, event=changeemail, email:#email)" />
                            <span class="input-group-btn" style="padding:0;border:none;">
                                <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/ems/send'); ?>" data-type="email" data-event="changeemail">获取验证码</a>
                            </span>
                        </div>
                        <span class="msg-box">
</span>
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="control-label col-xs-12 col-sm-3">
</label>
                    <div class="col-xs-12 col-sm-8">
                        <button type="submit" class="btn btn-md btn-info"><?php echo __('Submit'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </script>
    <script type="text/html" id="mobiletpl">
        <form id="mobile-form" class="form-horizontal form-layer" method="POST" action="<?php echo url('api/user/changemobile'); ?>">
            <div class="form-body">
                <input type="hidden" name="action" value="changemobile" />
                <div class="form-group">
                    <label for="c-mobile" class="control-label col-xs-12 col-sm-3"><?php echo __('New mobile'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" class="form-control" id="mobile" name="mobile" value="" data-rule="required;mobile;remote(<?php echo url('api/validate/check_mobile_available'); ?>, event=changemobile, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New mobile'); ?>">
                        <span class="msg-box">
</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mobile-captcha" class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                    <div class="col-xs-12 col-sm-8">
                        <div class="input-group">
                            <input type="text" name="captcha" id="mobile-captcha" class="form-control" data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_sms_correct'); ?>, event=changemobile, mobile:#mobile)" />
                            <span class="input-group-btn" style="padding:0;border:none;">
                                <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/sms/send'); ?>" data-type="mobile" data-event="changemobile">获取验证码</a>
                            </span>
                        </div>
                        <span class="msg-box">
</span>
                    </div>
                </div>
            </div>
            <div class="form-footer">
                <div class="form-group" style="margin-bottom:0;">
                    <label class="control-label col-xs-12 col-sm-3">
</label>
                    <div class="col-xs-12 col-sm-8">
                        <button type="submit" class="btn btn-md btn-info"><?php echo __('Submit'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </script>
    <style>
        .form-layer {
            height: 100%;
            min-height: 150px;
            min-width: 300px;
        }
    
        .form-body {
            width: 100%;
            overflow: auto;
            top: 0;
            position: absolute;
            z-index: 10;
            bottom: 50px;
            padding: 15px;
        }
    
        .form-layer .form-footer {
            height: 50px;
            line-height: 50px;
            background-color: #ecf0f1;
            width: 100%;
            position: absolute;
            z-index: 200;
            bottom: 0;
            margin: 0;
        }
    
        .form-footer .form-group {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
        </main>

        <footer class="footer" style="clear:both">
            <!-- FastAdmin是开源程序，建议在您的网站底部保留一个FastAdmin的链接 -->
            <p class="copyright">Copyright&nbsp;©&nbsp;2017-2019 Powered by <a href="https://www.fastadmin.net" target="_blank">FastAdmin</a> All Rights Reserved <a href="http://www.beian.miit.gov.cn" target="_blank"><?php echo htmlentities($site['beian']); ?></a></p>
        </footer>

        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>

    </body>

</html>