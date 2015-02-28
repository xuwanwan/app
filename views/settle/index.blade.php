@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">收货地址</h3>
        </div>
        <table class="table">
            <th>地区</th><th>详细地址</th><th>姓名</th><th>电话</th>
            <tr>
                <td>{{$delivery->district_path}}</td>
                <td>{{$delivery->detail}}</td>
                <td>{{$delivery->username}}</td>
                <td>{{$delivery->phone}}</td>
            </tr>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">商品清单</h3>
        </div>
        @if($products->count())
        <table class="table table-hover">
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
            @foreach($products as $val)
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div class="panel panel-info" >
        <div class="panel-heading">总金额：{{$total}} 含运费：{{$freight}}</div>
        {{Form::open(['action'=>'Controllers\SettleController@makeOrder', 'method'=>'POST'])}}
        {{Form::hidden('amount', $total)}}
        {{Form::hidden('freight', $freight)}}
        {{Form::hidden('username', $delivery->username)}}
        {{Form::hidden('phone', $delivery->phone)}}
        {{Form::hidden('district', $delivery->district)}}
        {{Form::hidden('district_detail', $delivery->detail)}}
        {{Form::submit('提交订单',['class'=>'btn btn-primary'])}}
        {{Form::close()}}
        </div>
    </div>
@stop