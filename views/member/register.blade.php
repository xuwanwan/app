@section('content')



{{Form::open(['route'=>'auth.register', 'method'=>'POST', 'class'=>'form-horizontal'])}}

<div class="form-group">
    {{Form::label('invite_phone','',['class'=>'col-sm-2 control-label'])}}
    <div class="col-sm-3">
        {{Form::text('invite_phone','',['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group">
    {{Form::label('phone','', ['class'=>'col-sm-2 control-label'])}}
    <div class="col-sm-3">
        {{Form::text('phone', '', ['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group">
    {{Form::label('username', '', ['class'=>'col-sm-2 control-label'])}}
    <div class="col-sm-3">
        {{Form::text('username', '', ['class'=>'form-control'])}}
    </div>
</div>


<div class="form-group">
    {{Form::label('password', '', ['class'=>'col-sm-2 control-label'])}}
    <div class="col-sm-3">
        {{Form::password('password',['class'=>'form-control'])}}
    </div>
</div>


<div class="form-group">
{{Form::label('token', '', ['class'=>'col-sm-2 control-label'])}}
    <div class="col-sm-3">
        {{Form::text('token', '', ['class'=>'form-control'])}}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-5 col-sm-offset-2">
        {{Form::submit('Register', ['class'=>'btn btn-default'])}}
    </div>
</div>
{{Form::close()}}

<div class="col-sm-3">
    {{Form::open(['route'=>'auth.code', 'method'=>'POST', 'id'=>'phoneform'])}}
    {{Form::hidden('hidphone')}}
    {{Form::button('发送验证短信', ['type'=>'submit','class'=>'form-control btn btn-warning'])}}
    {{Form::close()}}
</div>

@stop

@section('scripts')
    <script>
        $(function($){
           $("#phoneform").submit(function(e){
               phone = $("[name='phone']").val();
               $("[name='hidphone']").val(phone);
               $.post('{{URL::route('auth.code')}}', {'phone':phone, '_token':'<?php echo csrf_token();?>'}, function(data){
                   alert(data);
               });
               e.preventDefault();
//               return false;
           });
        });
    </script>
@stop