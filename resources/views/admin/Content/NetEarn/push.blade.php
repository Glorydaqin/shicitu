@extends("admin.layouts.form")

@section('title')
    <h5>发布<small>网赚</small>
        <a target="_blank" href="{{ $item->url }}">{{ $item->url }}</a>
    </h5>
@endsection

@section('style')
@endsection

@section("form")
    <div class="ibox-content">
        <div class="row">
            <div class="col-sm-6">

                <form method="post" class="form-horizontal">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">新标题：</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" value="{{ $item->title }}" disabled>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类：</label>
                        <div class="col-sm-9">
                            <input type="text" name="category" class="form-control" value="{{ $item->type }}" disabled>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">作者：</label>
                        <div class="col-sm-9">
                            <input type="text" name="author" value="{{ $item->author }}" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea id="editorOld">{{ strip_tags($item->content,'<a><p><span><b><img>') }}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>


                </form>

            </div>

            <div class="col-sm-6">

                <form method="post" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">新标题：</label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" value="{{ $item->title }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">分类：</label>
                        <div class="col-sm-9">
                            <select name="category_id" class="form-control">
                                @foreach($category as $cate)
                                <option value="{{$cate->id}}" @if( $item->type == $cate->name ) selected @endif>{{ $cate->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">作者：</label>
                        <div class="col-sm-9">
                            <input type="text" name="author" value="{{ $item->author }}" class="form-control">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea  name="content" id="editorNew" autofocus>
                                <p> <span style="color:#E56600;"><b>[活动介绍]</b></span> </p><blockquote> <p>活动介绍</p> </blockquote>
                                <p> <span style="color:#FFE500;"><b>[活动奖励]</b></span> </p><blockquote> <p> 活动奖励 </p> </blockquote>
                                <p> <span style="color:#E53333;"><b>[注意事项]</b></span> </p> <blockquote> <p> 无 </p> </blockquote>
                                <p> <span style="color:#00D5FF;"><b>[操作流程]</b></span> </p> <blockquote> <p> 操作流程 </p> </blockquote>
                            </textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            @foreach($tag as $ta)
                            <label>
                                <input type="checkbox" name="tags_id[]" value="{{ $ta->id }}">
                                {{$ta->name}}
                            </label>&nbsp;
                            @endforeach
                            <div>
                                <input type="text" class="form-control" name="new_tag" value="" placeholder="新标签">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">活动地址：</label>
                        <div class="col-sm-9">
                            <input type="text" name="site_url" class="form-control" value="{{ $item->go_url }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">开始时间：</label>
                        <div class="col-sm-9">
                            <input type="datetime" name="start_time" class="form-control" value="{{ $item->release_date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">结束时间：</label>
                        <div class="col-sm-9">
                            <input type="datetime" name="end_time" class="form-control" value="{{ $item->expiration_date }}">
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

    </div>
@endsection

@section("script")
<script src="{{ asset("admin/plugins/ckeditor/ckeditor.js") }}"></script>
<script src="{{ asset("admin/plugins/laydate/laydate.js") }}"></script>
<script>
    CKEDITOR.replace( 'editorOld' );
    CKEDITOR.replace( 'editorNew' );
    //常规用法
    laydate.render({
        elem: 'input[name="start_time"]'
    });
    laydate.render({
        elem: 'input[name="end_time"]'
    });
</script>
@endsection