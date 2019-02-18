@extends("web.layout")
@section("css")
<link rel="stylesheet" href="/web/css/poetryDetail.css">
@endsection

@section("container")
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
   
@endsection
