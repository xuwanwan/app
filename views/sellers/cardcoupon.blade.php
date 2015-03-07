@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{$card->name}}
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="center-block">
                    <img class="img-rounded" src="{{$card->mid_img_url}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    免费领取
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    面值：{{$card->origin_price}}
                </div>
                <div class="col-sm-3">
                    销量：{{$card->sales_volume}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    {{$card->deadline}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                套餐介绍
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="center-block">
                    {{$card->introduce}}
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                使用说明
            </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="center-block">
                    {{$card->instruction}}
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="{{URL::to('sellers/detail',['id'=>$card->seller_id])}}" target="_blank" >适用门店（1家）</a>
            </h4>
        </div>
    </div>

    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="col-sm-5 col-sm-offset-5">
            {{Form::open(['route'=>['order.coupon.post'], 'class'=>'form-horizontal'])}}
            {{Form::hidden('id', $card->id)}}
            {{Form::submit('立即领取', ['class'=>'btn btn-primary'])}}
            {{Form::close()}}
        </div>
    </nav>
@stop