@extends('layouts.app-index')

@section('content')
    <div class="row row--nomargin">
        <div class="title col-lg-12">
            <h1>Welcome to Putra Clothing Shop</h1>
        </div>
        <div class="sidebar col-lg-3 col-md-3 col-xs-12">
            {!! Form::open(['action' => 'ShopsController@searchProductsByNameOrCategory', 'method' => 'GET']) !!}
                <div class="form-group">Sort by</div>
                <div class="form-group">
                    {{ Form::radio('sort_by', 'latest', true) }}
                    <span>Latest</span>

                    {{ Form::radio('sort_by', 'oldest') }}
                    <span>Oldest</span>
                </div>
                <div class="form-group">
                    {{ Form::text('search_product','', ['class' => 'form-control', 'placeholder' => 'Search Products by name or category']) }}
                </div>
                {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
        </div>
        <div class="content col-lg-9 col-md-9 col-xs-12">
        @if (count($items) > 0)
        @foreach ($items as $item)

            <div class="item col-lg-4 card card-body bg-light" alt="{{ $item->item_alt }}" title="{{ $item->item_title }}" imgpreview = "{{ $item->item_preview }}">
                <div class="item__img__wrapper col-lg-12">
                    <a class = "item__link--popup" href = "/storage/t-shirts/{{ $item->item_preview }}">
                        <img class="item__img" src="/storage/t-shirts/{{ $item->item_preview }}" />
                    </a>
                </div>
                <div class="item__info col-lg-12">
                    <div class = "item__code">
                        <div class="item__desc">Item Code</div>
                        <div class="item__colon">:</div>
                        <div class="item__value">{{ $item->item_code }}</div>
                    </div>

                    <div class = "item__category">
                        <div class="item__desc">Item Category</div>
                        <div class="item__colon">:</div>
                        <div class="item__value">{{ $item->item_category}}</div>
                    </div>

                    <div class = "item__name">
                        <div class="item__desc">Item Name</div>
                        <div class="item__colon">:</div>
                        <div class="item__value">{{ $item->item_name }}</div>
                    </div>

                    <div class = "item__material">
                        <div class="item__desc">Item Material</div>
                        <div class="item__colon">:</div>
                        <div class="item__value">{{ $item->item_material }}</div>
                    </div>

                    <div class = "item__size">
                        <div class="item__desc">Item Size</div>
                        <div class="item__colon">:</div>
                        <div class="item__value">{{ $item->item_size }}</div>
                    </div>

                    <div class = "item__price">
                        <div class="item__desc">Item Price</div>
                        <div class="item__colon">:</div>
                        <div class="item__value">{{ $item->item_price }}</div>
                    </div>

                    <div class = "item__qty">
                        <div class="item__desc item__desc--qtyadjusted">Item Qty</div>
                        <div class="item__colon item__colon--qtyadjusted">:</div>
                        <div class="item__value">
                            {!! Form::open(['onsubmit' => 'return false;']) !!}
                            <div class="form-group">
                                {{ Form::text('item_qty', '', ['class' => 'form-control', 'placeholder' => 'qty']) }}
                            </div>
                            {{ Form::submit('Submit', ['class' => 'btn btn-primary item__submit']) }}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="item__cart col-lg-12">
                    <a href="javascript:void(0);" class="btn btn-lg btn-success item__cart__a">Add to cart</a>
                </div>
            </div>

            @endforeach

            <div class = "paging">{{ $items->links() }}</div>

            @else
                <h1>No Items Found</h1>
            @endif

        </div>
        <!-- <div class="jumbotron text-center">
                <h1></h1>
                <p>Up to date clothing store</p>
                <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
            </div> -->
    </div>
@endsection