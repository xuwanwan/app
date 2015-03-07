@section('content')


{{Form::open(['route'=>'member.location', 'method'=>'post', 'class'=>'form'])}}


{{Form::label('x', '经度')}}
{{Form::text('x')}}

{{Form::label('y', '纬度')}}
{{Form::text('y')}}

{{Form::submit('Submit')}}

{{Form::close()}}

@stop
