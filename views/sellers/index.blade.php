
@section('content')

    @include('partials.search-seller')

    @include('sellers.list', ['sellers'=> $data])

@stop
