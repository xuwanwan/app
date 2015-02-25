
@section('content')

    {{Form::open(['url'=>URL::route('member.delivery.store'), 'method'=>'POST'])}}

    {{Form::label('username', '收货人姓名')}}
    {{Form::text('username')}}

    {{Form::label('phone', '电话')}}
    {{Form::text('phone')}}

    {{Form::label('postalcode', '邮编')}}
    {{Form::text('postalcode')}}


    {{Form::label('district', '地区')}}
    {{Form::select('district', $form_data)}}


    {{Form::label('detail', '详细地址')}}
    {{Form::text('detail')}}

    {{Form::submit('Submit')}}

    {{Form::close()}}

@stop