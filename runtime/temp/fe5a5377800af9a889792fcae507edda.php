<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:91:"/www/wwwroot/v.zzz80.cn/fasetadmin/public/../application/index/view/user/rechargeorder.html";i:1577022673;s:77:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/layout/default.html";i:1577027813;s:74:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/meta.html";i:1577022673;s:77:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/sidenav.html";i:1588843583;s:76:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/script.html";i:1577022673;}*/ ?>
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
            <!--<li class="list-group-item <?php echo $config['actionname']=='sharepoints'?'active':''; ?>"> <a href="<?php echo url('user/sharepoints'); ?>"><i class="fa fa-user-o fa-fw"></i> 充值共享点数</a> </li>-->
            <li class="list-group-item <?php echo $config['actionname']=='exchangepoints'?'active':''; ?>"> <a href="<?php echo url('user/exchangepoints'); ?>"><i class="fa fa-user-circle fa-fw"></i> 兑换点数</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='transaction'?'active':''; ?>"> <a href="<?php echo url('user/transaction'); ?>"><i class="fa fa-user-o fa-fw"></i> 交易记录</a> </li>
    </ul>
    <ul class="list-group">
            <li class="list-group-heading">连接服务器</li>
            <li class="list-group-item <?php echo $config['actionname']=='mainaccountnumber'?'active':''; ?>"> <a href="<?php echo url('user/mainaccountnumber'); ?>"><i class="fa fa-user-circle fa-fw"></i> 主账号</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='dynamic'?'active':''; ?>"> <a href="<?php echo url('user/dynamic'); ?>"><i class="fa fa-user-o fa-fw"></i> 申请动态</a> </li>
            <li class="list-group-item <?php echo $config['actionname']=='dynamiclist'?'active':''; ?>"> <a href="<?php echo url('user/dynamiclist'); ?>"><i class="fa fa-user-o fa-fw"></i> 动态列表</a> </li>
            <!--<li class="list-group-item <?php echo $config['actionname']=='static'?'active':''; ?>"> <a href="<?php echo url('user/static'); ?>"><i class="fa fa-user-o fa-fw"></i> 申请静态</a> </li>-->
            <!--<li class="list-group-item <?php echo $config['actionname']=='staticlist'?'active':''; ?>"> <a href="<?php echo url('user/staticlist'); ?>"><i class="fa fa-user-o fa-fw"></i> 静态列表</a> </li>-->
    </ul>
    <?php echo hook('user_sidenav_after'); ?>
</div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <ul class="nav nav-tabs" data-field="status">
                        <li class="active">
                        </li>
                    </ul>
                </div>


                <div class="panel-body">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="one">
                            <div class="widget-body no-padding">

                                <div class="bootstrap-table">
                                    <div class="commonsearch-table hidden">
                                        <form
                                            class="form-horizontal form-commonsearch nice-validator n-default n-bootstrap"
                                            novalidate="" method="post" action="">
                                            <fieldset>
                                                <div class="row">
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="orderid" class="control-label col-xs-4">订单ID</label>
                                                        <div class="col-xs-8">
                                                            <input type="hidden" class="form-control operate"
                                                                name="orderid-operate" data-name="orderid" value="="
                                                                readonly="">
                                                            <input type="text" class="form-control" name="orderid"
                                                                value="" placeholder="订单ID" id="orderid" data-index="0">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="amount" class="control-label col-xs-4">原价</label>
                                                        <div class="col-xs-8">
                                                            <input type="hidden" class="form-control operate"
                                                                name="amount-operate" data-name="amount" value="BETWEEN"
                                                                readonly="">
                                                            <div class="row row-between">
                                                                <div class="col-xs-6">
                                                                    <input type="text" class="form-control"
                                                                        name="amount" value="" placeholder="原价"
                                                                        id="amount" data-index="1">
                                                                </div>
                                                                <div class="col-xs-6">
                                                                    <input type="text" class="form-control"
                                                                        name="amount" value="" placeholder="原价"
                                                                        id="amount" data-index="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="paytype" class="control-label col-xs-4">支付方式</label>
                                                        <div class="col-xs-8">
                                                            <input type="hidden" class="form-control operate"
                                                                name="paytype-operate" data-name="paytype" value="="
                                                                readonly="">
                                                            <select class="form-control" name="paytype">
                                                                <option value="">选择</option>
                                                                <option value="1">支付宝</option>
                                                                <option value="2">QQ</option>
                                                                <option value="3">微信</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="paytime" class="control-label col-xs-4">付款时间</label>
                                                        <div class="col-xs-8">
                                                            <input type="hidden" class="form-control operate"
                                                                name="paytime-operate" data-name="paytime" value="RANGE"
                                                                readonly="">
                                                            <input type="text" class="form-control datetimerange"
                                                                name="paytime" value="" placeholder="付款时间" id="paytime"
                                                                data-index="3">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="createtime"
                                                            class="control-label col-xs-4">创建时间</label>
                                                        <div class="col-xs-8">
                                                            <input type="hidden" class="form-control operate"
                                                                name="createtime-operate" data-name="createtime"
                                                                value="RANGE" readonly="">
                                                            <input type="text" class="form-control datetimerange"
                                                                name="createtime" value="" placeholder="创建时间"
                                                                id="createtime" data-index="4">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="status" class="control-label col-xs-4">状态</label>
                                                        <div class="col-xs-8">
                                                            <input type="hidden" class="form-control operate"
                                                                name="status-operate" data-name="status" value="="
                                                                readonly="">
                                                            <select class="form-control" name="status">
                                                                <option value="">选择</option>
                                                                <option value="0">关闭</option>
                                                                <option value="1">未支付</option>
                                                                <option value="2">已支付</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <div class="col-sm-8 col-xs-offset-4">
                                                            <button type="submit" class="btn btn-success"
                                                                formnovalidate="">提交</button> <button type="reset"
                                                                class="btn btn-default">重置</button> </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="fixed-table-toolbar">
                                        <div class="bs-bars pull-left">
                                            <div id="toolbar" class="toolbar">
                                                <a href="javascript:;" class="btn btn-default"
                                                    style="font-size:12px;color:dodgerblue;">
                                                    <i class="fa fa-cny">
                                                    </i>
                                                    <span class="extend">
                                                        余额：<span id="money"><?php echo $money; ?></span>
                                                    </span>
                                                </a>
                                                <!-- <a href="/index/recharge/recharge.html"
                                                    class="btn btn-info btn-recharge">
                                                    <i class="fa fa-cny">
                                                    </i> 充值余额</a> -->
                                            </div>
                                        </div>

                                        <div class="columns columns-right btn-group pull-right">
                                            <div class="export btn-group">
                                                <ul class="dropdown-menu" role="menu">
                                                    <li role="menuitem" data-type="json">
                                                        <a href="javascript:void(0)">JSON</a>
                                                    </li>
                                                    <li role="menuitem" data-type="xml">
                                                        <a href="javascript:void(0)">XML</a>
                                                    </li>
                                                    <li role="menuitem" data-type="csv">
                                                        <a href="javascript:void(0)">CSV</a>
                                                    </li>
                                                    <li role="menuitem" data-type="txt">
                                                        <a href="javascript:void(0)">TXT</a>
                                                    </li>
                                                    <li role="menuitem" data-type="doc">
                                                        <a href="javascript:void(0)">MS-Word</a>
                                                    </li>
                                                    <li role="menuitem" data-type="excel">
                                                        <a href="javascript:void(0)">MS-Excel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fixed-table-container" style="padding-bottom: 0px;">
                                        <div class="fixed-table-header" style="display: none;">
                                            <table>
                                            </table>
                                        </div>
                                        <div class="fixed-table-body">
                                            <div class="fixed-table-loading" style="top: 42px; display: none;">
                                                正在努力地加载数据中，请稍候……</div>
                                            <table id="table"
                                                class="table table-striped table-bordered table-hover table-nowrap"
                                                data-operate-edit="0" data-operate-del="" width="100%"
                                                data-show-columns="true">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="orderid">
                                                            <div class="th-inner ">订单ID</div>
                                                            <div class="fht-cell">
                                                            </div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="amount">
                                                            <div class="th-inner ">卡密号</div>
                                                            <div class="fht-cell">
                                                            </div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                        data-field="amount">
                                                        <div class="th-inner ">原价</div>
                                                        <div class="fht-cell">
                                                        </div>
                                                    </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="paytime">
                                                            <div class="th-inner ">付款时间</div>
                                                            <div class="fht-cell">
                                                            </div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="status">
                                                            <div class="th-inner ">状态</div>
                                                            <div class="fht-cell">
                                                            </div>
                                                        </th>
                                                      
                                                    </tr>
                                                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$v): ?>
                                                    <tr style="text-align: center; vertical-align: middle;">
                                                        <td><?php echo $v['id']; ?></td>
                                                        <td><?php echo $v['has_pwd']; ?></td>
                                                        <td><?php echo $v['price']; ?></td>
                                                        <td><?php echo $v['c_time']; ?></td>
                                                        <td>已支付</td>
                                                       
                                                     </tr>
                                                     <?php endforeach; endif; else: echo "" ;endif; ?>
                                        </thead>
                                        <tbody data-listidx="0">
                                            <tr class="no-records-found">
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                    <div class="fixed-table-pagination hidden" >
                                        <div class="pull-left pagination-detail">
                                            <span class="pagination-info">显示第 1 到第 0 条记录，总共 0 条记录</span>
                                            <span class="page-list" style="display: none;">每页显示 <span
                                                    class="btn-group dropup">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        <span class="page-size">10</span> <span class="caret">
                                                        </span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li role="menuitem" class="active">
                                                            <a href="#">10</a>
                                                        </li>
                                                    </ul>
                                                </span> 条记录</span>
                                        </div>
                                        <div class="pull-right pagination hidden">
                                            <ul class="pagination">
                                                <li class="page-pre">
                                                    <a href="#">上一页</a>
                                                </li>
                                                <li class="page-next">
                                                    <a href="#">下一页</a>
                                                </li>
                                            </ul>
                                        </div>
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
                    <input type="text" class="form-control" id="email" name="email" value=""
                        data-rule="required;email;remote(<?php echo url('api/validate/check_email_available'); ?>, event=changeemail, id=<?php echo $user['id']; ?>)"
                        placeholder="<?php echo __('New email'); ?>">
                    <span class="msg-box">
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="email-captcha" class="form-control"
                            data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_ems_correct'); ?>, event=changeemail, email:#email)" />
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/ems/send'); ?>"
                                data-type="email" data-event="changeemail">获取验证码</a>
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
                    <input type="text" class="form-control" id="mobile" name="mobile" value=""
                        data-rule="required;mobile;remote(<?php echo url('api/validate/check_mobile_available'); ?>, event=changemobile, id=<?php echo $user['id']; ?>)"
                        placeholder="<?php echo __('New mobile'); ?>">
                    <span class="msg-box">
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="mobile-captcha" class="control-label col-xs-12 col-sm-3"><?php echo __('Captcha'); ?>:</label>
                <div class="col-xs-12 col-sm-8">
                    <div class="input-group">
                        <input type="text" name="captcha" id="mobile-captcha" class="form-control"
                            data-rule="required;length(4);integer[+];remote(<?php echo url('api/validate/check_sms_correct'); ?>, event=changemobile, mobile:#mobile)" />
                        <span class="input-group-btn" style="padding:0;border:none;">
                            <a href="javascript:;" class="btn btn-info btn-captcha" data-url="<?php echo url('api/sms/send'); ?>"
                                data-type="mobile" data-event="changemobile">获取验证码</a>
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
            <!--<p class="copyright">Copyright&nbsp;©&nbsp;2017-2019 Powered by <a href="https://www.fastadmin.net" target="_blank">FastAdmin</a> All Rights Reserved <a href="http://www.beian.miit.gov.cn" target="_blank"><?php echo htmlentities($site['beian']); ?></a></p>-->
                        <p class="copyright"><a href="http://beian.miit.gov.cn" target="_blank">粤ICP备19158838号-1</a></p>

        </footer>

        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>

    </body>

</html>