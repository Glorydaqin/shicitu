<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="诗词兔-古诗词大全作为传承经典的网站成立于2019年。诗词兔-古诗词大全专注于古诗文服务，致力于让古诗文爱好者更便捷地发表及获取古诗文相关资料。">
    <title>诗词兔-古诗词大全</title>
    <link rel="stylesheet" href="/web/css/reset.css">
    <link rel="stylesheet" href="/web/css/head.css">
    <link rel="stylesheet" href="/web/css/index.css">
    <link rel="stylesheet" href="/web/css/poetryList.css">
    <link rel="stylesheet" href="/web/css/paramBox.css">
    <link rel="stylesheet" href="/web/css/page.css">
    <link rel="shortcut icon" href="/web/img/favicon.ico">
    @section("css")
    @show
</head>
<body>
<div class="index">
    @include("web.header")

    <div class="main-content">
        @section("container")
        @show
    </div>
    @include("web.footer")
</div>
</body>
</html>