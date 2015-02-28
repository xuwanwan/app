
@section('content')

    @include('partials.search-product')

    @include('shopcart.list', ['contents'=> $contents])

@stop
