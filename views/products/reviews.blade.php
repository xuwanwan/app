
@section('content')

 @foreach($reviews as $key => $val)
        <ul>
            <li>评分：{{$val['rating']}}</li>
            <li>发表人：{{$val['author']}}</li>
            <li>标题：{{$val['title']}}</li>
            <li>内容：{{$val['text']}}</li>
            <li>发表时间：{{$val['created_at']}}</li>
        </ul>
        <hr>
@endforeach

    	<form action='http://weile.app.com/products/1/reviews' method="post">
		<table>
			<tr><td>评分：</td><td><input type="text" value="{{ Input::old('rating') }}" name="rating" />
                    {{ $errors->first('rating', '<span style="color:#c7254e;margin-top:1em;">:message</span>') }}
                </td></tr>
			<tr><td>标题：</td><td><input type="text" value="{{ Input::old('title') }}" name="title" />
                    {{ $errors->first('title', '<span style="color:#c7254e;margin-top:1em;">:message</span>') }}
                </td></tr>
			<tr>
                <td>昵称：</td><td><input type="text" value="{{ Input::old('author') }}" name="author" />
                    {{ $errors->first('author', '<span style="color:#c7254e;margin-top:1em;">:message</span>') }}
                </td></tr>
			<tr>
                <td>内容：</td><td><input type="text" value="{{ Input::old('content') }}" name="content" />
                    {{ $errors->first('content', '<span style="color:#c7254e;margin-top:1em;">:message</span>') }}
                </td></tr>

			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			<tr><td><input type="submit" value="提交" /></td></tr>
		</table>
	</form>

@stop
