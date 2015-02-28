@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">收货地址</h3>
        </div>
        <table class="table">
            <th>地区</th><th>详细地址</th><th>姓名</th><th>电话</th>
            <tr>
                <td>{{$district_path}}</td>
                <td>{{$order->district_detail}}</td>
                <td>{{$order->username}}</td>
                <td>{{$order->phone}}</td>
            </tr>
        </table>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">订单详情</h3>
        </div>
                <table class="table table-hover">
                    <caption>
                        订单号：{{$order->order_id}}
                    </caption>
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>图片</th>
                        <th>名称</th>
                        <th>分类</th>
                        <th>单价</th>
                        <th>运费</th>
                        <th>购买数量</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <?php $row = $product; ?>
                        <tr>
                            <td>{{$row->id}}</td>
                            <td> <img src="{{$row->img_url}}"> </td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->category_path}}</td>
                            <td>{{$row->price}}</td>
                            <td>{{$row->freight}}</td>
                            <td>{{$row->pivot->num}}</td>
                            <td>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
    </div>

    <div class="panel panel-info" >
    </div>
    </div>
@stop
