@extends('layout')
@section('content')
    <div class="row" style="margin-top:1rem;">
        <div class="col s3">
            <button class="btn waves-effect waves-light indigo darken-2 white-text" id="createpost">Create</button>
        </div>
        <div class="col s3">
            <button class="btn waves-effect waves-light indigo darken-2 white-text" id="showpost">Show</button>
        </div>
        {{--        <div class="col s3">
                    <button class="btn waves-effect waves-light indigo darken-2 white-text" id="updatepost">Update</button>
                </div>
                <div class="col s3">
                    <button class="btn waves-effect waves-light indigo darken-2 white-text" id="deletepost">Delete</button>
                </div>--}}
    </div>

    <div id="response" class="row"></div>
@endsection
