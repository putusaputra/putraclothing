@extends('layouts.app-index')

@section('content')
    <div class="row row--nomargin">
        <div class="title col-lg-12">
            <h1>{{ $title }}</h1>
        </div>
        <div class="sidebar col-lg-3 col-md-3 col-xs-12">
            {!! Form::open(['onsubmit' => 'return false; myfunction();']) !!}
                <div class="form-group">Sort by</div>
                <div class="form-group">
                    {{ Form::radio('sort_by', 'Latest', true) }}
                    <span>Latest</span>

                    {{ Form::radio('sort_by', 'Oldest') }}
                    <span>Oldest</span>
                </div>
                <div class="form-group">
                    {{ Form::text('search','', ['class' => 'form-control', 'placeholder' => 'Search Here']) }}
                </div>
                {{ Form::submit('Search', ['class' => 'btn btn-primary']) }}
            {!! Form::close() !!}
        </div>
        <div class="content col-lg-9 col-md-9 col-xs-12">
            <div class="item col-lg-4 card card-body bg-light" alt="Blue Glowing T-Shirt" title="Blue Glowing T-Shirt">
                <div class="item__img__wrapper col-lg-12">
                    <img class="item__img" src="{{ asset('images/tshirt-blue.jpg') }}" />
                </div>
                <div class="item__info col-lg-12">
                    <div class="item__desc">Item Code</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">1</div>

                    <div class="item__desc">Item Category</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">T-Shirt</div>

                    <div class="item__desc">Item Name</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Blue Glowing T-Shirt</div>

                    <div class="item__desc">Item Material</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Silk</div>

                    <div class="item__desc">Item Size</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">L</div>

                    <div class="item__desc">Item Price</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">150.000</div>

                    <div class="item__desc item__desc--qtyadjusted">Item Qty</div>
                    <div class="item__colon item__colon--qtyadjusted">:</div>
                    <div class="item__value">
                        {!! Form::open(['onsubmit' => 'return false; myfunction();']) !!}
                        <div class="form-group">
                            {{ Form::text('qty', '', ['class' => 'form-control', 'placeholder' => 'qty']) }}
                        </div>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary item__submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="item__cart col-lg-12">
                    <a href="javascript:void(0);" class="btn btn-lg btn-success item__cart__a">Add to Cart</a>
                </div>
            </div>

            <div class="item col-lg-4 card card-body bg-light" alt="Basketball T-Shirt" title="Basketball T-Shirt">
                <div class="item__img__wrapper col-lg-12">
                    <img class="item__img" src="{{ asset('images/tshirt-basketball.jpg') }}" />
                </div>
                <div class="item__info col-lg-12">
                    <div class="item__desc">Item Code</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">1</div>

                    <div class="item__desc">Item Category</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">T-Shirt</div>

                    <div class="item__desc">Item Name</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Basketball T-Shirt</div>

                    <div class="item__desc">Item Material</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Silk</div>

                    <div class="item__desc">Item Size</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">L</div>

                    <div class="item__desc">Item Price</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">125.000</div>

                    <div class="item__desc item__desc--qtyadjusted">Item Qty</div>
                    <div class="item__colon item__colon--qtyadjusted">:</div>
                    <div class="item__value">
                        {!! Form::open(['onsubmit' => 'return false; myfunction();']) !!}
                        <div class="form-group">
                            {{ Form::text('qty', '', ['class' => 'form-control', 'placeholder' => 'qty']) }}
                        </div>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary item__submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="item__cart col-lg-12">
                    <a href="javascript:void(0);" class="btn btn-lg btn-success item__cart__a">Add to Cart</a>
                </div>
            </div>

            <div class="item col-lg-4 card card-body bg-light" alt="Gray Glowing T-Shirt" title="Gray Glowing T-Shirt">
                <div class="item__img__wrapper col-lg-12">
                    <img class="item__img" src="{{ asset('images/tshirt-gray.png') }}" />
                </div>
                <div class="item__info col-lg-12">
                    <div class="item__desc">Item Code</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">1</div>

                    <div class="item__desc">Item Category</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">T-Shirt</div>

                    <div class="item__desc">Item Name</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Gray Glowing T-Shirt</div>

                    <div class="item__desc">Item Material</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Silk</div>

                    <div class="item__desc">Item Size</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">L</div>

                    <div class="item__desc">Item Price</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">125.000</div>

                    <div class="item__desc item__desc--qtyadjusted">Item Qty</div>
                    <div class="item__colon item__colon--qtyadjusted">:</div>
                    <div class="item__value">
                        {!! Form::open(['onsubmit' => 'return false; myfunction();']) !!}
                        <div class="form-group">
                            {{ Form::text('qty', '', ['class' => 'form-control', 'placeholder' => 'qty']) }}
                        </div>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary item__submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="item__cart col-lg-12">
                    <a href="javascript:void(0);" class="btn btn-lg btn-success item__cart__a">Add to Cart</a>
                </div>
            </div>

            <div class="item col-lg-4 card card-body bg-light" alt="Orange T-Shirt" title="Orange T-Shirt">
                <div class="item__img__wrapper col-lg-12">
                    <img class="item__img" src="{{ asset('images/tshirt-orange.jpg') }}" />
                </div>
                <div class="item__info col-lg-12">
                    <div class="item__desc">Item Code</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">1</div>

                    <div class="item__desc">Item Category</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">T-Shirt</div>

                    <div class="item__desc">Item Name</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Orange T-Shirt</div>

                    <div class="item__desc">Item Material</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">Silk</div>

                    <div class="item__desc">Item Size</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">L</div>

                    <div class="item__desc">Item Price</div>
                    <div class="item__colon">:</div>
                    <div class="item__value">125.000</div>

                    <div class="item__desc item__desc--qtyadjusted">Item Qty</div>
                    <div class="item__colon item__colon--qtyadjusted">:</div>
                    <div class="item__value">
                        {!! Form::open(['onsubmit' => 'return false; myfunction();']) !!}
                        <div class="form-group">
                            {{ Form::text('qty', '', ['class' => 'form-control', 'placeholder' => 'qty']) }}
                        </div>
                        {{ Form::submit('Submit', ['class' => 'btn btn-primary item__submit']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="item__cart col-lg-12">
                    <a href="javascript:void(0);" class="btn btn-lg btn-success item__cart__a">Add to Cart</a>
                </div>
            </div>
        </div>
        <!-- <div class="jumbotron text-center">
                <h1>{{ $title }}</h1>
                <p>Up to date clothing store</p>
                <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
            </div> -->
    </div>
@endsection