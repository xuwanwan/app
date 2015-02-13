
@section('content')

@if (Session::has('login_errors'))
Error!
{{{ Session::get('login_errors') }}}
@endif


{{Form::open(['route'=>'auth.login', 'method'=>'post'])}}


{{Form::label('phone')}}
{{Form::text('phone')}}

{{Form::label('password')}}
{{Form::password('password')}}

{{Form::label('remeberme')}}
{{Form::checkbox('remeberme', 1)}}


{{Form::submit('Login')}}

{{Form::close()}}

@stop