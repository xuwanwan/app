@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">清单</h3>
        </div>
        @if($orders->count())
            @foreach($orders as $order)
            <table class="table table-hover">
                <caption>
                    订单号：<a href="{{URL::route('orders.show', ['id'=>$order->id])}}" target="_blank">{{$order->order_id}}</a>
                    <div class="btn-group-vertical" >
                    {{Form::open(['url'=>URL::route('orders.destroy',['id'=>$order->id]), 'method'=>'DELETE'])}}
                    {{Form::button('取消订单', ['class'=>'btn btn-danger', 'type'=>'submit'])}}
                    {{Form::close()}}
                    {{Form::open(['url'=>URL::route('orders.destroy'), 'method'=>'POST'])}}
                    {{Form::button('支付', ['class'=>'btn btn-warning'])}}
                    {{Form::close()}}
                    </div>
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
                    <th>操作</th>
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
            @endforeach
        @endif
    </div>

    <div class="panel panel-info" >
    </div>
    </div>
@stop
