@section('content')

    {{Form::open(['route'=>['order.stored.post'], 'class'=>'form-horizontal'])}}
    <div class="form-group">
        <div class="col-sm-10">
            {{$card->name}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('price','单价',['class'=>'col-sm-2 control-label'])}}
        <div class="col-sm-3">
            {{Form::text('price', $card->price, ['class'=>'form-control'])}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('price','数量',['class'=>'col-sm-2 control-label'])}}
        <div class="col-sm-3">
            {{Form::text('volume', '1', ['class'=>'form-control'])}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('price','原价',['class'=>'col-sm-2 control-label'])}}
        <div class="col-sm-3">
            {{Form::text('origin_price', $card->origin_price, ['class'=>'form-control'])}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('price','优惠',['class'=>'col-sm-2 control-label'])}}
        <div class="col-sm-3">
            {{Form::text('discount',$card->discount, ['class'=>'form-control'])}}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-3 col-sm-offset-2">
            {{Form::hidden('id', $card->id)}}
            {{Form::submit('提交订单', ['class'=>'btn btn-primary'])}}
        </div>
    </div>
    {{Form::close()}}

@stop
