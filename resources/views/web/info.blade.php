@extends("web.layout")

@section("container")
    <div class="title-box">
        <span class="title title-line">{{ $item['title'] }}</span>
        <span class="title">-</span><span class="title">唐朝：{{ $item['author'] }}</span>

        <div class="poetry-item">

            @php($content = json_decode($item['paragraphs'],true))
            @foreach($content as $value)
                <p class="content">{{ $value }}</p>
            @endforeach
        </div>
    </div>
@endsection