<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:91:"C:\Users\Administrator\Desktop\fastAdmin\public/../application/index\view\user\dynamic.html";i:1571920145;s:83:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\layout\default.html";i:1571031854;s:80:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\common\meta.html";i:1570347773;s:83:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\common\sidenav.html";i:1571655994;s:82:"C:\Users\Administrator\Desktop\fastAdmin\application\index\view\common\script.html";i:1570347773;}*/ ?>
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
    option:hover{
        background: #ccc
    }
        /* .panel-default{
            height: 600px;
        } */
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
                                <h2 class="page-header">申请连接账号 </h2>
                                <form id="add-form" class="form-horizontal nice-validator n-default n-bootstrap" role="form"
                                    data-toggle="validator" method="POST" action="" novalidate="novalidate">
                                    <input type="hidden" name="__token__" value="4819e6b5be09728df139925f8b89fb56">
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4"> 服务器后台：</label>
                                        <div class="col-xs-12 col-sm-4">
                                        <select class="form-control selectpicker" name="server" >
                                            
                                                    <option value="">b服务器后台</option>
                                                    <option value="0">e服务器后台</option> 
                                            </div>
                                                 
                                        </select>
                                    </div>
                                    </div>
            
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">连接账号:</label>
                                        <div class="col-xs-12 col-sm-4">
                                            <input name="row[name]" class="form-control" type="text" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">连接密码:</label>
                                        <div class="col-xs-12 col-sm-4">
                                            <input name="row[password]" class="form-control" type="text" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">账号创建数量:</label>
                                        <div class="col-xs-12 col-sm-4">
                                            <input id="num" name="code[accountTotal]" class="form-control" type="text" value="1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">IP地区:</label>
                                        <div class="col-xs-12 col-sm-4">
                                                <select id="link" class="selectpicker form-control" name="row[defaultLink]"
                                                    tabindex="-98">
                                                    <option value="0" selected="selected">请选择默认线路</option>
                                                    <option value="1">上海</option>
                                                    <option value="2">北京</option>
                                                    <option value="3">江苏</option>
                                                    <option value="4">浙江</option>
                                                    <option value="5">山东</option>
                                                    <option value="6">福建</option>
                                                    <option value="7">河北</option>
                                                    <option value="9">深圳</option>
                                                    <option value="10">重庆</option>
                                                    <option value="11">青岛</option>
                                                    <option value="12">杭州</option>
                                                    <option value="13">厦门</option>
                                                    <option value="14">广东</option>
                                                    <option value="15">广州</option>
                                                    <option value="16">天津</option>
                                                    <option value="17">苏州</option>
                                                    <option value="18">武汉</option>
                                                    <option value="19">成都</option>
                                                    <option value="20">南京</option>
                                                    <option value="21">无锡</option>
                                                    <option value="22">佛山</option>
                                                    <option value="23">宁波</option>
                                                    <option value="24">大连</option>
                                                    <option value="25">郑州</option>
                                                    <option value="26">沈阳</option>
                                                    <option value="27">烟台</option>
                                                    <option value="28">济南</option>
                                                    <option value="29">东莞</option>
                                                    <option value="30">泉州</option>
                                                    <option value="31">南通</option>
                                                    <option value="32">唐山</option>
                                                    <option value="33">西安</option>
                                                    <option value="34">哈尔滨</option>
                                                    <option value="35">合肥</option>
                                                    <option value="36">福州</option>
                                                    <option value="37">长春</option>
                                                    <option value="38">石家庄</option>
                                                    <option value="39">潍坊</option>
                                                    <option value="40">徐州</option>
                                                    <option value="41">常州</option>
                                                    <option value="42">温州</option>
                                                    <option value="43">绍兴</option>
                                                    <option value="44">鄂尔多斯</option>
                                                    <option value="45">济宁</option>
                                                    <option value="46">淄博</option>
                                                    <option value="47">大庆</option>
                                                    <option value="48">河北省秦皇岛</option>
                                                    <option value="49">河北省邯郸</option>
                                                    <option value="50">河北省邢台</option>
                                                    <option value="51">河北省保定</option>
                                                    <option value="52">河北省张家口</option>
                                                    <option value="53">河北省承德</option>
                                                    <option value="54">河北省沧州</option>
                                                    <option value="55">河北省廊坊</option>
                                                    <option value="56">河北省衡水</option>
                                                    <option value="57">山西省太原</option>
                                                    <option value="58">山西省大同</option>
                                                    <option value="59">山西省阳泉</option>
                                                    <option value="60">山西省长治</option>
                                                    <option value="61">山西省晋中</option>
                                                    <option value="62">山西省运城</option>
                                                    <option value="63">山西省忻州</option>
                                                    <option value="64">山西省临汾</option>
                                                    <option value="65">内蒙古呼和浩特</option>
                                                    <option value="66">内蒙古包头</option>
                                                    <option value="67">内蒙古赤峰</option>
                                                    <option value="68">内蒙古通辽</option>
                                                    <option value="69">内蒙古呼伦贝尔</option>
                                                    <option value="70">内蒙古巴彦淖尔</option>
                                                    <option value="71">内蒙古乌兰察布</option>
                                                    <option value="72">辽宁省鞍山</option>
                                                    <option value="73">辽宁省抚顺</option>
                                                    <option value="74">辽宁省锦州</option>
                                                    <option value="75">辽宁省盘锦</option>
                                                    <option value="76">吉林省吉林</option>
                                                    <option value="77">吉林省四平</option>
                                                    <option value="78">吉林省延边</option>
                                                    <option value="79">黑龙江省齐齐哈尔</option>
                                                    <option value="80">黑龙江省牡丹江</option>
                                                    <option value="81">江苏省连云港</option>
                                                    <option value="82">江苏省淮安</option>
                                                    <option value="83">江苏省盐城</option>
                                                    <option value="84">江苏省扬州</option>
                                                    <option value="85">江苏省镇江</option>
                                                    <option value="86">江苏省泰州</option>
                                                    <option value="87">江苏省宿迁</option>
                                                    <option value="88">浙江省嘉兴</option>
                                                    <option value="89">浙江省湖州</option>
                                                    <option value="90">浙江省金华</option>
                                                    <option value="91">浙江省衢州</option>
                                                    <option value="92">浙江省舟山</option>
                                                    <option value="93">浙江省台州</option>
                                                    <option value="94">浙江省丽水</option>
                                                    <option value="95">安徽省芜湖</option>
                                                    <option value="96">安徽省蚌埠</option>
                                                    <option value="97">安徽省马鞍山</option>
                                                    <option value="98">安徽省淮北</option>
                                                    <option value="99">安徽省安庆</option>
                                                    <option value="100">安徽省滁州</option>
                                                    <option value="101">安徽省六安</option>
                                                    <option value="102">福建省莆田</option>
                                                    <option value="103">福建省三明</option>
                                                    <option value="104">福建省漳州</option>
                                                    <option value="105">福建省南平</option>
                                                    <option value="106">福建省龙岩</option>
                                                    <option value="107">福建省宁德</option>
                                                    <option value="108">江西省南昌</option>
                                                    <option value="109">江西省赣州</option>
                                                    <option value="110">江西省吉安</option>
                                                    <option value="111">江西省抚州</option>
                                                    <option value="112">江西省上饶</option>
                                                    <option value="113">山东省枣庄</option>
                                                    <option value="114">山东省东营</option>
                                                    <option value="115">山东省泰安</option>
                                                    <option value="116">山东省威海</option>
                                                    <option value="117">山东省日照</option>
                                                    <option value="118">山东省临沂</option>
                                                    <option value="119">山东省德州</option>
                                                    <option value="120">山东省聊城</option>
                                                    <option value="121">山东省滨州</option>
                                                    <option value="122">山东省菏泽</option>
                                                    <option value="123">河南省开封</option>
                                                    <option value="124">河南省洛阳</option>
                                                    <option value="125">河南省平顶山</option>
                                                    <option value="126">河南省安阳</option>
                                                    <option value="127">河南省新乡</option>
                                                    <option value="128">河南省焦作</option>
                                                    <option value="129">河南省许昌</option>
                                                    <option value="130">河南省南阳</option>
                                                    <option value="131">河南省商丘</option>
                                                    <option value="132">河南省信阳</option>
                                                    <option value="133">河南省周口</option>
                                                    <option value="134">湖北省黄石</option>
                                                    <option value="135">湖北省十堰</option>
                                                    <option value="136">湖北省宜昌</option>
                                                    <option value="137">湖北省孝感</option>
                                                    <option value="138">湖北省荆州</option>
                                                    <option value="139">湖北省黄冈</option>
                                                    <option value="140">湖南省长沙</option>
                                                    <option value="141">湖南省株洲</option>
                                                    <option value="142">湖南省湘潭</option>
                                                    <option value="143">湖南省衡阳</option>
                                                    <option value="144">湖南省邵阳</option>
                                                    <option value="145">湖南省岳阳</option>
                                                    <option value="146">湖南省常德</option>
                                                    <option value="147">湖南省张家界</option>
                                                    <option value="148">湖南省益阳</option>
                                                    <option value="149">湖南省郴州</option>
                                                    <option value="150">湖南省怀化</option>
                                                    <option value="151">湖南省娄底</option>
                                                    <option value="152">广东省韶关</option>
                                                    <option value="153">广东省珠海</option>
                                                    <option value="154">广东省汕头</option>
                                                    <option value="155">广东省江门</option>
                                                    <option value="156">广东省湛江</option>
                                                    <option value="157">广东省茂名</option>
                                                    <option value="158">广东省肇庆</option>
                                                    <option value="159">广东省惠州</option>
                                                    <option value="160">广东省梅州</option>
                                                    <option value="161">广东省汕尾</option>
                                                    <option value="162">广东省河源</option>
                                                    <option value="163">广东省阳江</option>
                                                    <option value="164">广东省清远</option>
                                                    <option value="165">广东省中山</option>
                                                    <option value="166">广东省潮州</option>
                                                    <option value="167">广东省揭阳</option>
                                                    <option value="168">广东省云浮</option>
                                                    <option value="169">广西南宁</option>
                                                    <option value="170">广西柳州</option>
                                                    <option value="171">广西桂林</option>
                                                    <option value="172">广西梧州</option>
                                                    <option value="173">广西北海</option>
                                                    <option value="174">广西贵港</option>
                                                    <option value="175">广西玉林</option>
                                                    <option value="176">广西百色</option>
                                                    <option value="177">海南省海口</option>
                                                    <option value="178">四川省泸州</option>
                                                    <option value="179">四川省德阳</option>
                                                    <option value="180">四川省绵阳</option>
                                                    <option value="181">四川省乐山</option>
                                                    <option value="182">四川省南充</option>
                                                    <option value="183">四川省眉山</option>
                                                    <option value="184">四川省宜宾</option>
                                                    <option value="185">贵州省贵阳</option>
                                                    <option value="186">贵州省遵义</option>
                                                    <option value="187">贵州省黔东南</option>
                                                    <option value="188">云南省昆明</option>
                                                    <option value="189">云南省曲靖</option>
                                                    <option value="190">云南省玉溪</option>
                                                    <option value="191">云南省保山</option>
                                                    <option value="192">云南省临沧</option>
                                                    <option value="193">云南省楚雄</option>
                                                    <option value="194">云南省红河</option>
                                                    <option value="195">云南省文山</option>
                                                    <option value="196">云南省西双版纳</option>
                                                    <option value="197">云南省大理</option>
                                                    <option value="198">云南省德宏</option>
                                                    <option value="199">陕西省宝鸡</option>
                                                    <option value="200">陕西省咸阳</option>
                                                    <option value="201">陕西省渭南</option>
                                                    <option value="202">陕西省安康</option>
                                                    <option value="203">甘肃省兰州</option>
                                                    <option value="204">青海省西宁</option>
                                                    <option value="205">新疆乌鲁木齐</option>
                                                    <option value="206">新疆昌吉</option>
                                                    <option value="207">新疆巴音郭楞</option>
                                                    <option value="208">新疆伊犁</option>
                                                    <option value="209">山西省</option>
                                                    <option value="210">内蒙古</option>
                                                    <option value="211">辽宁省</option>
                                                    <option value="212">吉林省</option>
                                                    <option value="213">黑龙江省</option>
                                                    <option value="214">安徽省</option>
                                                    <option value="215">江西省</option>
                                                    <option value="216">河南省</option>
                                                    <option value="217">湖北省</option>
                                                    <option value="218">湖南省</option>
                                                    <option value="219">广西</option>
                                                    <option value="220">海南省</option>
                                                    <option value="221">四川省</option>
                                                    <option value="222">贵州省</option>
                                                    <option value="223">云南省</option>
                                                    <option value="224">陕西省</option>
                                                    <option value="225">甘肃省</option>
                                                    <option value="226">青海省</option>
                                                    <option value="227">宁夏</option>
                                                    <option value="228">新疆</option>
                                                    <option value="229">全国随机</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">运营商:</label>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="radio"><label for="row[isp]-1"><input id="row[isp]-1" name="row[isp]"
                                                        type="radio" value="1"> 联通</label> <label for="row[isp]-2"><input
                                                        id="row[isp]-2" name="row[isp]" type="radio" value="2"> 电信</label> <label
                                                    for="row[isp]-3"><input id="row[isp]-3" name="row[isp]" type="radio" value="3">
                                                    移动</label> <label for="row[isp]-0"><input id="row[isp]-0" checked="checked"
                                                        name="row[isp]" type="radio" value="0"> 不限</label></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">可使用IP数量:</label>
                                        <div class="col-xs-12 col-sm-4">
                                            <input id="count" name="row[count]" class="form-control" type="text" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">动态ip账号在线超时设置:</label>
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="radio"><label for="row[timeoutExec]-add"><input id="row[timeoutExec]-add"
                                                        checked="checked" name="row[timeoutExec]" type="radio" value="add"> 超时后
                                                    每隔5分钟 增加1个使用次数（老手推荐）</label> <label for="row[timeoutExec]-offline"><input
                                                        id="row[timeoutExec]-offline" name="row[timeoutExec]" type="radio"
                                                        value="offline"> 超时后 断开连接 推荐上一个（新人推荐 防止忘记断开连接点数被扣光）</label></div>
                                        </div>
                                    </div>
                                    <div class="form-group" hidden="">
                                        <label class="control-label col-xs-12 col-sm-4">过期时间:</label>
                                        <div class="col-xs-12 col-sm-4" style="position: relative;">
                                            <input data-date-format="YYYY-MM-DD" data-use-current="true"
                                                class="datetimepicker form-control" name="row[expireDate]" type="text"
                                                value="2025-10-10"> </div>
                                    </div>
                                    <div class="form-group" hidden="">
                                        <div class="col-xs-12 col-sm-4">
                                            <input name="row[linkId]" class="form-control" type="text"
                                                value="1,2,3,4,5,6,7,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,221,222,223,224,225,226,227,228,229">
                                        </div>
                                    </div>
                                    <div class="form-group" hidden="">
                                        <div class="col-xs-12 col-sm-4">
                                            <input id="linkname" name="link[linkname]" class="form-control" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">点数:</label>
                                        <label class="control-label col-xs-12 col-sm-4" style="text-align:left"><span
                                                style="color:red" id="code"></span></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-4">可用点数:</label>
                                        <label class="control-label col-xs-12 col-sm-4" style="text-align:left"><span
                                                style="color:#18bc9c">0</span></label>
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