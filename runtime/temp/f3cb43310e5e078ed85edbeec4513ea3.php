<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"F:\www\twothink\public/../application/home/view/default/article\lists.html";i:1533811004;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>Bootstrap 101 Template</title>
    <!-- Bootstrap -->
    <link href="/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .main{margin-bottom: 60px;}
        .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
    </style>
</head>
<body>
<div class="main">
    <!--导航部分-->
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center">
            <div class="col-xs-3">
                <p class="navbar-text"><a href="<?php echo url('index/index'); ?>" class="navbar-link">首页</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">服务</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">发现</a></p>
            </div>
            <div class="col-xs-3">
                <p class="navbar-text"><a href="#" class="navbar-link">我的</a></p>
            </div>
        </div>
    </nav>
    <!--导航结束-->

    <div class="container-fluid" >
        <div id="article_list">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
        <div class="row noticeList">
            <a href="<?php echo url('Article/detail?id='.$data['id']); ?>">
            <div class="col-xs-2">
                <img class="noticeImg" src="/static/image/2.png" />
            </div>
            <div class="col-xs-10">
                <p class="title"><?php echo $data['title']; ?></p>
                <p class="intro"><?php echo $data['description']; ?></p>
                <p class="info">浏览: <?php echo $data['view']; ?> <span class="pull-right"><?php echo $data['create_time']; ?></span> </p>
            </div>
            </a>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <button class="btn btn-default btn-block get_more" onclick="getLists()">获取更多。。。</button>
    </div>

    <!--<div class="page">-->
        <!--<?php echo $_page; ?>-->
    <!--</div>-->
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/static/jquery-1.11.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/static/bootstrap/js/bootstrap.min.js"></script>

<script>
    var page = 2;
    category=<?php echo $category['id']; ?>;
    var getLists = function () {
//        $(".get_more").remove();
        $.get("<?php echo url('article/page'); ?>?category="+category+"&page="+page,function(data){
            if(data==''){
                $(".get_more").html('没有更多了。。。');
            }
            $("#article_list").append(data);
        });
        page++;
    }
</script>
</body>
</html>