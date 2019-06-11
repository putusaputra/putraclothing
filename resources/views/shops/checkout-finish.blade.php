@extends('layouts.app-index')

@section('content')
    <div class="row row--nomargin">
        <div class="title col-lg-12">
            <h1>Thank you</h1>
        </div>
        <div id = "checkout-finish-content-wrapper" class="col-lg-12">
            <a href = "{{ route('shop.index') }}" class = "btn btn-success">Back to Shop</a>
        </div>
    </div>
@endsection