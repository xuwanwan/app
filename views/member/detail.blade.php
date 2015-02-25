
@section('content')


{{Form::open(['route'=>'member.detail', 'method'=>'post'])}}


{{Form::label('username','昵称')}}
{{Form::text('username')}}
<br/>

{{Form::label('sign','个性签名')}}
{{Form::password('sign')}}
<br/>

{{Form::label('sex','性别')}}
{{Form::select('sex', $select_sex)}}
<br/>

{{Form::label('birthday_year','年')}}
{{Form::selectYear('birthday_year', '1950', '2015')}}
{{Form::label('birthday_month','月')}}
{{Form::selectMonth('birthday_month')}}
{{Form::label('birthday_day','日')}}
{{Form::selectRange('birthday_day', 1, 31)}}
<br/>

{{Form::label('now_district','现居地')}}
{{Form::select('now_district', $select_now_district)}}
<br/>

{{Form::label('birth_district','出生地')}}
{{Form::select('birth_district', $select_birth_district)}}
<br/>

{{Form::label('height','身高')}}
{{Form::text('height')}}
<br/>


{{Form::label('education','学历')}}
{{Form::select('education', $select_education)}}
<br/>

{{Form::label('profession','行业')}}
{{Form::select('profession', $select_profession)}}
<br/>

{{Form::label('monthly_income','月收入')}}
{{Form::select('monthly_income', $select_monthly_income)}}
<br/>

{{Form::label('position','职位')}}
{{Form::select('position', $select_position)}}
<br/>

{{Form::label('house','住房情况')}}
{{Form::select('house', $select_house)}}
<br/>

{{Form::label('traffic','交通情况')}}
{{Form::select('traffic', $select_traffic)}}
<br/>

{{Form::label('marriage_status','婚恋情况')}}
{{Form::select('marriage_status', $select_marriage_status)}}
<br/>

{{Form::submit('Submit')}}

{{Form::close()}}

@stop
