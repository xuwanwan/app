
@if($contents->count())

    {{Form::open(['url'=>URL::route('shopcart.destroy', ['id'=>0]), 'method'=>'DELETE'])}}
    {{Form::button('清空购物车', ['type'=>'submit','class'=>'btn btn-sm btn-danger'])}}
    {{Form::close()}}

    <div>总金额:{{$total}}</div>
    <div><a href="{{URL::route('settle')}}" target="_blank" class="btn btn-primary" >结算:{{$contents->count()}}</a> </div>

    <table class="table table-hover">
        <caption>列表</caption>
        <thead>
        <tr>
            <th>id</th>
            <th>图片</th>
            <th>名称</th>
            <th>分类</th>
            <th>单价</th>
            <th>销量</th>
            <th>地区</th>
            <th>介绍</th>
            <th>运费</th>
            <th>购买数量</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contents as $val)
            <?php $row = $val->product; ?>
            <tr>
                <td>{{$row->id}}</td>
                <td><img src="{{$row->img_url}}"> </td>
                <td>{{$row->name}}</td>
                <td>{{$row->category_path}}</td>
                <td>{{$row->price}}</td>
                <td>{{$row->sales_volume}}</td>
                <td>{{$row->district_path}}</td>
                <td>{{$row->description}}</td>
                <td>{{$row->freight}}</td>
                <td>{{$val->qty}}</td>
                <td>
                    {{Form::open(['url'=>URL::route('shopcart.update', ['id'=>$row->id]), 'method'=>'PUT'])}}
                    {{Form::hidden('cartid', $val->rowid)}}
                    {{Form::text('num', $val->qty)}}
                    {{Form::submit('更新数量')}}
                    {{Form::close()}}


                    {{Form::open(['url'=>URL::route('shopcart.destroy', ['id'=>$row->id]), 'method'=>'DELETE'])}}
                    {{Form::hidden('cartid', $val->rowid)}}
                    {{Form::button('删除', ['type'=>'submit','class'=>'btn btn-sm btn-danger'])}}
                    {{Form::close()}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <div class="col-lg-12">
        <div class="alert alert-danger">
            无内容
        </div>
    </div>
@endif


@if($contents->count())
    <div class="row">
        <div class="col-md-12 text-center">
            @if(isset($appends))
                {{ $contents->appends($appends)->links(); }}
            @else
                {{ $contents->links(); }}
            @endif
        </div>
    </div>
@endif

