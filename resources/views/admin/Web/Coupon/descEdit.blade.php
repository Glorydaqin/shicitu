@extends("admin.layouts.form")

@section('title')
    <h5>编辑<small>商家图文描述</small>
        <a target="_blank" href="{{ $item->store_url }}">{{ $item->store_domain }}</a>
    </h5>
@endsection

@section('style')
@endsection

@section("form")
    <div class="ibox-content">
        <div class="row">

            <form method="post" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">商家名：</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" value="{{ $item->name }}">
                    </div>
                </div>
                {{--<div class="hr-line-dashed"></div>--}}
                {{--<div class="form-group">--}}
                    {{--<label class="col-sm-3 control-label">分类：</label>--}}
                    {{--<div class="col-sm-9">--}}
                        {{--<select name="category_id" class="form-control">--}}
                            {{--@foreach($category as $cate)--}}
                            {{--<option value="{{$cate->id}}" @if( $item->type == $cate->name ) selected @endif>{{ $cate->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">图片源：</label>
                    <div class="col-sm-9">
                        <input type="text" name="down_logo_path" value="{{ $item->down_logo_path }}" class="form-control">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">商家full desc：</label>
                    <div class="col-sm-9">
                        <textarea  name="store_full_desc" id="editor">
                            {{ $item->store_full_desc }}
                        </textarea>
                    </div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit" name="submit" onclick="this.submit()">保存内容</button>
                        <button class="btn btn-white" onclick="window.history.back(-1);">取消</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@section("script")
<script src="{{ asset("admin/plugins/ckeditor/ckeditor.js") }}"></script>
<script>
    CKEDITOR.replace( 'editor' , {
        filebrowserUploadUrl: "/admin/upFile", //设置图片上传请求地址
    });
</script>
@endsection