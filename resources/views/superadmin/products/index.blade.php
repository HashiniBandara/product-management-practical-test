@extends('superadmin.products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Product List View</h3>
            </div>
            <div class="text-right mt-2 mb-2">
                <a class="btn btn-success btn-sm" href="{{ route('superadmin.products.create') }}"> Create New Product</a>
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
        <th width="200px">Action</th>
    </tr>
    @foreach ($products as $product)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description ?? '-' }}</td>
        <td>{{ number_format($product->price, 2) }}</td>
        <td>{{ $product->stock_quantity }}</td>
        <td>
            <a class="btn btn-sm text-white" style="background-color:cadetblue" href="{{ route('superadmin.products.show',$product->id) }}">Show</a>
            <a class="btn btn-sm text-white" style="background-color:darkolivegreen" href="{{ route('superadmin.products.edit',$product->id) }}">Edit</a>
            <button class="btn delete-btn btn-sm text-white" style="background-color:maroon" data-toggle="modal" data-target="#confirmDeleteModal{{ $product->id }}">Delete</button>
        </td>
    </tr>
    @endforeach
</table>


    <!-- Confirmation Modal -->
    @foreach ($products as $product)
    <div class="modal fade" id="confirmDeleteModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form action="{{ route('superadmin.products.destroy', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- {!! $products->links() !!} --}}

    <div class="pagination">
        <ul class="pagination justify-content-center">
            @if ($products->currentPage() > 1)
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                        << Previous
                    </a>
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
        $('.delete-btn').click(function () {
            var modalId = $(this).data('target');
            $(modalId).modal('show');
        });
    </script>

@endsection
