@section('content')


@if (Session::has('error'))
Error!
{{{ Session::get('error') }}}
@endif


{{Form::open(['route'=>'member.avatar', 'method'=>'post', 'files'=>true])}}


{{Form::label('avatar')}}
{{Form::file('avatar')}}


{{Form::submit('Submit')}}

{{Form::close()}}

@stop
