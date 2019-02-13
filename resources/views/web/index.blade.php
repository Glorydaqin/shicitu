@extends("web.layout")

@section("container")

    <div class="left-box">

        <div class="poetry-list">
            @foreach($list as $item)
                <div class="poetry-item">
                    <a href="/info/{{ $item['id'] }}" target="_blank" class="title"><p>{{ $item['title'] }}</p></a>
                    <!-- <p class="title">小雅·蓼萧</p> -->
                    <p class="author">唐诗：{{ $item['author'] }}</p>
                    @php($content = json_decode($item['paragraphs'],true))
                    @foreach($content as $value)
                        <p class="content">{{ $value }}</p>
                    @endforeach
                </div>
            @endforeach
            <div class="page-box">
                {{ $list->links() }}
            </div>
            {{--@include("web.page")--}}
        </div>
    </div>
    <div class="right-box">

    </div>
@endsection