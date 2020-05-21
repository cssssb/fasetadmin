<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:83:"/www/wwwroot/v.zzz80.cn/fasetadmin/public/../application/index/view/user/index.html";i:1577022673;s:77:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/layout/default.html";i:1577027813;s:74:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/meta.html";i:1577022673;s:77:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/sidenav.html";i:1588843583;s:76:"/www/wwwroot/v.zzz80.cn/fasetadmin/application/index/view/common/script.html";i:1577022673;}*/ ?>
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
    .basicinfo {
        margin: 15px 0;
    }

    .basicinfo .row > .col-xs-4 {
        padding-right: 0;
    }

    .basicinfo .row > div {
        margin: 5px 0;
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
            <div class="panel panel-default ">
                <div class="panel-body">
                    <h2 class="page-header">
                        <?php echo __('User center'); ?>
                        <a href="<?php echo url('user/profile'); ?>" class="btn btn-success pull-right"><i class="fa fa-pencil"></i>
                            <?php echo __('Profile'); ?></a>
                    </h2>
                    <div class="row user-baseinfo">
                        <div class="col-md-3 col-sm-3 col-xs-2 text-center user-center">
                            <a href="<?php echo url('user/profile'); ?>" title="<?php echo __('Click to edit'); ?>">
                                <span class="avatar-img"><img src="<?php echo cdnurl($user['avatar']); ?>" alt=""></span>
                            </a>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-10">
                            <!-- Content -->
                            <div class="ui-content">
                                <!-- Heading -->
                                <h4><a href="<?php echo url('user/profile'); ?>"><?php echo $user['nickname']; ?></a></h4>
                                <!-- Paragraph -->
                                <p>
                                    <a href="<?php echo url('user/profile'); ?>">
                                        <?php echo (isset($user['bio']) && ($user['bio'] !== '')?$user['bio']:__("This guy hasn't written anything yet")); ?>
                                    </a>
                                </p>
                                <!-- Success -->
                                <div class="basicinfo">
                                    <div class="row">
                                        <div class="col-xs-4 col-md-2"><?php echo __('Money'); ?></div>
                                        <div class="col-xs-8 col-md-4">
                                            <a href="javascript:;" class="viewmoney"><?php echo $user['money']; ?></a>
                                        </div>
                                        <div class="col-xs-4 col-md-2"><?php echo __('Score'); ?></div>
                                        <div class="col-xs-8 col-md-4">
                                            <a href="javascript:;" class="viewscore"><?php echo $user['score']; ?></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-md-2"><?php echo __('Successions'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo $user['successions']; ?> <?php echo __('Day'); ?></div>
                                        <div class="col-xs-4 col-md-2"><?php echo __('Maxsuccessions'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo $user['maxsuccessions']; ?> <?php echo __('Day'); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-4 col-md-2"><?php echo __('Logintime'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo date("Y-m-d H:i:s",$user['logintime']); ?></div>
                                        <div class="col-xs-4 col-md-2"><?php echo __('Prevtime'); ?></div>
                                        <div class="col-xs-8 col-md-4"><?php echo date("Y-m-d H:i:s",$user['prevtime']); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </main>

        <footer class="footer" style="clear:both">
            <!-- FastAdmin是开源程序，建议在您的网站底部保留一个FastAdmin的链接 -->
            <!--<p class="copyright">Copyright&nbsp;©&nbsp;2017-2019 Powered by <a href="https://www.fastadmin.net" target="_blank">FastAdmin</a> All Rights Reserved <a href="http://www.beian.miit.gov.cn" target="_blank"><?php echo htmlentities($site['beian']); ?></a></p>-->
                        <p class="copyright"><a href="http://beian.miit.gov.cn" target="_blank">粤ICP备19158838号-1</a></p>

        </footer>

        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-frontend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>

    </body>

</html>