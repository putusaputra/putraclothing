@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class = "col-lg-6 float-left">List Items</div>
                    <div class = "col-lg-4 float-right">
                        {!! Form::open(['action' => 'ItemsController@searchItemByName', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group">
                                {{ Form::text('search_item', '', ['class' => 'form-control', 'placeholder' => 'search by item name']) }}
                            </div>

                            {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => 'display:none;']) }}
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Item Category</th>
                                <th>Item Preview</th>
                                <th>Item Material</th>
                                <th>Item Size</th>
                                <th>Item Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    @if (count($items) > 0)
                                
                        @php
                            $i = 0;    
                        @endphp
                                
                        @foreach ($items as $item)
                            @php
                                $i++;   
                            @endphp
                                <tr>
                                    <td>{{ $item->item_code }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->item_category }}</td>
                                    <td>
                                        <a class = "item__link--popup" href = "/storage/t-shirts/{{ $item->item_preview }}">
                                            <img class = "item__image--popup" src = "/storage/t-shirts/{{ $item->item_preview }}" />
                                        </a>
                                    </td>
                                    <td>{{ $item->item_material }}</td>
                                    <td>{{ $item->item_size }}</td>
                                    <td>{{ $item->item_price }}</td>
                                    <td>
                                        <a class="btn btn-success" href="/items/{{ $item->item_code }}/edit">
                                            <img src="{{ asset('icons/pencil.svg') }}"/>
                                        </a>
                                            
                                        <a class="btn btn-danger" onclick="event.preventDefault();document.getElementById('delete-form{{ $i }}').submit();">
                                            <img src="{{ asset('icons/trashcan.svg') }}"/>
                                        </a>
                                            
                                         {!! Form::open(['id' => 'delete-form'.$i, 'action' => ['ItemsController@destroy', $item->item_code], 'method' => 'POST'])
                                         !!}
                                          {{ Form::hidden('_method', 'DELETE') }}
                                          {{ Form::submit('Delete', ['class' => 'btn btn-danger', 'style' => 'display: none;']) }}
                                         {!! Form::close() !!}
                                    </td>
                                </tr>
                        @endforeach
                               
                    
                    @else
                        <tr>
                            <td colspan="5">No Items Found</td>
                        </tr>
                    @endif

                        </tbody>
                    </table>
                    {{ $items->links() }}
                
                </div>

            </div>
        </div>
    </div>
</div>
@endsection