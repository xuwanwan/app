
@section('content')

    @if($q != '')
        @include('partials.search-product', ['q'=>$q])
        @include('products.list', ['products'=> $products, 'appends'=>$q])

    @else
        @include('partials.search-product')
        <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
            <h1 class="page-title">No keyword!</h1>
        </div>
    @endif

@stop
