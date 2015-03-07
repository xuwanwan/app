@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{$seller->name}}
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="center-block">
                    <img class="img-rounded" src="{{$seller->mid_img_url}}">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    ****{{$seller->evaluation}}分
                </div>
                <div class="col-sm-3 col-sm-offset-3">
                    0人评分 >
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    电话：{{$seller->phone}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    地址：{{$seller->district_detail}}
                </div>
            </div>
        </div>
    </div>

    @if($seller->cardstored->count())
        <?php $cards = $seller->cardstored; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    储值卡
                </h4>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($cards as $row)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-rounded" src="{{$row->img_url}}">
                                </div>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <a href="{{URL::to('sellers/cardstored',['id'=>$row->id])}}" target="_blank"> 卡名：{{$row->name}}</a>
                                    </div>
                                    <div class="row">
                                        套餐介绍：{{$row->introduce}}
                                    </div>
                                    <div class="row">
                                        销量：{{$row->sales_volume}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if($seller->cardvip->count())
        <?php $cards = $seller->cardvip; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    会员卡
                </h4>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($cards as $row)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-rounded" src="{{$row->img_url}}">
                                </div>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <a href="{{URL::to('sellers/cardvip',['id'=>$row->id])}}" target="_blank"> 卡名：{{$row->name}}</a>
                                    </div>
                                    <div class="row">
                                        贵宾
                                    </div>
                                    <div class="row">
                                        销量：{{$row->sales_volume}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if($seller->cardvoucher->count())
        <?php $cards = $seller->cardvoucher; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    代金券
                </h4>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    @foreach($cards as $row)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img class="img-rounded" src="{{$row->img_url}}">
                                </div>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <a href="{{URL::to('sellers/cardvoucher',['id'=>$row->id])}}" target="_blank"> 卡名：{{$row->name}}</a>
                                    </div>
                                    <div class="row">
                                        售价：{{$row->price}}
                                    </div>
                                    <div class="row">
                                        销量：{{$row->sales_volume}}
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    @if($seller->cardcoupon->count())
        <?php $cards = $seller->cardcoupon; ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                优惠券
            </h4>
        </div>
        <div class="panel-body">
            <ul class="list-group">
                @foreach($cards as $row)
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-3">
                            <img class="img-rounded" src="{{$row->img_url}}">
                        </div>
                        <div class="col-sm-5">
                            <div class="row">
                                <a href="{{URL::to('sellers/cardcoupon',['id'=>$row->id])}}" target="_blank"> 卡名：{{$row->name}}</a>
                            </div>
                            <div class="row">
                                售价：{{$row->price}}
                            </div>
                            <div class="row">
                                售价：{{$row->introduce}}
                            </div>
                            <div class="row">
                                销量：{{$row->sales_volume}}
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                本店会员特权
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    {{$seller->privilege}}
                </div>
            </div>
        </div>
    </div>
    @if($seller->imgs->count())
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                商家图片
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                @foreach($seller->imgs as $row)
                <div class="col-sm-6 col-md-3">
                    <a href="#" class="thumbnail">
                        <img src="{{$row->path}}"
                             alt="通用的占位符缩略图">
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                商家介绍
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    {{$seller->introduce}}
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                在线联系商家
            </h3>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                设施服务
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php $s = nl2br($seller->services);?>
                    {{$s}}
                </div>
            </div>
        </div>
    </div>
@stop