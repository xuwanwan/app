
@section('content')


{{Form::open(['route'=>'auth.login', 'method'=>'post', 'class'=>'form-horizontal'])}}

<div class="form-group">

{{Form::label('phone','', ['class'=>'col-sm-2 control-label'])}}

<div class="col-sm-5">
{{Form::text('phone', '', ['class'=>'form-control', 'placeholder'=>'phone'])}}
</div>
</div>

<div class="form-group">
{{Form::label('password', '', ['class'=>'col-sm-2 control-label'])}}

<div class="col-sm-5">
{{Form::password('password', ['class'=>'form-control', 'placeholder'=>'password'])}}
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-2 col-sm-5">
{{Form::label('remeberme')}}
{{Form::checkbox('remeberme', 1)}}
</div>
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-5">
    {{Form::button('Login', ['class'=>'btn btn-default', 'type'=>'submit'])}}
    </div>
</div>

{{Form::close()}}

@stop