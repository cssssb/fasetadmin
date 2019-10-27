<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:89:"C:\Users\user\Desktop\fastadmin\public/../application/index\view\user\exchangepoints.html";i:1572083512;s:74:"C:\Users\user\Desktop\fastadmin\application\index\view\layout\default.html";i:1571470719;s:71:"C:\Users\user\Desktop\fastadmin\application\index\view\common\meta.html";i:1571470719;s:74:"C:\Users\user\Desktop\fastadmin\application\index\view\common\sidenav.html";i:1571842243;s:73:"C:\Users\user\Desktop\fastadmin\application\index\view\common\script.html";i:1571470719;}*/ ?>
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
                    <h2 class="page-header">e服务器速度快--B服务器对联通移动支持更好--注：点数不通用 <span><small
                                class="text-danger">余额:<?php echo $money; ?></small></span>
                        <a href="/index/recharge/recharge.html" class="btn btn-info btn-recharge pull-right"><i
                                class="fa fa-cny"></i> 充值余额</a>
                    </h2>
                    <div class="row">
                        <?php if(is_array($server_list) || $server_list instanceof \think\Collection || $server_list instanceof \think\Paginator): if( count($server_list)==0 ) : echo "" ;else: foreach($server_list as $key=>$v): ?>
                        <div class="col-xs-6 col-md-3" style="text-align:right"><?php echo $v['name']; ?> : </div>
                        <div class="col-xs-6 col-md-3" style="text-align:left"><?php echo $v['user_number']; ?></div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <hr>
                    <form id="add-form" class="form-horizontal nice-validator n-default n-bootstrap" role="form"
                        data-toggle="validator" method="POST" action="" novalidate="novalidate">
                        <input type="hidden" name="__token__" value="356f1d032dfc7d4b602658f25158587a">
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">选择兑换种类:</label>
                            <div class="col-xs-12 col-sm-4">
                                <div class="btn-group bootstrap-select form-control dropup"><button type="button"
                                        class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button"
                                        title="请选择兑换种类" aria-expanded="false"><span
                                            class="filter-option pull-left">请选择兑换种类</span>&nbsp;<span
                                            class="bs-caret"><span class="caret"></span></span></button>
                                    <div class="dropdown-menu open" role="combobox"
                                        style="max-height: 301px; overflow: hidden; min-height: 83px;">
                                        <ul class="dropdown-menu inner" role="listbox" aria-expanded="false"
                                            style="max-height: 289px; overflow-y: auto; min-height: 71px;">
                                            <li data-original-index="0" class="selected"><a tabindex="0" class=""
                                                    style="" data-tokens="null" role="option" aria-disabled="false"
                                                    aria-selected="true"><span class="text">请选择兑换种类</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                            <li data-original-index="1"><a tabindex="0" class="" style=""
                                                    data-tokens="null" role="option" aria-disabled="false"
                                                    aria-selected="false"><span class="text">(b服务器)动态</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                            <li data-original-index="2"><a tabindex="0" class="" style=""
                                                    data-tokens="null" role="option" aria-disabled="false"
                                                    aria-selected="false"><span class="text">(b服务器)静态</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                            <li data-original-index="3"><a tabindex="0" class="" style=""
                                                    data-tokens="null" role="option" aria-disabled="false"
                                                    aria-selected="false"><span class="text">(e服务器)动态</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                            <li data-original-index="4"><a tabindex="0" class="" style=""
                                                    data-tokens="null" role="option" aria-disabled="false"
                                                    aria-selected="false"><span class="text">梦想</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                            <li data-original-index="5"><a tabindex="0" class="" style=""
                                                    data-tokens="null" role="option" aria-disabled="false"
                                                    aria-selected="false"><span class="text">理想</span><span
                                                        class="glyphicon glyphicon-ok check-mark"></span></a></li>
                                        </ul>
                                    </div><select class="selectpicker form-control" name="row[select]" tabindex="-98">
                                        <option value="0" selected="selected">请选择兑换种类</option>
                                        <option value="3">(b服务器)动态</option>
                                        <option value="4">(b服务器)静态</option>
                                        <option value="5">(e服务器)动态</option>
                                        <option value="8">梦想</option>
                                        <option value="9">理想</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">兑换数量:</label>
                            <div class="col-xs-12 col-sm-4">
                                <input id="num" name="row[code]" class="form-control" type="text" value=""> </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-4">总价:</label>
                            <label class="control-label col-xs-12 col-sm-4" style="text-align:left"><span
                                    style="color:red" id="total"></span>元</label>
                        </div>
                        <div class="form-group layer-footer">
                            <label class="control-label col-xs-12 col-sm-4"></label>
                            <div class="col-xs-12 col-sm-8">
                                <button type="submit" class="btn btn-success btn-embossed">提交</button>
                                <button type="reset" class="btn btn-default btn-embossed">重置</button>
                            </div>
                        </div>
                    </form>
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
                    <span class="msg-box"></span>
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
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
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
                    <span class="msg-box"></span>
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
                    <span class="msg-box"></span>
                </div>
            </div>
        </div>
        <div class="form-footer">
            <div class="form-group" style="margin-bottom:0;">
                <label class="control-label col-xs-12 col-sm-3"></label>
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