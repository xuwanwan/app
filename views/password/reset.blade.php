
@section('content')

@if (Session::has('error'))
Error!
{{{ Session::get('error') }}}
@endif


{{Form::open(['action'=>'Controllers\RemindersController@postReset', 'method'=>'post'])}}

{{Form::label('token')}}
{{Form::text('token')}}

{{Form::label('phone')}}
{{Form::text('phone')}}

{{Form::label('password')}}
{{Form::password('password')}}

{{Form::label('password_confirmation')}}
{{Form::password('password_confirmation')}}

{{Form::submit('Reset Password')}}

{{Form::close()}}

@stop