<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:86:"C:\Users\user\Desktop\fastadmin\public/../application/index\view\user\dynamiclist.html";i:1573059099;s:74:"C:\Users\user\Desktop\fastadmin\application\index\view\layout\default.html";i:1571470719;s:71:"C:\Users\user\Desktop\fastadmin\application\index\view\common\meta.html";i:1571470719;s:74:"C:\Users\user\Desktop\fastadmin\application\index\view\common\sidenav.html";i:1571842243;s:73:"C:\Users\user\Desktop\fastadmin\application\index\view\common\script.html";i:1571470719;}*/ ?>
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
                    <!-- 勾选账号 -->
                    <div class="checkedcontent hidden">
                        <h4 class="page-header" style="font-size:14px">注意：对 所勾选的若干条vpn账号充值 相同的点数 从新选择vpn请关闭窗口</h4>
                        <form id="selfvpn-form" class="form-horizontal nice-validator n-default n-bootstrap" role="form"
                            data-toggle="validator" method="POST" action="" novalidate="novalidate">
                            <input type="hidden" name="__token__" value="c35ddc7eb12f8a1b2683d95365fe6916">
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">账号名称:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="c-vcname" class="form-control" name="vcname" type="text" value=""
                                        style="background: #fff">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">剩余额度:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="c-surplus" class="form-control" name="surplus" type="text" value=""
                                        style="background: #fff">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">充点数量:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="c-count" class="form-control connum" name="count" type="text" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">点数:</label>
                                <label class="control-label col-xs-8 col-sm-4" style="text-align:left"><span
                                        style="color:red" id="code" ></span></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">可用点数:</label>
                                <label class="control-label col-xs-8 col-sm-4" style="text-align:left"><span
                                        style="color:#18bc9c"><?php echo $number; ?></span></label>
                            </div>
                            <div class="form-group layer-footer">
                                <label class="control-label col-xs-12 col-sm-4"></label>
                                <div class="col-xs-12 col-sm-4">
                                    <button type="button" class="btn btn-success btn-embossed checkbtn">确定</button>
                                    <button type="reset" class="btn btn-default btn-embossed">重置</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!-- 静态充值 -->
                    <!-- <div class="staticcontent hidden">
                        <h4 class="page-header" style="font-size:14px">注意：信息输入后 先点击查询 组成员 数量进行确认</h4>
                        <form id="selfvpn-form" class="form-horizontal nice-validator n-default n-bootstrap" role="form"
                            data-toggle="validator" method="POST" action="" novalidate="novalidate">
                            <input type="hidden" name="__token__" value="586b2845924a650b0dba5f77bb305b08">
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">vpn主账号:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="c-vcname" class="form-control" name="row[username]" type="text"
                                        value="jiemoip">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">组ID:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="c-groupid" class="form-control" name="row[vcgroupId]" type="text"
                                        value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">充值天数:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="c-count" class="form-control" name="row[count]" type="text" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">组成员数量:</label>
                                <div class="col-xs-8 col-sm-4">
                                    <input id="groupnum" class="form-control" name="row[groupnum]" type="text" value=""
                                        readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">点数:</label>
                                <label class="control-label col-xs-8 col-sm-4" style="text-align:left"><span
                                        style="color:red" id="code"></span></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3 col-sm-4" style="text-align:right">可用点数:</label>
                                <label class="control-label col-xs-8 col-sm-4" style="text-align:left"><span
                                        style="color:#18bc9c">0</span></label>
                            </div>
                            <div class="form-group layer-footer" style="display:none">
                                <label class="control-label col-xs-12 col-sm-4"></label>
                                <div class="col-xs-12 col-sm-6">
                                    <button type="submit" class="btn btn-success btn-embossed">确定</button>
                                    <button type="button" class="btn btn-info btn-embossed" id="group">查询</button>
                                    <button type="reset" class="btn btn-default btn-embossed">重置</button>
                                </div>
                            </div>
                        </form>

                    </div> -->
                    <!-- taren -->
                    <!-- <div class=" otherprop hidden error" style="text-align: center">
                        <div class="image">
                            <img src="/assets/img/error.svg" alt="" width="150">
                        </div>
                        <h1>没有此权限</h1>
                        <p class="clearfix">
                            <a href="/" class="btn btn-grey">返回首页</a>
                        </p>
                    </div> -->
                    <!-- 编辑的html -->
                    <form id="add-form" class="form-horizontal nice-validator n-default n-bootstrap propfrom hidden"
                        role="form" data-toggle="validator">
                        <input type="hidden" name="__token__" value="4ec42dcfdb4c3eb8a5789e123390f644">
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">连接账号:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input readonly="1" name="name" class="form-control xiuname" type="text" value="chiyu-20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4 onlyNumAlpha">连接密码:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input name="password" class="form-control" type="text" value=""> </div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-xs-12 col-sm-4">默认线路:</label>
                            <div class="col-xs-12 col-sm-4">
                                <select id="link" class="selectpicker form-control" name="defaultLink"
                                    tabindex="-98">
                                    <option value="0">请选择默认线路</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">运营商:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="radio"><label for="row[isp]-1"><input id="row[isp]-1" name="isp"
                                            type="radio" value="1"> 联通</label> <label for="row[isp]-2"><input
                                            id="row[isp]-2" name="isp" type="radio" value="2"> 电信</label> <label
                                        for="row[isp]-3"><input id="row[isp]-3" checked="checked" name="isp"
                                            type="radio" value="3"> 移动</label> <label for="row[isp]-0"><input
                                            id="row[isp]-0" name="isp" type="radio" value="0"> 不限</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">动态ip账号在线超时设置:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="radio"><label for="row[timeoutExec]-add"><input id="row[timeoutExec]-add"
                                            checked="checked" name="timeoutExec" type="radio" value="add"> 超时后
                                        每隔5分钟 增加1个使用次数</label> <label for="row[timeoutExec]-offline"><input
                                            id="row[timeoutExec]-offline" name="timeoutExec" type="radio"
                                            value="offline"> 超时后 断开连接</label></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">账号状态:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="radio"><label for="row[status]-1"><input id="row[status]-1"
                                            checked="checked" name="status" type="radio" value="1"> 启用</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group layer-footer">
                            <label class="control-label col-xs-12 col-sm-4"></label>
                            <div class="col-xs-12 col-sm-8">
                                <button type="button" class="btn btn-success btn-embossed xiugaibtn">提交</button>
                                <button type="reset" class="btn btn-default btn-embossed">重置</button>
                            </div>
                        </div>
                    </form>



                    <h2 class="page-header"><span class="titname">b服务器动态列表</span>----疑问联系客服 支持API快速切换地区 配置后可脚本快速切换地区 请及时停止次数不够的账号连接 密码错误的连接
                        会本地IP进黑名单 请去主账号界面自助解封 新人不推荐冲共享点数 建议用多少冲多少！
                        <!-- <span>
                            <small class="text-danger">余额:2.52</small>
                        </span>
                        <a href="/index/recharge/recharge.html" class="btn btn-info btn-recharge pull-right">
                            <i class="fa fa-cny">
                            </i> 充值余额</a> -->
                    </h2>
                    <br>
                    <div class="fixed-table-toolbar">
                        <div class="bs-bars pull-left">
                            <div id="toolbar" class="toolbar">
                                <a href="javascript:;" class="btn btn-primary btn-refresh" title="刷新"><i
                                        class="fa fa-refresh"></i> </a>

                                <div class="gouxuan"> <a class="btn btn-info btn-disabled disabled btn-selfvpn"
                                        href="javascript:;">勾选账号充点</a></div>
                                <div class="staticgroup"><a class="btn btn-success btn-groupvpn changedy"
                                            href="javascript:;">切换至e服务器动态列表</a></div>
                                    <!-- <div class="other"><a class="btn btn-warning btn-othervpn"
                                            href="javascript:;">为他人充点</a></div> -->

                                <a href="javascript:;" class="btn btn-default" style="font-size:12px;color:dodgerblue;">
                                    <span class="extend">
                                        剩余点数：<span id="money"><?php echo $number; ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="columns-right pull-right" style="margin-bottom:10px;">
                            <button class="btn btn-default" type="button" name="commonSearch" title="Common search"><i
                                    class="glyphicon glyphicon-search"></i></button></div>
                        <div class="columns columns-right btn-group pull-right"><button class="btn btn-default"
                                type="button" name="toggle" aria-label="toggle" title="切换"><i
                                    class="glyphicon glyphicon-list-alt icon-list-alt"></i></button>
                            <div class="keep-open btn-group" title="列"><button type="button" aria-label="columns"
                                    class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i
                                        class="glyphicon glyphicon-th icon-th"></i> <span class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="menuitem"><label><input type="checkbox" data-field="vcname" value="1"
                                                checked="checked"> 连接账号</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="vcgroupId" value="2"
                                                checked="checked"> 组ID</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="createtime" value="3"
                                                checked="checked"> 创建时间</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="vcisp" value="4"
                                                checked="checked"> 运营商</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="vcdefaultLinkname"
                                                value="5" checked="checked"> 线路</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="vcexpireDate"
                                                value="6" checked="checked"> 到期时间</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="isOnline" value="7"
                                                checked="checked"> 在线状态</label></li>
                                    <li role="menuitem"><label><input type="checkbox" data-field="operate" value="8"
                                                checked="checked"> 更多</label></li>
                                </ul>
                            </div>
                            <div class="export btn-group"><button class="btn btn-default dropdown-toggle"
                                    aria-label="export type" title="导出数据" data-toggle="dropdown" type="button"><i
                                        class="glyphicon glyphicon-export icon-share"></i> <span
                                        class="caret"></span></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="menuitem" data-type="json"><a href="javascript:void(0)">JSON</a></li>
                                    <li role="menuitem" data-type="xml"><a href="javascript:void(0)">XML</a></li>
                                    <li role="menuitem" data-type="csv"><a href="javascript:void(0)">CSV</a></li>
                                    <li role="menuitem" data-type="txt"><a href="javascript:void(0)">TXT</a></li>
                                    <li role="menuitem" data-type="doc"><a href="javascript:void(0)">MS-Word</a></li>
                                    <li role="menuitem" data-type="excel"><a href="javascript:void(0)">MS-Excel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->

                    <div class="bootstrap-table">


                        <div class="fixed-table-container" style="padding-bottom: 0px;">
                            <div class="fixed-table-body">
                                <table id="table" class="table table-striped table-bordered table-hover table-nowrap"
                                    data-operate-edit="0" data-operate-del="" width="100%" data-show-columns="true">
                                    <!-- <thead> -->
                                    <tr>
                                        <th style="text-align: center; vertical-align: middle; " data-field="orderid">
                                            <div class="th-inner "><input type="checkbox" name="checkall" id="checkall">
                                            </div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="text-align: center; vertical-align: middle; " data-field="amount">
                                            <div class="th-inner ">链接账号</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>

                                        <th style="text-align: center; vertical-align: middle; " data-field="paytime">
                                            <div class="th-inner ">过期时间</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="text-align: center; vertical-align: middle; " data-field="paytime">
                                            <div class="th-inner ">运营商</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>

                                        <th style="text-align: center; vertical-align: middle; "
                                            data-field="createtime">
                                            <div class="th-inner ">默认路线</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="text-align: center; vertical-align: middle; " data-field="status">
                                            <div class="th-inner ">设置超时</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="text-align: center; vertical-align: middle; "
                                            data-field="createtime">
                                            <div class="th-inner ">剩余次数</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="text-align: center; vertical-align: middle; " data-field="status">
                                            <div class="th-inner ">在线状态</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>
                                        <th style="text-align: center; vertical-align: middle; " data-field="status">
                                            <div class="th-inner ">更多</div>
                                            <div class="fht-cell">
                                            </div>
                                        </th>

                                    </tr>

                                    <!-- </thead> -->
                                    <tbody data-listidx="0">
                                        <tr class="no-records-found">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="loding" style="text-align: center;padding:10px">
                            正在努力地加载数据中，请稍候……</div>
                        <div class="fixed-table-pagination" style="display: block;">
                            <div class="pull-left pagination-detail"><span class="pagination-info">显示第 <span
                                        class="start"></span> 到第 <span class="end"></span> 条记录，总共
                                    <span class="count"></span> 条记录</span><span class="page-list">每页显示 <span
                                        class="btn-group dropup"><button type="button"
                                            class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span
                                                class="page-size">50</span> <span class="caret"></span></button>
                                    </span> 条记录</span></div>
                            <div class="pull-right pagination">
                                <ul class="pagination">
                                    <li class="page-pre" id="previous"><a href="#">上一页</a></li>
                                    <li class="page-next" id="next"><a href="#">下一页</a></li>
                                </ul>
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

        .layui-layer-content {
            padding: 10px;
        }

        body .demo-class .layui-layer-title {
            background: #2c3e50;
            color: #fff;
            border: none;
        }

        .demo-class .layui-layer-close1 {
            color: #fff !important
        }

        .toolbar div {
            display: inline-block
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