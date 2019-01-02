@extends("admin.layouts.form")

@section('title')
    <h5>发布<small>小程序</small></h5>
@endsection

@section("form")
    <div class="ibox-content">
        <form method="post" class="form-horizontal">
            {{ csrf_field() }}

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Img</th>
                    <th>内容</th>
                    <th>批量修改分类
                        <select class="form-control m-b" name="cate" id="cate">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                            @endforeach
                        </select>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                <tr>
                    <td>
                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                        <input type="hidden" name="path[]" value="{{ $item->real_path }}">
                        <img style="max-width: 250px;" src="{{ $item->real_path }}" alt="">
                    </td>
                    <td>
                        <textarea name="content[]" class="form-control" rows="5">{{ $item->content }}</textarea>
                    </td>
                    <td>
                        <select class="form-control m-b" name="category_id[]">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->cate_name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>


            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary" type="submit" name="submit" onclick="this.submit()">保存内容</button>
                    <button class="btn btn-white" onclick="window.history.back(-1);">取消</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section("script")
<script>
    $("#cate").change(function () {
        var select_val =  this.value;
        $("select[name='category_id[]'").children("option").each(function(){
            var temp_value = $(this).val();
            if(temp_value == select_val){
                $(this).attr("selected",true);
            }else{
                $(this).attr('selected', false);
            }
        });
    })
</script>
@endsection