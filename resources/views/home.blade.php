@extends('layout')
@section('content')
    <div class="card">
        <div class="card-content">
            <p>Posting Function</p>
        </div>
        <div class="card-tabs">
            <ul class="tabs tabs-fixed-width">
                <li class="tab"><a href="#create">Create</a></li>
                <li class="tab"><a class="edit" href="#edit">Edit</a></li>
                <li class="tab"><a href="#list">List</a></li>
            </ul>
        </div>
        <div class="card-content grey lighten-4">
            <div id="create">
                @include("form")
            </div>
            <div id="edit">Test 2</div>
            <div id="list">Test 3</div>
        </div>
    </div>

    <script>
        $('.tabs').tabs();
    </script>
@endsection
