<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="诗词兔-古诗词大全作为传承经典的网站成立于2019年。诗词兔-古诗词大全专注于古诗文服务，致力于让古诗文爱好者更便捷地发表及获取古诗文相关资料。">
  <title>搜索结果|诗词兔-古诗词大全</title>
  <link rel="stylesheet" href="/web/css/reset.css">
  <link rel="stylesheet" href="/web/css/head.css">
  <link rel="stylesheet" href="/web/css/poetryList.css">
  <link rel="stylesheet" href="/web/css/paramBox.css">
  <link rel="stylesheet" href="/web/css/list.css">
  <link rel="stylesheet" href="/web/css/page.css">
  <link rel="shortcut icon" href="/web/img/favicon.ico">
</head>
<body>
  <div class="list">
    @include("web.header")
    <div class="main-content">
      <div class="left-content">
        <div class="search-param-box">
          <div class="param-item-box">
            <span class="title">类型</span>
            <select class="param-sel" name="type" id="typeSel">
              <option class="opt" value="1">写景</option>
              <option class="opt" value="2">咏物</option>
            </select>
          </div>
          <div class="param-item-box">
            <span class="title">作者</span>
            <select class="param-sel" name="author" id="authorSel">
              <option  class="opt" value="1">李白</option>
              <option  class="opt" value="2">杜甫</option>
            </select>
          </div>
          <div class="param-item-box">
            <span class="title">朝代</span>
            <select class="param-sel" name="dynasty" id="dynastySel">
              <option  class="opt" value="1">写景</option>
              <option  class="opt" value="2">咏物</option>
            </select>
          </div>
          <a href="javascript:;" class="search-btn" onclick="searchList()">查询</a>
        </div>
        @include("web.poetryList")
      </div>
      <div class="right-content">
        @include("web.paramBox")
      </div>
    </div>
    @include("web.footer")
  </div>
</body>
</html>