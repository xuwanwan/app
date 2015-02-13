@section('content')

@if (Session::has('errors'))
Error!
{{{ Session::get('errors') }}}
<br/>
@endif


{{Form::open(['route'=>'auth.register', 'method'=>'post'])}}

{{Form::label('invite_phone')}}
{{Form::text('invite_phone')}}

{{Form::label('phone')}}
{{Form::text('phone')}}

{{Form::label('username')}}
{{Form::text('username')}}


{{Form::label('password')}}
{{Form::password('password')}}



{{Form::label('token')}}
{{Form::text('token')}}

{{Form::submit('Register')}}

{{Form::close()}}

@stop