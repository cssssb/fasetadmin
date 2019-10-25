<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:92:"C:\phpStudy\PHPTutorial\WWW\fasetadmin\public/../application/index\view\user\staticlist.html";i:1571904830;s:81:"C:\phpStudy\PHPTutorial\WWW\fasetadmin\application\index\view\layout\default.html";i:1571646850;s:78:"C:\phpStudy\PHPTutorial\WWW\fasetadmin\application\index\view\common\meta.html";i:1571646850;s:81:"C:\phpStudy\PHPTutorial\WWW\fasetadmin\application\index\view\common\sidenav.html";i:1571714014;s:80:"C:\phpStudy\PHPTutorial\WWW\fasetadmin\application\index\view\common\script.html";i:1571646850;}*/ ?>
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
                <h2 class="page-header">静态vpn列表---单静态连接账号每天限制1次地区更换 用于变更ip 请及时停止次数不够的账号连接 密码错误的连接 多次尝试可能造成您本地IP进黑名单
                    遇到这种情况请重启本地路由器和光猫 换一个IP即可 固定IP的请发IP给客服 帮你解黑名单
                </h2>
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
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label
                                                            for="vcname" class="control-label col-xs-4">连接账号</label>
                                                        <div class="col-xs-8"><input type="hidden"
                                                                class="form-control operate" name="vcname-operate"
                                                                data-name="vcname" value="=" readonly=""><input
                                                                type="text" class="form-control" name="vcname" value=""
                                                                placeholder="连接账号" id="vcname" data-index="1"></div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label
                                                            for="vcgroupId" class="control-label col-xs-4">组ID</label>
                                                        <div class="col-xs-8"><input type="hidden"
                                                                class="form-control operate" name="vcgroupId-operate"
                                                                data-name="vcgroupId" value="=" readonly=""><input
                                                                type="text" class="form-control" name="vcgroupId"
                                                                value="" placeholder="组ID" id="vcgroupId"
                                                                data-index="2"></div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label
                                                            for="createtime" class="control-label col-xs-4">创建时间</label>
                                                        <div class="col-xs-8"><input type="hidden"
                                                                class="form-control operate" name="createtime-operate"
                                                                data-name="createtime" value="RANGE" readonly=""><input
                                                                type="text" class="form-control datetimerange"
                                                                name="createtime" value="" placeholder="创建时间"
                                                                id="createtime" data-index="3"></div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label
                                                            for="vcexpireDate"
                                                            class="control-label col-xs-4">到期时间</label>
                                                        <div class="col-xs-8"><input type="hidden"
                                                                class="form-control operate" name="vcexpireDate-operate"
                                                                data-name="vcexpireDate" value="LIKE" readonly=""><input
                                                                type="text" class="form-control" name="vcexpireDate"
                                                                value="" placeholder="到期时间" id="vcexpireDate"
                                                                data-index="6"></div>
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <div class="col-sm-8 col-xs-offset-4"><button type="submit"
                                                                class="btn btn-success" formnovalidate="">提交</button>
                                                            <button type="reset" class="btn btn-default">重置</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <div class="fixed-table-toolbar">
                                        <div class="bs-bars pull-left">
                                            <div id="toolbar" class="toolbar">
                                                <a href="javascript:;" class="btn btn-primary btn-refresh" title="刷新"><i
                                                        class="fa fa-refresh"></i> </a>
                                                <a class="btn btn-info btn-disabled disabled btn-selfvpn"
                                                    href="javascript:;">勾选账号充点</a>
                                                <a class="btn btn-success btn-groupvpn" href="javascript:;">静态按组充点</a>
                                                <a class="btn btn-warning btn-othervpn" href="javascript:;">为他人充点</a>
                                                <a href="javascript:;" class="btn btn-default"
                                                    style="font-size:12px;color:dodgerblue;">
                                                    <span class="extend">
                                                        剩余点数：<span id="money">0</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="columns-right pull-right" style="margin-bottom:10px;"><button
                                                class="btn btn-default" type="button" name="commonSearch"
                                                title="Common search"><i
                                                    class="glyphicon glyphicon-search"></i></button></div>
                                        <div class="columns columns-right btn-group pull-right"><button
                                                class="btn btn-default" type="button" name="toggle" aria-label="toggle"
                                                title="切换"><i
                                                    class="glyphicon glyphicon-list-alt icon-list-alt"></i></button>
                                            <div class="keep-open btn-group" title="列"><button type="button"
                                                    aria-label="columns" class="btn btn-default dropdown-toggle"
                                                    data-toggle="dropdown"><i
                                                        class="glyphicon glyphicon-th icon-th"></i> <span
                                                        class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="vcname" value="1" checked="checked">
                                                            连接账号</label></li>
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="vcgroupId" value="2" checked="checked">
                                                            组ID</label></li>
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="createtime" value="3" checked="checked">
                                                            创建时间</label></li>
                                                    <li role="menuitem"><label><input type="checkbox" data-field="vcisp"
                                                                value="4" checked="checked"> 运营商</label></li>
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="vcdefaultLinkname" value="5"
                                                                checked="checked"> 线路</label></li>
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="vcexpireDate" value="6" checked="checked">
                                                            到期时间</label></li>
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="isOnline" value="7" checked="checked">
                                                            在线状态</label></li>
                                                    <li role="menuitem"><label><input type="checkbox"
                                                                data-field="operate" value="8" checked="checked">
                                                            更多</label></li>
                                                </ul>
                                            </div>
                                            <div class="export btn-group"><button
                                                    class="btn btn-default dropdown-toggle" aria-label="export type"
                                                    title="导出数据" data-toggle="dropdown" type="button"><i
                                                        class="glyphicon glyphicon-export icon-share"></i> <span
                                                        class="caret"></span></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li role="menuitem" data-type="json"><a
                                                            href="javascript:void(0)">JSON</a></li>
                                                    <li role="menuitem" data-type="xml"><a
                                                            href="javascript:void(0)">XML</a></li>
                                                    <li role="menuitem" data-type="csv"><a
                                                            href="javascript:void(0)">CSV</a></li>
                                                    <li role="menuitem" data-type="txt"><a
                                                            href="javascript:void(0)">TXT</a></li>
                                                    <li role="menuitem" data-type="doc"><a
                                                            href="javascript:void(0)">MS-Word</a></li>
                                                    <li role="menuitem" data-type="excel"><a
                                                            href="javascript:void(0)">MS-Excel</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fixed-table-container" style="padding-bottom: 0px;">
                                        <div class="fixed-table-header" style="display: none;">
                                            <table></table>
                                        </div>
                                        <div class="fixed-table-body">
                                            <div class="fixed-table-loading" style="top: 42px; display: none;">
                                                正在努力地加载数据中，请稍候……</div>
                                            <table id="table"
                                                class="table table-striped table-bordered table-hover table-nowrap"
                                                data-operate-edit="1" data-operate-del="0" width="100%"
                                                data-show-columns="true">
                                                <thead>
                                                    <tr>
                                                        <th class="bs-checkbox "
                                                            style="text-align: center; vertical-align: middle; width: 36px; "
                                                            data-field="state">
                                                            <div class="th-inner "><input name="btSelectAll"
                                                                    type="checkbox"></div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="vcname">
                                                            <div class="th-inner ">连接账号</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="vcgroupId">
                                                            <div class="th-inner ">组ID</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="createtime">
                                                            <div class="th-inner ">创建时间</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="vcisp">
                                                            <div class="th-inner ">运营商</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="vcdefaultLinkname">
                                                            <div class="th-inner ">线路</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="vcexpireDate">
                                                            <div class="th-inner ">到期时间</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="isOnline">
                                                            <div class="th-inner ">在线状态</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                        <th style="text-align: center; vertical-align: middle; "
                                                            data-field="operate">
                                                            <div class="th-inner ">更多</div>
                                                            <div class="fht-cell"></div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody data-listidx="0">
                                                    <tr data-index="0">
                                                        <td class="bs-checkbox "><input data-index="0"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">ddgg04
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">17435
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-20 14:32:43</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-success">联通</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">上海</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-07-09 23:59:59</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/13620"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="0"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="1">
                                                        <td class="bs-checkbox "><input data-index="1"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">ddgg03
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">17435
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-20 14:32:43</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-success">联通</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">江苏</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-21</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/13619"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="1"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="2">
                                                        <td class="bs-checkbox "><input data-index="2"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">ddgg02
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">17435
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-20 14:32:43</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-success">联通</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">江苏</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-21</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/13618"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="2"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="3">
                                                        <td class="bs-checkbox "><input data-index="3"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">ddgg01
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">17435
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-20 14:32:43</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-success">联通</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">江苏</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-21</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/13617"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="3"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="4">
                                                        <td class="bs-checkbox "><input data-index="4"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">ddgzs01
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">17430
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-20 14:24:17</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-success">联通</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">江苏</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-21</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/13616"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="4"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="5">
                                                        <td class="bs-checkbox "><input data-index="5"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            test0101</td>
                                                        <td style="text-align: center; vertical-align: middle; ">15852
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-03 00:47:27</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-success">联通</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">新疆巴音郭楞
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-05-04</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/10431"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="5"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="6">
                                                        <td class="bs-checkbox "><input data-index="6"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">wei001
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">9786
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-28 20:17:12</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger">电信</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">江西省
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-03-01</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/1815"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="6"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="7">
                                                        <td class="bs-checkbox "><input data-index="7"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            huanghu01</td>
                                                        <td style="text-align: center; vertical-align: middle; ">9620
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-26 17:08:04</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger">电信</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">上海</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-27</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/1643"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="7"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="8">
                                                        <td class="bs-checkbox "><input data-index="8"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            nznydw01</td>
                                                        <td style="text-align: center; vertical-align: middle; ">9211
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-19 17:48:47</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger">电信</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">杭州</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-20</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/1244"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="8"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr data-index="9">
                                                        <td class="bs-checkbox "><input data-index="9"
                                                                name="btSelectItem" type="checkbox"></td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            niuniu01</td>
                                                        <td style="text-align: center; vertical-align: middle; ">9170
                                                        </td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-18 18:48:45</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger">电信</span></td>
                                                        <td style="text-align: center; vertical-align: middle; ">上海</td>
                                                        <td style="text-align: center; vertical-align: middle; ">
                                                            2019-02-19</td>
                                                        <td style="text-align: center; vertical-align: middle; "><span
                                                                class="text-danger"><i class="fa fa-circle"></i>
                                                                离线</span></td>
                                                        <td style="text-align: center; vertical-align: middle; "><a
                                                                href="/addons/vpn/accounts/edit/ids/1214"
                                                                class="btn btn-xs btn-success btn-editone"
                                                                data-toggle="tooltip" title="编辑" data-table-id="table"
                                                                data-field-index="8" data-row-index="9"
                                                                data-button-index="1"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="fixed-table-footer" style="display: none;">
                                            <table>
                                                <tbody>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="fixed-table-pagination" style="display: block;">
                                            <div class="pull-left pagination-detail"><span class="pagination-info">显示第 1
                                                    到第 10 条记录，总共 20 条记录</span><span class="page-list">每页显示 <span
                                                        class="btn-group dropup"><button type="button"
                                                            class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown"><span class="page-size">10</span>
                                                            <span class="caret"></span></button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li role="menuitem" class="active"><a href="#">10</a></li>
                                                            <li role="menuitem"><a href="#">25</a></li>
                                                        </ul>
                                                    </span> 条记录</span></div>
                                            <div class="pull-right pagination">
                                                <ul class="pagination">
                                                    <li class="page-pre"><a href="#">上一页</a></li>
                                                    <li class="page-number active"><a href="#">1</a></li>
                                                    <li class="page-number"><a href="#">2</a></li>
                                                    <li class="page-next"><a href="#">下一页</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
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
                                <a href="javascript:;" class="btn btn-info btn-captcha"
                                    data-url="<?php echo url('api/ems/send'); ?>" data-type="email"
                                    data-event="changeemail">获取验证码</a>
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
        <form id="mobile-form" class="form-horizontal form-layer" method="POST"
            action="<?php echo url('api/user/changemobile'); ?>">
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
                                <a href="javascript:;" class="btn btn-info btn-captcha"
                                    data-url="<?php echo url('api/sms/send'); ?>" data-type="mobile"
                                    data-event="changemobile">获取验证码</a>
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