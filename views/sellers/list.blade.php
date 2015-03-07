@if($sellers->count())
<table class="table table-hover">
    <caption>列表</caption>
    <thead>
    <tr>
        <th>id</th>
        <th>图片</th>
        <th class="col-sm-1">名称</th>
        <th>所售卡券</th>
        <th>评分</th>
        <th>分类</th>
        <th>距离</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sellers as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td><img src="{{$row->img_url}}"> </td>
            <td>{{$row->name}}</td>
            <td>
                @if($row->card_type1)
                    优惠卡-
                @endif
                @if($row->card_type2)
                    会员卡-
                @endif
                @if($row->card_type3)
                    储值卡-
                @endif
                @if($row->card_type4)
                    代金券-
                @endif
            </td>
            <td>{{$row->evaluation}}</td>
            <td>{{$row->category_path}}</td>
            <td>{{$row->distance}}</td>
            <td >
                <a href="{{URL::route('sellers.show', ['id'=>$row->id])}}" target="_blank">详情</a>
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


@if($sellers->count())
    <div class="row">
        <div class="col-md-12 text-center">
            @if(isset($appends))
                {{ $sellers->appends($appends)->links(); }}
            @else
                {{ $sellers->links(); }}
            @endif
        </div>
    </div>
@endif
