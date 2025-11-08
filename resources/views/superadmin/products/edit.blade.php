@extends('superadmin.products.layout')

@section('content')
<div class="row mx-1 mr-1 me-1 mt-4 mb-2">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h3>Edit Product</h3>
        </div>
    </div>
    <div class="col-lg-6 margin-tb">
        <div class="text-right">
            <a class="btn btn-primary mx-4 me-4 btn-sm" href="{{ route('superadmin.products.index') }}"> Back</a>
        </div>
    </div>
</div>

<hr class="sidebar-divider mt-4 mb-4">

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <form action="{{ route('superadmin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">

            <div class="col-md-6">

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" >
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description">{{ $product->description }}</textarea>
                    </div>
                </div>



            </div>

            <div class="col-md-6">
               <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <strong>Price:</strong>
                        <input type="number" step="0.01" class="form-control" name="price" value="{{ $product->price }}" min="0">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                    <div class="form-group">
                        <strong>Stock Quantity:</strong>
                        <input type="number" class="form-control" name="stock_quantity" value="{{ $product->stock_quantity }}"  min="0">
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
