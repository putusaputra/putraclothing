@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit Item</div>

                <div class="card-body">

                {!! Form::open(['action' => ['ItemsController@update', $item->item_code], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{ Form::label('item_category', 'Item Category') }}
                        {{ Form::text('item_category', $item->item_category, ['class' => 'form-control', 'placeholder' => 'Item Category']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_name', 'Item Name') }}
                        {{ Form::text('item_name', $item->item_name, ['class' => 'form-control', 'placeholder' => 'Item Name']) }}
                    </div>

                    <div class = "form-group">
                        <h3>Current Image</h3>
                         <a id = "a-create" class = "item__link--popup" href = "/storage/t-shirts/{{ $item->item_preview }}">
                            <img id = "img-create" class = "item__image--popup" src = "/storage/t-shirts/{{ $item->item_preview }}" />
                        </a>
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_preview', 'Item Preview') }}
                        {{ Form::file('item_preview', ['style' => 'display:block;']) }}
                    </div>

                    <div class = "form-group">
                        {{ Form::label('item_material', 'Item Material') }}
                        {{ Form::text('item_material', $item->item_material, ['class' => 'form-control', 'placeholder' => 'Item Material']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_size', 'Item Size') }}
                        {{ Form::text('item_size', $item->item_size, ['class' => 'form-control', 'placeholder' => 'Item Size']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_src', 'Item SRC') }}
                        {{ Form::text('item_src', $item->item_src, ['class' => 'form-control', 'placeholder' => 'Item SRC']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_alt', 'Item Alt') }}
                        {{ Form::text('item_alt', $item->item_alt, ['class' => 'form-control', 'placeholder' => 'Item Alt']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_title', 'Item Title') }}
                        {{ Form::text('item_title', $item->item_title, ['class' => 'form-control', 'placeholder' => 'Item Title']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_keywords', 'Item Keywords') }}
                        {{ Form::text('item_keywords', $item->item_keywords, ['class' => 'form-control', 'placeholder' => 'Item Keywords']) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('item_price', 'Item Price') }}
                        {{ Form::text('item_price', $item->item_price, ['class' => 'form-control', 'placeholder' => 'Item Price']) }}
                    </div>
                    {{ Form::hidden('_method', 'PUT') }}
                    {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
                    {{ Form::reset('Reset', ['class' => 'btn btn-primary']) }}
                {!! Form::close() !!}
                
                </div>

            </div>
        </div>
    </div>
</div>
@endsection