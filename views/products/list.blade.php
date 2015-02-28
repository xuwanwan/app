@if($products->count())
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
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $row)
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
            <td >
                {{Form::open(['url'=>URL::route('shopcart.store'), 'method'=>'POST'])}}
                {{Form::hidden('id', $row->id)}}
                {{Form::hidden('name', $row->name)}}
                {{Form::hidden('qty', 1)}}
                {{Form::hidden('price', $row->price)}}
                {{Form::button('添加购物车', ['type'=>'submit','class'=>'btn btn-sm btn-primary'])}}
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


@if($products->count())
    <div class="row">
        <div class="col-md-12 text-center">
            @if(isset($appends))
                {{ $products->appends($appends)->links(); }}
            @else
                {{ $products->links(); }}
            @endif
        </div>
    </div>
@endif
