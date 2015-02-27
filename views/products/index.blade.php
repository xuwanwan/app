
@section('content')

    @include('partials.search-product')

    @include('products.list', ['products'=> $products])

@stop
