@section('content')

    <table class="table table-hover">
        <caption>列表</caption>
        <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>phone</th>
            <th>postalcode</th>
            <th>district</th>
            <th>default</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->username}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->postalcode}}</td>
            <td>{{$row->district}}</td>
            <td>{{$row->default}}</td>
            <td >
                {{Form::open(['url'=>URL::route('member.delivery.destroy', ['id'=>$row->id]), 'method'=>'DELETE'])}}
                {{Form::button('delete', ['class'=>'btn-danger btn-xs', 'type'=>'submit'])}}
                {{Form::close()}}
                <a href="{{URL::action('Controllers\MemberDeliveriesController@setDefault', ['id'=>$row->id])}}" class="btn btn-primary btn-xs">default</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <!-- 模态框（Modal） -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        模态框（Modal）标题
                    </h4>
                </div>
                <div class="modal-body">
                    在这里添加一些文本
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <button type="button" class="btn btn-primary">
                        提交更改
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->

@stop
@section('scripts')
<script>
    !function ($) {

        $(function(){

//            $('[data-toggle="confirmation"]').confirmation();
//            $('[data-toggle="confirmation-singleton"]').confirmation({singleton:true});
//            $('[data-toggle="confirmation-popout"]').confirmation({popout: true});

            $('.btn-danger').on("click",function(event){
//                event.preventDefault();
                return confirm('Are you sure?');

            })

        })

    }(window.jQuery)
</script>
@stop
