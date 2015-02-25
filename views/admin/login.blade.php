

@section('content')
<p class="lead">Please enter your details:</p>
<div class="well">
{{Form::open(['route'=>'admin.login', 'method'=>'post'])}}


{{Form::label('email')}}
{{Form::text('email')}}

{{Form::label('password')}}
{{Form::password('password')}}


{{Form::submit('Submit')}}


{{ Form::close() }}
</div>
@stop


