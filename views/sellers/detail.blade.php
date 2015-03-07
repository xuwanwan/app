@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-3">
                    <h3 class="panel-title">
                        {{$seller->name}}
                    </h3>
                </div>
                <div class="col-sm-3 col-sm-offset-3">
                    {{$seller->distance}}
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-3 center-block">
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
@stop
