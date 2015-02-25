@section('content')


    {{Form::open(['url'=>URL::route('member.delivery.update', ['id'=>$delivery->id]), 'method'=>'PUT'])}}

    {{Form::label('username', '收货人姓名')}}
    {{Form::text('username', $delivery->username)}}

    {{Form::label('phone', '电话')}}
    {{Form::text('phone', $delivery->phone)}}

    {{Form::label('postalcode', '邮编')}}
    {{Form::text('postalcode', $delivery->postalcode)}}


    {{Form::label('district', '地区')}}
    {{Form::select('district', $form_data, $delivery->district)}}


    {{Form::label('detail', '详细地址')}}
    {{Form::text('detail', $delivery->detail)}}

    {{Form::submit('Submit')}}

    {{Form::close()}}

@stop