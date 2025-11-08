@extends('user.products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Product List View</h3>
            </div>
            <div class="text-right mt-2 mb-2">
                {{-- <a class="btn btn-success btn-sm" href="{{ route('user.products.create') }}"> Create New Product</a> --}}
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock Quantity</th>

        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description ?? '-' }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock_quantity }}</td>

            </tr>
        @endforeach
    </table>


    {{-- {!! $products->links() !!} --}}

    <div class="pagination">
        <ul class="pagination justify-content-center">
            @if ($products->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                        << Previous </a>
                </li>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item {{ $i === $products->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($products->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                        Next >>
                    </a>
                </li>
            @endif
        </ul>
    </div>

    <script>
        // Handle the click event on the Delete button
        $('.delete-btn').click(function() {
            var modalId = $(this).data('target');
            $(modalId).modal('show');
        });
    </script>
@endsection
