@extends("web.layout")
@section("css")
<link rel="stylesheet" href="/web/css/poetryDetail.css">
@endsection

@section("container")
    <div class="left-content">
        <div class="title-box">
            <span class="title title-line">{{ $item['title'] }}</span>
            <span class="title">-</span><span class="title">唐朝：{{ $item['author'] }}</span>
        </div>
        <div class="poetry-item">
            @php($content = json_decode($item['paragraphs'],true))
            @foreach($content as $value)
                <p class="content">{{ $value }}</p>
            @endforeach
        </div>
    </div>
    <div class="right-content">
        <img src="/web/img/zan.jpg" alt="赞赏码" class="qr-code">
        <img src="/web/img/zan2.jpg" alt="赞赏码" class="qr-code">
        <img src="/web/img/mini.jpg" alt="小程序二维码" class="qr-code">
        <div class="text-box">
            <p class="text">诗词兔</p>
            <p class="text">关注学习更多诗词</p>
        </div>
    </div>

@endsection
