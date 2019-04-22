@extends('layouts.app-index')

@section('content')
    <div class="row row--nomargin">
        <div class="title col-lg-12">
            <h1>{{ $title }}</h1>
        </div>
        <div class="sidebar col-lg-3 col-md-3 col-xs-12">
            <div class="sidebar__title">Menu</div>
            <ul>
                <li>Create Item</li>
                <li>Show all items</li>
            </ul>
        </div>
        <div class="content col-lg-9 col-md-9 col-xs-12">
           
        </div>
    </div>
@endsection