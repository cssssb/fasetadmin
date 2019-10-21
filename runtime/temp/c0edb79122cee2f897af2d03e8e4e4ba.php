<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:88:"C:\Users\Administrator\Desktop\fastAdmin\public/../application/index\view\user\test.html";i:1571381930;s:83:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\layout\default.html";i:1571031854;s:80:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\common\meta.html";i:1570347773;s:83:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\common\sidenav.html";i:1571043931;s:82:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\common\script.html";i:1570347773;}*/ ?>
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
        <li class="list-group-item <?php echo $config['actionname']=='test'?'active':''; ?>"> <a href="<?php echo url('user/test'); ?>"><i class="fa fa-user-circle fa-fw"></i> 卡密充值</a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='profile'?'active':''; ?>"> <a href="<?php echo url('user/profile'); ?>"><i class="fa fa-user-o fa-fw"></i> 充值订单</a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='changepwd'?'active':''; ?>"> <a href="<?php echo url('user/changepwd'); ?>"><i class="fa fa-key fa-fw"></i> 余额日志</a> </li>
        <li class="list-group-item <?php echo $config['actionname']=='logout'?'active':''; ?>"> <a href="<?php echo url('user/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> <?php echo __('Sign out'); ?></a> </li>
    </ul>
    <?php echo hook('user_sidenav_after'); ?>
</div>
        </div>
        <div class="col-md-9">
            <div class="panel-body">
                <h2 class="page-header">邀请规则如下 A邀请B，B充值兑换100点A得10点返利 <span><small
                            class="text-danger">邀请人数:234</small></span>
                </h2>
                邀请链接： <span id="link" name="link">http://www.saqqq.com/index/user/register/ids/7.html </span><a
                    id="linkcopy" class="btn btn-info btn-embossed" data-clipboard-action="copy"
                    data-clipboard-target="#link">复制链接</a>
                <h4 class="page-header">

                </h4>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            3938 </h4>
                        <p class="text-muted">邀请时间：2019-07-18 15:45:09</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            s18932507276 </h4>
                        <p class="text-muted">邀请时间：2019-07-18 10:22:45</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            hcy0909 </h4>
                        <p class="text-muted">邀请时间：2019-07-11 13:56:39</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            3360690732 </h4>
                        <p class="text-muted">邀请时间：2019-07-11 10:26:45</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            1271377879 </h4>
                        <p class="text-muted">邀请时间：2019-07-09 12:43:46</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            a1275052663 </h4>
                        <p class="text-muted">邀请时间：2019-07-05 14:56:49</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            l00001 </h4>
                        <p class="text-muted">邀请时间：2019-07-04 16:06:03</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            qq76531834 </h4>
                        <p class="text-muted">邀请时间：2019-06-13 10:53:45</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            168073969 </h4>
                        <p class="text-muted">邀请时间：2019-06-13 00:14:27</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4>
                            fenghuo123 </h4>
                        <p class="text-muted">邀请时间：2019-06-12 12:38:45</p>
                    </div>
                </div>
                <hr>
                <div class="pager">
                    <ul class="pagination">
                        <li class="disabled"><span>«</span></li>
                        <li class="active"><span>1</span></li>
                        <li><a href="/userext/invite.html?page=2">2</a></li>
                        <li><a href="/userext/invite.html?page=3">3</a></li>
                        <li><a href="/userext/invite.html?page=4">4</a></li>
                        <li><a href="/userext/invite.html?page=5">5</a></li>
                        <li><a href="/userext/invite.html?page=6">6</a></li>
                        <li><a href="/userext/invite.html?page=7">7</a></li>
                        <li><a href="/userext/invite.html?page=8">8</a></li>
                        <li class="disabled"><span>...</span></li>
                        <li><a href="/userext/invite.html?page=23">23</a></li>
                        <li><a href="/userext/invite.html?page=24">24</a></li>
                        <li><a href="/userext/invite.html?page=2">»</a></li>
                    </ul>
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
                    <span class="msg-box"></span>
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
                    <input type="text" class="form-control" id="mobile" name="mobile" value="" data-rule="required;mobile;remote(<?php echo url('api/validate/check_mobile_available'); ?>, event=changemobile, id=<?php echo $user['id']; ?>)" placeholder="<?php echo __('New mobile'); ?>">
                    <span class="msg-box"></span>
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