@extends('superadmin.products.layout')

@section('content')
<div class="row mx-1 mr-1 me-1 mt-4 mb-2">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h3>Product Details</h3>
        </div>
    </div>
    <div class="col-lg-6 margin-tb">
        <div class="text-right">
            <a class="btn btn-primary mx-4 me-4 btn-sm" href="{{ route('superadmin.products.index') }}"> Back</a>
        </div>
    </div>
</div>

<hr class="sidebar-divider mt-4 mb-4">

<div class="row">
    <div class="col-md-6">
    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <strong>Name:</strong>
            <p>{{ $product->name }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <strong>Description:</strong>
            <p>{{ $product->description ?? '-' }}</p>
        </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <strong>Price:</strong>
            <p>{{ number_format($product->price, 2) }}</p>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
        <div class="form-group">
            <strong>Stock Quantity:</strong>
            <p>{{ $product->stock_quantity }}</p>
        </div>
    </div>
    </div>
</div>
@endsection
