@section('content')

@if (Session::has('error'))
error!
@elseif(Session::has('status'))
success!
@endif

{{Form::open(['action'=>'Controllers\RemindersController@postRemind', 'method'=>'post'])}}
     {{ Form::label('phone', 'Phone') }}
     {{ Form::text('phone', null, ['placeholder' => 'Phone'])}}
    <input type="submit" value="Send Reminder">

{{Form::close()}}

@stop